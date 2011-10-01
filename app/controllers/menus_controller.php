<?php
/*
* PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version			1.0 Alpha
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class MenusController extends AppController {
	var $name = 'Menus';
	var $helpers = array('Fck');
	
	/**
	 *Override app_controller.php beforeFilter function to allow menu pages viawable at frontpage
	 * without the need to login (guest users)
	 **/
function beforeFilter() {
		parent::beforeFilter();
		/** Add other functions in the elements 'index', 'view', 'get latestitems' , 'others', 'etc' **/
		$this->Auth->allow('index', 'view');
	}
function admin_index($parentid=null) {
	$this->Menu->recursive = 0;
	
	if(!empty($parentid)){
		$menus = $this->Menu->find('all', array('conditions' => array('Menu.parentid' => $parentid)));
		
	} else {
		$menus = $this->Menu->findAll('Menu.state = 1 || Menu.state = 0');
	}
	$this->set('parentid', $parentid);
	$this->set('menus', $menus);
	
	}
function index($properties=null) {
	switch($properties){
		case 'all':
		$menus = $this->Menu->find('all');
		$currentview = "SHOWING_ALL_ITEMS";
		break;

		case 'front':
		$menus = $this->Menu->find('all', 
					array('conditions' => array('Menu.properties' => 'frontpage=1')));
		$currentview = "SHOWING_FRONTPAGE";
		break;

		default:
		$menus = $this->Menu->find('all', 
					array('conditions' => array('Menu.parentid' => $properties)));
		$currentview = "";
		break;
	}

	$this->set('menus', $menus);
	$this->set('currentview', $currentview);
	$this->set('properties', $properties);

	}

function view($container_id) {
	
		$condition 	= "Menu.container = {$container_id}";
		$order 		= 'Menu.ordering';	
		return $this->Menu->findAll($condition, null, $order, null);
	
	}

function admin_add() {
	
	if (!empty($this->data)) {
	$this->Menu->create();
	if ($this->Menu->save($this->data)) {
	$this->Session->setFlash(__('The Menu has been saved'));
	$this->redirect(array('action'=>'admin_index'), null, true);
		} else {
			$this->Session->setFlash(__('Menu not saved. Try again.'));
		}
	}
	$groups = $this->Menu->Group->find('list');
	$this->set(compact('groups'));

	$menu_containers = $this->Menu->MenuContainer2->find('list');
	$this->set(compact('menu_containers'));
	$this->set('currentview', 'Menu:: Edit');
	$this->set('currentview', 'Menu:: Add');
	$this->render('admin_edit'); 
}

function admin_edit($id = null) {
		
	if (!$id) {
	$this->Session->setFlash(__('Invalid Menu'));
	$this->redirect(array('action'=>'admin_index'), null, true);
	}
	if (empty($this->data)) {
	$this->data = $this->Menu->find(array('Menu.id' => $id));
	} else {
	if ($this->Menu->save($this->data)) {
	$this->Session->setFlash(__('The Menu has been saved'));
	$this->redirect(array('action'=>'admin_index'), null, true);
	} else {
	$this->Session->setFlash(__('The Menu could not be saved.
	Please, try again.'));
	}
	}
		$groups = $this->Menu->Group->find('list');
		$this->set(compact('groups'));

		$menu_containers = $this->Menu->MenuContainer2->find('list');
		$this->set(compact('menu_containers'));
		$this->set('currentview', 'Menu:: Edit');
}

function admin_delete($id = null) {
	$this->Menu->saveField('state', '-2');
	$this->Session->setFlash(__("Sending menu item to trash bin successful", true));
	// redirect to user index
	$this->redirect(array('action'=>'index'), null, true);
	exit();
		
	}

function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Menu.', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
	}

function getLatestItems() {
		$condition 	= 'Menu.state = 1';
		$order 		= 'Menu.link';	
		$limit 		= '5';
		return $this->Menu->findAll($condition, null, $order, $limit);
	}
}
?>
