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
class Content extends AppModel {
	var $name = 'Content';
	var $hasMany = array('Comment');
	var $actsAs = array(
			'Slug' => array(
				'separator' => '-', 
				'overwrite' => true,
				'translation' => 'utf-8'),
			'Containable'
			); 
	
	var $validate = array(
	//title field
	'title' => array(
			'minlength' => array(
			'rule' => array('minlength', '3'),
			'message' => 'Content Title must contain at least 3 characters'
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
		'User' =>
                        array('className'    => 'User',
                              'conditions'   => '',
                              'order'        => '',
                              'dependent'    =>  true,
                              'foreignKey'   => 'created_by'
                        ),
		'ContentContainer' =>
                        array('className'    => 'ContentContainer',
                              'conditions'   => '',
                              'order'        => '',
                              'dependent'    =>  true,
                              'foreignKey'   => 'parent_id'
                        )
		);

function beforeValidate() {
		//check for parent id if parsed and is numeric
        if (isset($this->data[$this->name]['parentid']) && !is_numeric($this->data[$this->name]['parentid'])) {
            $this->data[$this->name]['parent_id'] = null;
        }
        
        // do not allow space on our titles
        if (isset($this->data[$this->name]['title'])) {
        	$this->data[$this->name]['title'] = trim($this->data[$this->name]['title']);
        }
        
        return true;
    }
	
}
?>
