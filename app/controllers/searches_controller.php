<?php
/**
 * Controller for Searches 
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
class SearchesController extends AppController {

	var $name = 'Searches';
	var $helpers = array('Text');
	var $uses = array('Content');
	var $paginate = array('limit' => '10','order' => array('Content.created' => 'DESC'));

/* *
* Override beforeFilter at app_controller.php to allow listed actions without the need to login
*
*@params $this->Auth->allow()''
* @access public
**/
	function beforeFilter() {	
	
		parent::beforeFilter();
		$this->Auth->allow('search');	
	
	}
	
/**
 * Search action
 *
 * searches for matched keywords
 * @return Null of no keyword match
**/	
	function search() {
	
		// set $keyword as data field
		$keyword = $this->data['Search']['keyword'];
		$operator = "LIKE";
		$wildcard = "%";

		if(isset($this->data['Search']['exact']) AND $this->data['Search']['exactflag'] == '1'){
			$filter = "(Content.title {$operator} \"{$wildcard}".$keyword."{$wildcard}\") OR 
				(Content.contentbody {$operator} \"{$wildcard}".$keyword."{$wildcard}\") OR 
				(Content.metakey {$operator} \"{$wildcard}".$keyword."{$wildcard}\") OR 
				(Content.metadesc {$operator} \"{$wildcard}".$keyword."{$wildcard}\")";
			
		} else {
			$keywords = explode(" ",$keyword);
			$keyword_count = count($keywords);
			$counter = 0;
			$filter = '';
			foreach($keywords as $words){
				$counter ++;
				if($counter == $keyword_count){
					$or = "";
				} else {
					$or = "OR";
				}
				$filter .= "(Content.title {$operator} \"{$wildcard}".$words."{$wildcard}\") OR 
					(Content.contentbody {$operator} \"{$wildcard}".$words."{$wildcard}\") 	OR 
					(Content.metakey {$operator} \"{$wildcard}".$words."{$wildcard}\") OR 
					(Content.metadesc {$operator} \"{$wildcard}".$words."{$wildcard}\") $or";
			}

		}



		// sql filter query to get keyword match
		$filters = array("Content.state = 1 AND ($filter)");
		$this->pageTitle = "Searching results for [".$keyword."]";
		$this->set("foundItems", $this->paginate('Content', $filters));
	}
	
}
?>
