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
			$this->Inventory->create();
			$this->Inventory->save($inventory);
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
		if($type == 'order'){
			$this->Product->unbindModel(array('hasMany' => array('Inventory','Vary')));
			$Products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id),'fields'=>array('Product.id','Product.attributes','Product.values')));
			$attributes = explode(',',$Products['Product']['attributes']);
			$values = explode(',',$Products['Product']['values']);
		}else{
			$this->Vary->unbindModel(array('belongsTo' => array('User','Inventory','Product')));
			$Varytype = $type == 'sale' ? 'fulfillment' : ($type == 'fulfillment' ? 'order' : 'order');
			$Products = $this->Vary->find('all',array('conditions'=>array('Vary.product_id'=>$id,'Vary.type'=>$Varytype),'fields'=>array('Vary.id','Vary.attribute','Vary.value')));
			foreach($Products as $product){
				$vary_attribute[] = $product['Vary']['attribute'];
				$vary_value[] = $product['Vary']['value'];
			}
			$ProductsQty = $this->Vary->find('all',array('conditions'=>array('Vary.product_id'=>$id),'fields'=>array('Vary.id','Vary.attribute','Vary.value','Vary.quantity','Vary.type')));
			
			$this->Product->unbindModel(array('hasMany' => array('Vary')));
			$ProductsAll = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id),'fields'=>array('Product.id','Product.attributes','Product.values')));
			$total='';
			foreach($ProductsAll['Inventory'] as $productAll){
				 if($type == 'fulfillment'){
					 if($productAll['type'] == 'order'){
						 $total['miscellaneous'] +=$productAll['shipping_price'] + $productAll['miscellaneous'];
						 $total['purchase_price'] +=$productAll['purchase_price'];
					 }
				 }
			}
			foreach($ProductsQty as $product){
				
				 if($type == 'fulfillment'){
					 if($product['Vary']['type']=='order')
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']] += $product['Vary']['quantity'];
					 if($product['Vary']['type']=='fulfillment')
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']] -= $product['Vary']['quantity'];
				 }
				 
				 if($type == 'sale'){
					if($product['Vary']['type']=='fulfillment')
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']] += $product['Vary']['quantity'];
					 if($product['Vary']['type']=='sale')
						$vary_count[$product['Vary']['attribute']][$product['Vary']['value']] -= $product['Vary']['quantity'];
				 }
				
			}
			$attributes = array_unique($vary_attribute);
			$values = array_unique($vary_value);
		}
		if($type == 'sale' || $type == 'fulfillment')
		$fields = array('quantity','sale_price');
		else
		$fields = array('quantity','purchase_price');
		$count = count($values);
		foreach($attributes as $key1 => $attr){
			for($i = 1; $i <= $count; $i++){
				foreach($values as $key1 => $value){
				 $loop[$attr][$value] = $fields;
				 if($type != 'order')
				 $loop[$attr][$value][$i] = $vary_count[$attr][$value];
				}
			}
		}
		//debug($loop); exit;
		$this->set('loops',$loop);
		$this->set('types',$type);
		$this->set('total',$total);
	}
	
	
	public function index($type = null) {
		$this->Inventory->recursive = 0;
		$start = date('Y-m-d');
		$days = Configure::read('Inventory.records');
		$this->set('records',$days);
		$end = date('Y-m-d', strtotime('-'.$days.' day'));
		//$this->Inventory->virtualFields = array('total_quantity' => 'sum(Inventory.quantity)','total_purchase_price' => 'sum(Inventory.purchase_price)','total_sale_price' => 'sum(Inventory.sale_price)');
		$Inventory = $this->Inventory->find('all',array('conditions'=>array('Inventory.type'=>$type,array('Inventory.created >=' => $end)),'order'=>array('Inventory.created' => 'desc')));
		//debug($Inventory); //exit;
		
		$this->set('inventories',$Inventory);
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
	/*public function editold($id = null) {
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Inventory->save($this->request->data)) {
				$this->Flash->success(__('The inventory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The inventory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
			$this->request->data = $this->Inventory->find('first', $options);
		}
		$users = $this->Inventory->User->find('list');
		$products = $this->Inventory->Product->find('list');
		$this->set(compact('users', 'products'));
	}*/
	
	public function edit($id = null,$type = null) {
		
		if ($this->request->is(array('post', 'put'))) {
			$loops = $this->request->data;
			$inventory['Inventory'] = $this->request->data['Inventory'];
			$this->Inventory->save($inventory);
			//debug($inventory);//exit;
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
						$keyarry[] = $key3;
					}
					if($keyarry[0] == 'id'){
						$this->Vary->save($data);
					}else{
				    	if(!empty($data['Vary'][$keyarry[0]]) && (!empty($data['Vary'][$keyarry[1]]) || !empty($data['Vary'][$keyarry[2]]))){
							unset($data['Vary']['id']);
							$this->Vary->create();
							$this->Vary->save($data);
							//debug($data); //exit;
						}
					}
					unset($keyarry);
				}
			}
			$this->redirect(array('controller'=>'inventories','action'=>'index',$type));
		}else{	//echo 'mm'; exit;
			$readSession = $this->Session->read();
			$this->Product->unbindModel(array('hasMany' => array('Inventory','Vary')));
			$this->set('products',$this->Product->find('list',array('fields'=>array('Product.title'))));
			if(is_numeric($id) && !empty($type)){
				$this->set('product_selected','disabled');
				$this->set('type_selected','disabled');
				$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id,'Inventory.type'=>$type));
				$this->Inventory->unbindModel(array('belongsTo' => array('User')));
				$inventory = $this->Inventory->find('first', $options);
				$attributes = explode(',',$inventory['Product']['attributes']);
				$values = explode(',',$inventory['Product']['values']);
				if($type == 'sale' || $type == 'fulfillment')
				$fields = array('quantity','sale_price');
				else
				$fields = array('quantity','purchase_price');
				$count = count($values);
				foreach($attributes as $key1 => $attr){
					for($i = 1; $i <= $count; $i++){
						foreach($values as $key1 => $value){
						 $loop[$attr][$value] = $fields;
						}
					}
				}
				$this->set('loops',$loop);
				
				foreach($inventory['Vary'] as  $data){
					$update_loop[$data['attribute']][$data['value']] = array('id'=>$data['id'],'quantity'=> $data['quantity'],'purchase_price'=>$data['purchase_price'],'sale_price'=>$data['sale_price']);
				}
				$this->request->data = array_merge($update_loop,$inventory);
debug($this->request->data);
			}
			$datas['user_id'] = $readSession['User']['id'];
			$this->set('data',$datas);
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
