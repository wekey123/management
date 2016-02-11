<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class InventoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	public $uses = array('Product','Vary','Inventory');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
 	public function add($id) {
		if ($this->request->is('post')) {
			$loops = $this->request->data;
			$inventory['Inventory'] = $this->request->data['Inventory'];
			//debug($loops); exit;
			if($inventory['Inventory']['quantity'] != "" && $inventory['Inventory']['quantity'] > 0 ){
				$this->Inventory->create();
				$this->Inventory->save($inventory);
				$inventory['Inventory']['inventory_id'] = $this->Inventory->getInsertID();
			}else{
				$this->Flash->error(__('Inventory quantity and their value should be filled up'));
				$this->redirect(array('controller'=>'inventories','action'=>'index',$id));	
			}
			$inventory['Inventory']['inventory_id'] = $this->Inventory->getInsertID();
			foreach($loops as $key1=> $loop){
				foreach($loop as $key2=> $value){
					foreach($value as $key3=> $fields){
						$data['Vary']['user_id'] = $inventory['Inventory']['user_id'];
						$data['Vary']['inventory_id'] = $inventory['Inventory']['inventory_id'];
						$data['Vary']['product_id'] = $inventory['Inventory']['product_id'];
						$data['Vary'][$key3] = $fields;
						$data['Vary']['attribute'] = $key1;
						$data['Vary']['value'] = $key2;
						$data['Vary']['type'] = $inventory['Inventory']['type'];
						$keyarry[] = $key3;
					}
				    if(!empty($data['Vary'][$keyarry[0]]) && (!empty($data['Vary'][$keyarry[1]]) || !empty($data['Vary'][$keyarry[2]]))){
						$this->Vary->create();
						$this->Vary->save($data);
					}
				}
			}
			$this->redirect(array('controller'=>'products','action'=>'index'));
		}else{
			$readSession = $this->Session->read();
			$this->Product->unbindModel(array('hasMany' => array('Inventory','Vary')));
			$select1=array(0=>'Select a Product');
   			$select2=$this->Product->find('list',array('fields'=>array('Product.title')));
  			$this->set('products',array_merge($select1, $select2)); //exit;
			if(is_numeric($id)){
				$this->request->data['Inventory']['product_id'] = $id;
				$this->set('product_selected','disabled');
				$this->set('type_selected','1');
			}else{
				$this->request->data['Inventory']['type'] = $id;
				$this->set('product_selected','1');
				$this->set('type_selected','disabled');
			}
			$datas['user_id'] = $readSession['User']['id'];
			$this->set('data',$datas);
		}
	}
	
	public function getform($id = null,$type = null){
		$this->layout = '';
		$total='';
		$this->Product->unbindModel(array('hasMany' => array('Vary')));
		$ProductsAll = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id),'fields'=>array('Product.id','Product.attributes','Product.values')));
		if($type == 'order'){
		  $fields = array('quantity','purchase_price');
		  $attributes = explode(',',$ProductsAll['Product']['attributes']);
		  $values = explode(',',$ProductsAll['Product']['values']);
		  $count = count($values);
		  foreach($attributes as $key1 => $attr){
				for($i = 1; $i <= $count; $i++){
					foreach($values as $key1 => $value){
					 $loop[$attr][$value] = $fields;
					}
				}
			}
		}else{
		   $Varytype = $type == 'fulfillment' ? 'order' : 'fulfillment';
		   $this->Vary->unbindModel(array('belongsTo' => array('User','Inventory','Product')));
		   $ProductsQty = $this->Vary->find('all',array('conditions'=>array('Vary.product_id'=>$id),'fields'=>array('Vary.id','Vary.attribute','Vary.value','Vary.quantity','Vary.type','Vary.purchase_price','Vary.sale_price')));
		   foreach($ProductsQty as  $key => $product){
				 if($type == 'order'){
					$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
					$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1]  = 'purchase_price'; 
				 }
				 if($type == 'fulfillment'){
					 if($product['Vary']['type']=='order'){
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1] = $product['Vary']['purchase_price'];
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][2]  = 'sale_price'; 
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] += $product['Vary']['quantity'];
					 }
					 if($product['Vary']['type']=='fulfillment'){
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] -= $product['Vary']['quantity'];
						if($vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] == 0){
							unset($vary_count[$product['Vary']['attribute']][$product['Vary']['value']]);
						}
					 }
				 }
				 if($type == 'sale'){
					 if($product['Vary']['type']=='fulfillment'){
					  $vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
					  $vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1] = $product['Vary']['purchase_price'];
					  $vary_count[$product['Vary']['attribute']][$product['Vary']['value']][2] = $product['Vary']['sale_price'];
					  $vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] += $product['Vary']['quantity'];
					}
					if($product['Vary']['type']=='sale'){
					  $vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] -= $product['Vary']['quantity'];
						if($vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] == 0){
							unset($vary_count[$product['Vary']['attribute']][$product['Vary']['value']]);
						}
					}
				 }
		  }
		  $loop =  (!empty($vary_count)) ? $vary_count : ''; 
		//debug( $loop); exit;
		}
		$this->set('loops',$loop);
		$this->set('types',$type);	
	}
	
	
	public function index($type = null) {
		$this->Inventory->recursive = 0;
		$start = date('Y-m-d');
		$days = Configure::read('Inventory.records');
		$this->set('records',$days);
		$end = date('Y-m-d', strtotime('-'.$days.' day'));
		$this->Inventory->virtualFields = array('total_quantity' => 'sum(Inventory.quantity)','total_purchase_price' => 'sum(Inventory.purchase_price)','total_sale_price' => 'sum(Inventory.sale_price)');
		$Inventory = $this->Inventory->find('all',array('conditions'=>array('Inventory.type'=>$type,array('Inventory.created >=' => $end)),'order'=>array('Inventory.created' => 'desc'),'group' => array('Inventory.product_id')));
		//$Inventory = $this->Inventory->find('all',array('conditions'=>array('Inventory.type'=>$type,array('Inventory.created >=' => $end)),'order'=>array('Inventory.created' => 'desc')));
		$this->set('inventories',$Inventory);
		$this->set('types',$type);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
		$this->set('inventory', $this->Inventory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function demo() {
		if ($this->request->is('post')) {
			$this->Inventory->create();
			if ($this->Inventory->save($this->request->data)) {
				$this->Flash->success(__('The inventory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The inventory could not be saved. Please, try again.'));
			}
		}
		$users = $this->Inventory->User->find('list');
		$products = $this->Inventory->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function edit($id = null,$type = null) {
		
		if ($this->request->is(array('post', 'put'))) {
			$loops = $this->request->data;
			$inventory['Inventory'] = $this->request->data['Inventory'];
			$this->Inventory->save($inventory);
			foreach($loops as $key1=> $loop){
				foreach($loop as $key2=> $value){
					foreach($value as $key3=> $fields){
						if($key3 == 'id'){
							$data['Vary']['id'] = $fields;
						}
						$data['Vary'][$key3] = $fields;
						$data['Vary']['user_id'] = $inventory['Inventory']['user_id'];
						$data['Vary']['inventory_id'] = $inventory['Inventory']['id'];
						$data['Vary']['product_id'] = $inventory['Inventory']['product_id'];
						$data['Vary']['attribute'] = $key1;
						$data['Vary']['value'] = $key2;
						$data['Vary']['type'] = $inventory['Inventory']['type'];
					}

					if(!empty($data['Vary']['id']) && is_numeric($data['Vary']['id'])){
						$this->Vary->save($data);
					}else{
				    	if(!empty($data) && !empty($data['Vary']['quantity']) && (!empty($data['Vary']['purchase_price']) || !empty($data['Vary']['sale_price']))){
							$this->Vary->create();
							$this->Vary->save($data);
						}
					}
				}
			}
			$this->redirect(array('controller'=>'inventories','action'=>'index',$type));
		}else{
			$readSession = $this->Session->read();
			$datas['user_id'] = $readSession['User']['id'];
			$this->set('data',$datas);
			$this->Product->unbindModel(array('hasMany' => array('Inventory','Vary')));
			$this->set('products',$this->Product->find('list',array('fields'=>array('Product.title'))));
			if(is_numeric($id) && !empty($type)){
				$this->set('product_selected','disabled');
				$this->set('type_selected','disabled');
				
				$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id,'Inventory.type'=>$type));
				$this->Inventory->unbindModel(array('belongsTo' => array('User')));
				$inventory = $this->Inventory->find('first', $options);
				
				$this->Product->unbindModel(array('hasMany' => array('Vary')));
				$ProductsAll = $this->Product->find('first',array('conditions'=>array('Product.id'=>$inventory['Inventory']['product_id']),'fields'=>array('Product.id','Product.attributes','Product.values')));
				if($type == 'order'){
				  $fields = array('quantity','purchase_price');
				  $attributes = explode(',',$ProductsAll['Product']['attributes']);
				  $values = explode(',',$ProductsAll['Product']['values']);
				  $count = count($values);
				  foreach($attributes as $key1 => $attr){
						for($i = 1; $i <= $count; $i++){
							foreach($values as $key1 => $value){
							 $loop[$attr][$value] = $fields;
							}
						}
					}
				}else{
					$this->Vary->unbindModel(array('belongsTo' => array('User','Inventory','Product')));
					$ProductsQty = $this->Vary->find('all',array('conditions'=>array('Vary.product_id'=>$inventory['Inventory']['product_id']),'fields'=>array('Vary.id','Vary.attribute','Vary.value','Vary.quantity','Vary.type','Vary.purchase_price','Vary.sale_price')));
					$vary_count = array();
					
					foreach($ProductsQty as  $key => $product){
						if($type == 'order'){
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1]  = 'purchase_price'; 
						}else if($type == 'fulfillment'){
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1]  = $product['Vary']['purchase_price'];
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][2]  = 'sale_price';
							if($product['Vary']['type']=='order'){
								$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] += $product['Vary']['quantity'];
							}
							if($product['Vary']['type']=='fulfillment'){
								$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] -= $product['Vary']['quantity'];
							}
	
						}else if($type == 'sale'){
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][0]  = 'quantity';
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][1]  = $product['Vary']['purchase_price'];
							$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][2]  = $product['Vary']['sale_price'];
							if($product['Vary']['type']=='fulfillment'){
								$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] += $product['Vary']['quantity'];
							}
							if($product['Vary']['type']=='sale'){
								$vary_count[$product['Vary']['attribute']][$product['Vary']['value']][3] -= $product['Vary']['quantity'];
							}
						}
					}
					$loop =  (!empty($vary_count)) ? $vary_count : '';
				}
				$this->set('loops',$loop);
				$this->set('types',$type);
				foreach($inventory['Vary'] as  $data){
					$update_loop[$data['attribute']][$data['value']] = array('id'=>$data['id'],'quantity'=> $data['quantity'],'purchase_price'=>$data['purchase_price'],'sale_price'=>$data['sale_price']);
				}
				$this->request->data = array_merge($update_loop,$inventory);
			}else{
				echo "else error line 313";
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Inventory->delete()) {
			$this->Flash->success(__('The inventory has been deleted.'));
		} else {
			$this->Flash->error(__('The inventory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
