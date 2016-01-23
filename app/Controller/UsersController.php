<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	public $layout = 'admin';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function login() {
		
		$this->layout = 'adminlogin';
		if($this->request->is('post')){
			if(!empty($this->request->data['User']['email'])){
		       $check = $this->User->find('first', array('conditions' => array('User.email'=>$this->request->data['User']['email'])));
				if(!empty($check)){
					if($check['User']['password'] == $this->request->data['User']['password']){
						if($check['User']['privilages'] == 'admin'){
							$this->Session->write($check);
							$this->Session->setFlash("<div class='error msg'>Login Success. welcome ".$this->request->data['User']['email']."</div>");
							$this->redirect(array('controller'=>'products','action'=>'index'));
						}
						else
							$this->Session->setFlash("<div class='error msg'>Account suspended. Your account has been suspended by site admin.</div>");
					}
					else
						$this->Session->setFlash("<div class='error msg'>Invalid Password. Please try again.</div>,");
				}else
			    $this->Session->setFlash("<div class='error msg'>Invalid email/passsword. Please try again.</div>");
			}
			else{
			   $this->Session->setFlash("<div class='error msg'>Email should be filled out.</div>");
			}
		}
	}
	
/**
 * admin_logout method
 *
 * @return void
 */	
	public function logout() {
		$this->Session->delete('User');
		$this->redirect(array('controller'=>'users','action'=>'login'));
	}
}
