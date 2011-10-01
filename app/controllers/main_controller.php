<?php
/**
 * Controller for administration of CamiroCMS
 *
 * This file will render views from views/admin/
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
 
class MainController extends AppController
{
	var $name = 'Main';
	var $uses = array('User');

	//override beforefilter to allow 'index' action in admin main
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	/**
	 * This function is not yet finish. Will add some stuff here later
	 * For now it just allows Authors and Admins to enter the backend
	**/
	function admin_index()
	{
		if(!$this->Auth->user()) {
			$this->redirect('/admin/users/login/');
			exit();
		} else {
			//do nothing procceed
		}
	}

	function index() 
	{
		$this->redirect('/admin/users/login/');
		exit();
	}
}

?>
