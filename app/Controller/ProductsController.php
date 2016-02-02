<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	public $layout = 'admin';
	public $uses = array('Product','Vary','Inventory');

/**
 * index method
 *
 * @return void
 */
	public function index() {
				
		$this->layout = 'adminhome';
		$this->Product->recursive = 1;
		$Products = $this->Product->find('all');
		if(!empty($Products)){	
		foreach($Products as $product) {
			
				 $product['Product']['order_qty'] = 0;
				 $product['Product']['order_purchase_price'] = 0;
				 $product['Product']['order_sale_price'] = 0;
				 $product['Product']['fulfill_qty'] = 0;
				 $product['Product']['fulfill_purchase_price'] = 0;
				 $product['Product']['fulfill_sale_price'] = 0;
				 $product['Product']['sale_qty'] = 0;
				 $product['Product']['sale_purchase_price'] = 0;
				 $product['Product']['sale_sale_price'] = 0;
				 
			foreach($product['Inventory'] as $Inventory) {
			 if($Inventory['type'] == 'order'){
				 $product['Product']['order_qty'] += $Inventory['quantity'];
				 $product['Product']['order_purchase_price'] += $Inventory['purchase_price'];
				 $product['Product']['order_sale_price'] += $Inventory['sale_price'];
			 }
			 if($Inventory['type'] == 'fulfillment'){
				 $product['Product']['fulfill_qty'] += $Inventory['quantity'];
				 $product['Product']['fulfill_purchase_price'] += $Inventory['purchase_price'];
				 $product['Product']['fulfill_sale_price'] += $Inventory['sale_price'];
			 }
			 if($Inventory['type'] == 'sale'){
				 $product['Product']['sale_qty'] += $Inventory['quantity'];
				 $product['Product']['sale_purchase_price'] += $Inventory['purchase_price'];
				 $product['Product']['sale_sale_price'] += $Inventory['sale_price'];
			 }
			}
			$i=0;
			foreach($product['Vary'] as $vary){
				if($vary['type']=='sale'){
					$product['attribute'][$vary['attribute']][$vary['value']]['quantity'] +=$vary['quantity'];
					$product['attribute'][$vary['attribute']][$vary['value']]['sale_price'] +=$vary['sale_price'];
					$product['attribute'][$vary['attribute']][$vary['value']]['total_sale_price'] +=$vary['quantity']*$vary['sale_price'];
				}
				if($vary['type']=='order'){
					$product['order'][$vary['attribute']][$vary['value']]['quantity'] +=$vary['quantity'];
					$product['order'][$vary['attribute']][$vary['value']]['sale_price'] +=$vary['sale_price'];
					$product['order'][$vary['attribute']][$vary['value']]['total_sale_price'] +=$vary['quantity']*$vary['sale_price'];
				}
			$i++;
			}
			
			$result[] = $product;
		}
		}
		else
		$result = '';
		foreach ($product['Vary'] as $salesVary){
			if($salesVary['type']=='sale'){
				//echo '<p>'.$salesVary['attribute'].'</p>';
				$newSalesVary[]=$salesVary;
			}
		}
		$this->set('products',$result);
	}
	
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$product=$this->Product->find('first', $options);
		$i=0;
			foreach($product['Vary'] as $vary){
				if($vary['type']=='sale'){
					$product['attribute'][$vary['attribute']][$vary['value']]['quantity'] +=$vary['quantity'];
					$product['attribute'][$vary['attribute']][$vary['value']]['sale_price'] +=$vary['sale_price'];
					$product['attribute'][$vary['attribute']][$vary['value']]['total_sale_price'] +=$vary['quantity']*$vary['sale_price'];
				}
				if($vary['type']=='order'){
					$product['order'][$vary['attribute']][$vary['value']]['quantity'] +=$vary['quantity'];
					$product['order'][$vary['attribute']][$vary['value']]['sale_price'] +=$vary['sale_price'];
					$product['order'][$vary['attribute']][$vary['value']]['total_sale_price'] +=$vary['quantity']*$vary['sale_price'];
				}
			$i++;
			}
			$this->set('product',$product);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {//
		if ($this->request->is('post')) {//echo '<pre>';print_r($this->request->data);exit;
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Flash->success(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Flash->success(__('The product has been deleted.'));
		} else {
			$this->Flash->error(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
