<?php
/**
 * Controller for Trash Management 
 *
 * This file represents data stored in the users db table.
 *
 * PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version			1.0 Alpha
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class TrashController extends AppController {

	var $name = 'Trash';
	var $uses = array('User', 'Content', 'Menu');
	
	/**
	 * Custom function to retrive the users that was delete
	 * @access public
	 * $returns null
	**/
	function admin_users() {
		$user = $this->User->findAll('User.active = -2');
		$this->set('users', $user);
	}
	
	function admin_restore_user($id = null){
		// restore user by setting active = 0
		$this->User->query('UPDATE users SET active = 0 WHERE users.id = '. $id .' LIMIT 1 ;');
		$this->Session->setFlash(__("User Restored", true));
		// redirect to user index
		$this->redirect(array('action'=>'admin_users'));
		exit();
	}
	
	function admin_delete_user($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'admin_users'));
			exit();
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'admin_users'));
			exit();
		}
	}

	/**
	 * Custom function to retrive contents that were delete
	 * @access public
	 * $returns null
	**/
	function admin_contents() {
		$content = $this->Content->findAll('Content.state = -2');
		$this->set('contents', $content);
	}
	
	function admin_restore_content($id = null){
		// restore user by setting active = 0
		$this->User->query('UPDATE contents SET state = 0 WHERE id = '. $id .' LIMIT 1 ;');
		$this->Session->setFlash(__("Content item Restored", true));
		// redirect to user index
		$this->redirect(array('action'=>'admin_contents'));
		exit();
	}
	
	function admin_delete_content($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for content', true));
			$this->redirect(array('action'=>'admin_users'));
			exit();
		}
		if ($this->Content->del($id)) {
			$this->Session->setFlash(__('Content deleted', true));
			$this->redirect(array('action'=>'admin_contents'));
			exit();
		}
	}
	
	/**
	 * Custom function to retrive menu items that were delete
	 * @access public
	 * $returns null
	**/
	function admin_menus() {
		$menu = $this->Menu->findAll('Menu.state = -2');
		$this->set('menus', $menu);
	}
	
	function admin_restore_menu($id = null){
		// restore user by setting active = 0
		$this->Menu->query('UPDATE menus SET state = 0 WHERE id = '. $id .' LIMIT 1 ;');
		$this->Session->setFlash(__("Menu item Restored", true));
		// redirect to user index
		$this->redirect(array('action'=>'admin_menus'));
		exit();
	}
	
	function admin_delete_menu($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for content', true));
			$this->redirect(array('action'=>'admin_menus'));
			exit();
		}
		if ($this->Menu->del($id)) {
			$this->Session->setFlash(__('Menu item deleted', true));
			$this->redirect(array('action'=>'admin_menus'));
			exit();
		}
	}
	
}

?>
