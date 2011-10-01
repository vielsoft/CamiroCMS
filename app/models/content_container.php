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
class ContentContainer extends AppModel {
	var $name = 'ContentContainer';
	var $actsAs = array('Tree', 'Containable');
	// put code here for validation


    var $belongsTo = array(
		'Group' =>
                        array('className'    => 'Group',
                              'conditions'   => '',
                              'order'        => '',
                              'dependent'    =>  true,
                              'foreignKey'   => 'access'
                        )
		);
		
}
?>
