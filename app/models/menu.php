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
class Menu extends Appmodel {
	var $name = 'Menu';
	var $validate = array(
		//name field
		'name' => array(
			/* - how to contain white spaces?
			'alphanumeric' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'message' => 'Alphabets and numbers only'
			),
			*/
			'minlength' => array(
				'rule' => array('minlength', '3'),
				'message' => 'Menu Name must contain at least 3 characters'
			)
		),
		//link field		
		'link' => array(
			// code to accept white space
			'minlength' => array(
				'rule' => array('minlength', '1'),
				'message' => 'Entry required'
			)
		),
		//state field		
		'state' => array(
			'Numeric' => array(
				'rule' => 'Numeric',
				'message' => 'Numbers only'
			),
			'minlength' => array(
				'rule' => array('minLength', '1'),
				'message' => 'Entry required'
			)
		),
		//parentid field		 
		'parentid' => array(
			'Numeric' => array(
				'rule' => 'Numeric',
				'message' => 'Numbers only'
			),
			'minlength' => array(
				'rule' => array('minLength', '1'),
				'message' => 'Entry required'
			)
		),
		//container field		
		'container' => array(
			'minlength' => array(
				'rule' => array('minLength', '1'),
				'message' => 'Entry required'
			)
		),
		//ordering field		
		'ordering' => array(
			'minlength' => array(
				'rule' => array('minLength', '1'),
				'message' => 'Entry required'
			)
		),
		//access field		
		'access' => array(
			'Numeric' => array(
				'rule' => 'Numeric',
				'message' => 'Numbers only'
			),
			'minlength' => array(
				'rule' => array('minLength', '1'),
				'message' => 'Entry required'
			)
		)
	);
	 var $belongsTo = array(
		'Group' =>
			array('className'    => 'Group',
				'conditions'   => '',
				'order'        => '',
				'dependent'    =>  true,
				'foreignKey'   => 'access'
			),
		'MenuContainer2' =>
			array('className'    => 'MenuContainer',
				'conditions'   => '',
				'order'        => '',
				'dependent'    =>  true,
				'foreignKey'   => 'parentid'
			)
	);
	
}
?>