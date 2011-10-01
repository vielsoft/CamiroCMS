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
class MenuContainer extends AppModel {
	var $name = 'MenuContainer';
	// put code here for validation
	var $validate = array(
	//title field
	'name' => array(
			'minlength' => array(
			'rule' => array('minlength', '3'),
			'message' => 'Menu Title must contain at least 3 characters'
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
	//ordering field		
	'ordering' => array(
			'Numeric' => array(
			'rule' => 'Numeric',
			'message' => 'Numbers only'
			),
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
			),
	//properties field		
	'properties' => array(
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
