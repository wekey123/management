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
		//$this->layout = '';
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
					if(!empty($data['Vary'][$keyarry[0]]) && !empty($data['Vary'][$keyarry[1]]) && !empty($data['Vary'][$keyarry[2]])){
						$this->Vary->create();
						$this->Vary->save($data);
						$this->redirect(array('controller'=>'products','action'=>'index'));
					}
				}
			}
		}else{
			$Products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id)));
			$attributes = explode(',',$Products['Product']['attributes']);
			$values = explode(',',$Products['Product']['values']);
			$fields = array('quantity','purchase_price','sale_price');
			$count = count($values);
			foreach($attributes as $key1 => $attr){
				for($i = 1; $i <= $count; $i++){
					foreach($values as $key1 => $value){
					 $loop[$attr][$value] = $fields;
					}
				}
			}
			$this->set('loops',$loop);
			$readSession = $this->Session->read();
			$datas['user_id'] = $readSession['User']['id'];
			$datas['product_id'] = $id;
			$this->set('data',$datas);
		}
	}
	
	
	public function index($type = null) {
		$this->Inventory->recursive = 0;
		$start = date('Y-m-d');
		$end = date('Y-m-d', strtotime('-2 day'));
		//$this->Inventory->virtualFields = array('total_quantity' => 'sum(Inventory.quantity)','total_purchase_price' => 'sum(Inventory.purchase_price)','total_sale_price' => 'sum(Inventory.sale_price)');
		$Inventory = $this->Inventory->find('all',array('conditions'=>array('Inventory.type'=>$type,array('Inventory.created >=' => $end))));
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
	public function edit($id = null) {
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
