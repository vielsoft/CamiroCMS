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
class MenuContainersController extends AppController {
	var $name = 'MenuContainers';
	var $helpers = array('Fck');
	
	/**
	 *Override app_controller.php beforeFilter function to allow menu pages viawable at frontpage
	 * without the nedd to login (guest users)
	 **/
function beforeFilter() {
		parent::beforeFilter();
		/** Add other functions in the elements 'index', 'view', 'others', 'etc' **/
		$this->Auth->allow('index', 'view');
	}
//eto dinagdag ko... eto din yung kahapon <--- english dude, english
function admin_index($parentid=null) {
	$this->MenuContainer->recursive = 0;

	if($parentid){
		//Show Only Child Containers
		$menucontainers = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.parentid' => $parentid)));

	} else {
		//Show Only Sections (Containers who have no Parents)
		$menucontainers = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.parentid' => '0')));

	}

	$this->set('menucontainers', $menucontainers);
	$this->set('parentid', $parentid);

	}
function index($parentid=null) {

	$this->MenuContainer->recursive = 0;

	if($parentid){
		//Show Only Child Containers
		$menucontainers = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.parentid' => $parentid)));

		$currentContainerName = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.id' => $parentid)));
		$currentview = 'You are inside: '.$currentContainerName['0']['MenuContainer']['title'];


	} else {
		//Show Only Sections (Containers who have no Parents)
		$menucontainers = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.parentid' => '0')));
		$currentview = "Showing Main Containers";

	}

	$this->set('menucontainers', $menucontainers);
	$this->set('parentid', $parentid);
	$this->set('currentview', $currentview);

	}


//Displays specific Items
function view($id) {
	
 	$menus = $this->MenuContainer->find('all', array('conditions' => array('MenuContainer.id' => $id)));
 	$this->set('menucontainers', $menucontainers);
 	$this->set('id', $id);
	
	}
//Add menu - admin side
function admin_add() {

	if (!empty($this->data)) {
	$this->MenuContainer->create();
	if ($this->MenuContainer->save($this->data)) {
	$this->Session->setFlash(__('The Menu has been saved'));
	$this->redirect(array('action'=>'admin_index'), null, true);
	} else {
	$this->Session->setFlash(__('Menu not saved. Try again.'));
		
		}
	}
	$groups = $this->MenuContainer->Group->find('list');
	$this->set(compact('groups'));
	$menu_containers = $this->MenuContainer->MenuContainer2->find('list');
	//Add Blank Option for Main Containers
	$menu_containers['0'] = 'Main Container';
	$this->set(compact('menu_containers'));
	$this->set('currentview', 'Container:: Add');
	$this->render('admin_edit');
}
//Edit menu - admin side (no validation rule yet)
function admin_edit($id = null) {
		
	if (!$id) {
	$this->Session->setFlash(__('Invalid Menu'));
	$this->redirect(array('action'=>'admin_index'), null, true);
	}
	if (empty($this->data)) {
	$this->data = $this->MenuContainer->find(array('MenuContainer.id' => $id));
	} else {
	if ($this->MenuContainer->save($this->data)) {
	$this->Session->setFlash(__('The Menu Container has been saved'));
	$this->redirect(array('action'=>'admin_index'), null, true);
		} else {
		$this->Session->setFlash(__('The Menu Container could not be saved.
		Please, try again.'));
		}
	}
		$groups = $this->MenuContainer->Group->find('list');
		$this->set(compact('groups'));

		$menu_containers = $this->MenuContainer->MenuContainer2->find('list');
		//Add Blank Option for Main Containers
		$menu_containers['0'] = 'Main Container';
		$this->set(compact('menu_containers'));
		$this->set('currentview', 'Container:: Edit');
}
//Delete menu - admin side (careful)
function admin_delete($id = null) {
	if (!$id) {
	$this->Session->setFlash(__('Invalid id for Menu'));
	$this->redirect(array('action'=>'admin_index'), null, true);
	}
	if ($this->MenuContainer->del($id)) {
	$this->Session->setFlash('Menu #'.$id.' deleted');
	$this->redirect(array('action'=>'admin_index'), null, true);
	}
	}
//for the view function - experimental stage
function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Menu.', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->set('menucontainers', $this->MenuContainer->read(null, $id));


	}
//for the latest menu containers added - shown at admin main page
function getLatestItems() {
		return $this->MenuContainer->find('all', array('order' => 'MenuContainer.name DESC', 'limit' => 5));
	}
}
?>
