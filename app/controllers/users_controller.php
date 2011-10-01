<?php
/**
 * Controller for User 
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
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Camiro');
	var $paginate = array('limit' => '15','order' => array('User.name' => 'DESC'));
	
	/* *
	 * Override beforeFilter at app_controller.php to allow listed actions without the need to login
	 *
	 *@params $this->Auth->allow()''
	 * @access public
	**/
	function beforeFilter() 
	{
		parent::beforeFilter();
		// action that are allowed withour loging in
		$this->Auth->allow( 'admin_login', 'login', 'admin_logout', 'register' );
	}
	
	/** 
	* Check user authorization and redirect upon log in success
	*
	* @access public
	* @returns null - will redirect upon success
	**/
	function login() 
	{	
		if ( $this->Auth->user() ) {
			// check login fields if not empty
			if ( !empty( $this->data) ) {
				// if rememeber me option is not checked then delete User cookie stored
				if ( empty( $this->data['User']['remember_me'] ) ) {
					$this->Cookie->del('User');
				} else {
					// remember me option is activated, write cookie datas
					$cookie = array();
					$cookie['email_address'] = $this->data['User']['email_address'];
					$cookie['passwd'] = $this->data['User']['passwd'];
					$this->Cookie->write('User', $cookie, true, '+4 weeks' );
				}
				// deactivate remember me option
				unset( $this->data['User']['remember_me']);
				
			}
			// redirect to main page id the user is already log in
			$this->redirect( $this->Auth->redirect() );
			exit();
		}
		
	}
	
    /** 
	* Logout action for users
	*
	* @access public
	* @returns null - will redirect upon success
	**/
	function logout()
	{  
		// check stored cookie
		$cookie = $this->Cookie->read('User');
		if ( $cookie ) {
			// Delete cookie
			$this->Cookie->del('User');
		}
		// Delete the session 'Permissions'
		$this->Session->del( 'Permissions' );  
		// Then redirect to main
		$this->redirect( $this->Auth->logout() );  
	}

	/**
	 * View users action. First check user ownership for the records being viewed
	 * then check for proper $id variable
	*
	* @access public
	* @params $id  - id of the record being viewed
	* @returns record data if logged in User id is same as id being viewed
	**/
	function view($id = null) 
	{
		//view file not available...redirect to main page
		$this->redirect( $this->Auth->redirect() );
	}

	/**
	 * Custom user registration function
	*
	* @access public
	* @returns null - will redirect upon success
	**/
	function register() 
	{
		//check if user is already registered, if true redirect user to main page
		if ( $this->Auth->user() ) {
			$this->redirect( $this->Auth->redirect() );
			exit();
		}
		// if forms are not empty
		if ( !empty($this->data) ) {
			// create user 
			$this->User->create();
			//convert password to hash value. Ref-  __convertPasswords() at the bottom of this file
			$this->__convertPasswords();
			//Saving data successfull
			if ( $this->User->save( $this->data ) ) {
				$this->Session->setFlash(__( 'Thank you for registering. You may now login', true ) );
				$this->redirect( $this->Auth->redirect() );
				exit();
			// Problems where encountered while processing the data
			} else {
				// Show error message and empty password fields
				$this->Session->setFlash(__( 'Error\'s were encountered. Please, try again.', true ) );
				$this->data['User']['new_passwd'] 		= null;
				$this->data['User']['confirm_passwd'] 	= null;
			}
		}
		// find the user and group relation and set $groups variable
		$groups = $this->User->Group->find('list', array('fields' => 'Group.name'));
		$this->set(compact('groups'));
	}
		
	/**
	 * Edit user function - frontpage
	*
	* @ params $id - can only be access if the user.id is the same with the $id
	* @access public
	* @returns null - will redirect upon success
	**/
	function edit($id = null) 
	{

		// First check if the user is viewing his own record. Ref - Camiro Component
		if( !$this->Camiro->checkUsersOwnRecord( $id ) ) {

			//if not redirect him back to mainpage
			$this->redirect( $this->Auth->redirect() );
			//exit all process
			exit();
		} 
		
		if (empty($this->data)) {
	        $this->data = $this->User->read(null, $id);
			$this->data['User']['passwd'] = null;
	    } else {
			$this->__convertPasswords();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('Updating profile successful!', true));
				$this->redirect('/users/edit/'. $id);
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
				$this->data['User']['new_passwd'] = null;
				$this->data['User']['confirm_passwd'] = null;
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
		}

	/** 
	* Send user to Auth redirection when log in success for administrators
	*
	* @access public
	* @returns null - will redirect upon success
	**/
    function admin_login() 
	{
		if ( $this->Auth->user() ) {
			$this->redirect( $this->Auth->redirect() );
			exit();
		}
	}
	
	function admin_logout()
	{  
		$this->Session->del('Permissions');  
		$this->redirect($this->Auth->logout());  
	}  
	
	
	function admin_index() 
	{
		$this->User->recursive = -1; 	
		$user = $this->paginate('User', 'User.active = 1 || User.active = 0');
		$this->set('users', $user);
	}

	function admin_view($id = null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() 
	{
		if (!empty($this->data)) {
			$this->User->create();
			$this->__convertPasswords();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
				$this->data['User']['passwd'] = null;
				$this->data['User']['confirm_passwd'] = null;
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (empty($this->data)) {
	        $this->data = $this->User->read(null, $id);
			$this->data['User']['passwd'] = null;
	    } else {
			$this->__convertPasswords();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
				$this->data['User']['passwd'] = null;
				$this->data['User']['confirm_passwd'] = null;
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * Custom function to soft delete users
	 * user will be sent to trash 
	 * I use custom query because saveField() function wont work :P
	 * 
	 * @params $id - the id of the user being deleted
	 * @return active = -2 when deleted
	**/
	function admin_delete($id = null) 
	{
		if(!$id) {
			$this->Session->setFlash(__("Invalid User", true));
			$this->redirect(array('action' => 'index'), null, true);
		}
		// update the active field set to -2
		$this->User->saveField('active', '-2');
		$this->Session->setFlash(__("Sending user to trash bin successful", true));
		// redirect to user index
		$this->redirect(array('action'=>'index'), null, true);
	}
	
	/**
	* Get a hashed value of submitted password which we will enter into database.
	* This value will use the Auth component hash technique 
	* user login submission. 
	*
	* @access private
	* @returns null
	*/
	function __convertPasswords()
	{
	    if(!empty( $this->data['User']['new_passwd'] ) ){
		    $this->data['User']['new_passwd_hash'] = $this->Auth->password( $this->data['User']['new_passwd'] );
		}
	}
//for the lates user added - shown at admin main page
//limit to 5 users
function getLatestItems() {
		return $this->User->find('all', array('order' => 'User.created DESC', 'limit' => 5));
	}
}

?>
