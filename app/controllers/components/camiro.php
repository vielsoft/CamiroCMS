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
class CamiroComponent extends Object {
	var $name = 'Camiro';
	var $components = array('Auth'); 
	
	/**
	* Checks if logged in user has same id as one being edited or viewed
	*
	* @params string $recordId the id of the record being accessed
	* @returns boolean True if logged in User id is same as id being edited
	*/
	function checkUsersOwnRecord($recordId = null)
	{
		if( $this->Auth->user('id') == $recordId ){
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>