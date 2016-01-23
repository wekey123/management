<?php
App::uses('AppController', 'Controller');
/**
 * Varies Controller
 *
 * @property Vary $Vary
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class VariesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Vary->recursive = 0;
		$this->set('varies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vary->exists($id)) {
			throw new NotFoundException(__('Invalid vary'));
		}
		$options = array('conditions' => array('Vary.' . $this->Vary->primaryKey => $id));
		$this->set('vary', $this->Vary->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vary->create();
			if ($this->Vary->save($this->request->data)) {
				$this->Flash->success(__('The vary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vary could not be saved. Please, try again.'));
			}
		}
		$users = $this->Vary->User->find('list');
		$inventories = $this->Vary->Inventory->find('list');
		$products = $this->Vary->Product->find('list');
		$this->set(compact('users', 'inventories', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vary->exists($id)) {
			throw new NotFoundException(__('Invalid vary'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vary->save($this->request->data)) {
				$this->Flash->success(__('The vary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vary could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vary.' . $this->Vary->primaryKey => $id));
			$this->request->data = $this->Vary->find('first', $options);
		}
		$users = $this->Vary->User->find('list');
		$inventories = $this->Vary->Inventory->find('list');
		$products = $this->Vary->Product->find('list');
		$this->set(compact('users', 'inventories', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Vary->id = $id;
		if (!$this->Vary->exists()) {
			throw new NotFoundException(__('Invalid vary'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vary->delete()) {
			$this->Flash->success(__('The vary has been deleted.'));
		} else {
			$this->Flash->error(__('The vary could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
