<?php 
/**
 * Model for User 
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
class User extends AppModel {
    var $displayField = 'email_address';
    var $name = 'User';
	var $actsAs = array(
			'Slug' => array(
				'separator' => '-', 
				'overwrite' => true,
				'translation' => 'utf-8')
			); 
	
	var $validate = array(
	       'name' => array(
		       'rule' => array('minlength', 3),
			   'message' => "You must enter the users real name"
			   ),
	       'email_address' => array(
		           'rule' => array('email'),
				   'message' => 'Please make sure you have entered a valid email address'
				),			
           'new_passwd' => array(
				'between' => array(
					'rule' => array('between', 7, 20),
					'allowEmpty' => true,
					'message' => 'You password must be between 7 and 20 characters long'
					),
		       'equalTo' => array(
			       'rule' => array('equalTo', 'confirm_passwd' ),
				   'message' => 'Please re-enter your password twice so that the values match'
				   )
				)
        );
		
    var $hasAndBelongsToMany = array(
            'Group' => array('className' => 'Group',
                        'joinTable' => 'groups_users',
                        'foreignKey' => 'user_id',
                        'associationForeignKey' => 'group_id',
                        'unique' => true
            )
    );
	
	
		/**
	 * Validates email and username first before proceeding the registration
	*/
	function beforeValidate() 
	{
		if (!$this->id) {
			if ($this->findCount(array('User.email_address' => $this->data[$this->name]['email_address'])) > 0) {
				$this->invalidate('email_address');
				return false;
			}
		}
		return true;
	}
	
	function beforeSave(){
	    $this->setNewPassword();
		return true;
	}
	
    /**
	 * sets the password to be equal to the verified value from the temporary password field
	 */
	function setNewPassword()
	{
	    if( !empty( $this->data['User']['new_passwd_hash'] ) ){
		    $this->data[$this->name]['passwd'] = $this->data['User']['new_passwd_hash'];
		}
		return TRUE;
	}
	
	    /**
	 * Overrides core equalTo() to verify that two form fields are equal
	 */
	function equalTo( $field=array(), $compare_field=null ) 
	{
		foreach( $field as $key => $value ){
			$v1 = $value;
			$v2 = $this->data[$this->name][ $compare_field ];
            if($v1 !== $v2) {
			    return FALSE;
		    } else {
		       continue;
		    }
		}
		return TRUE;

    }
	
	
}

?>
