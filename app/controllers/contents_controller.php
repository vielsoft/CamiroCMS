<?php
/*
* PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version		1.0 Alpha
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class ContentsController extends AppController {
	var $name = 'Contents';
	var $helpers = array('Fck', 'Text','Ajax', 'Javascript');
	var $cacheAction = array(true, '3 hour');
	var $paginate = array('limit' => 15, 'order' => array('Content.created' => 'DESC'));
	//page for comments
	//var $page = array('limit' => 10, 'order' => array('Comment.created' => 'DESC'));
/**
*Override app_controller.php beforeFilter function to allow content pages viawable at frontpage
* without the nedd to login (guest users)
**/
	function beforeFilter() {	
		parent::beforeFilter();
		/** Add other functions in the elements 'index', 'view', 'others', 'etc' **/
		$this->Auth->allow('index', 'view', 'getLatestItems');
	}
	
	function index($properties = null) {
		$this->Content->contain('User.name');
		
		switch($properties){
			case 'all':
				$contents = $this->Content->find('all',
							array('conditions' => array('Content.state' => '1')
							));
			$currentview = "SHOWING_ALL_ITEMS";
			break;
			case 'front':
				$contents = $this->Content->find('all', 
					array('conditions' => array('Content.properties' => 'frontpage=1', 
										'Content.state' => '1')));
				$currentview = "SHOWING_FRONTPAGE";
			break;

			default:
			$contents = $this->Content->find('all', array('conditions' => array(
						'Content.state' => '1', 'Content.parent_id' => $properties)));
			$currentview = "";
			break;
	}
		//Puts an array of the path based on the tree of current container
		$pathway = $this->Content->ContentContainer->getpath($properties);
		//makes pathway available for view or an element (path_way.ctp)
		$this->set('pathway', $pathway);
		$this->set('contents', $contents);
		$this->set('currentview', $currentview);
		$this->set('properties', $properties);

		/**
		The following code is for the RSS Feeds
		**/
		//Required to Get the Containers Description for the RSS Feed
		$parent = $this->Content->ContentContainer->getparentnode($properties);
		if($parent){
			$feed_description = strip_tags($parent['ContentContainer']['description']);
		} else {
		//ToDo: If Container Description is not available, pull out
		// something from the config like sites description etc..
			$feed_description = "";
		}
			$channelData = array(
				//ToDo: Insert Site Name here to be pulled from config
				'title' => "Camiro-CMS",
				'link' => array('controller' => 'contents', 'action' => 'index', 'ext' => 'rss'),
				'url' => array('controller' => 'contents', 'action' => 'index', 'ext' => 'rss'),
				'description' => "$feed_description",
				'language' => 'en-us');
			$rss_data = $contents;
			$this->set('rss_data', $rss_data);
			$this->set(compact('channelData', 'rss_data'));
	}


//Displays specific Items
	function view($slug) {	
		$this->Content->contain('User.name');
		$contents = $this->Content->find('all', 
				array('conditions' => array('Content.slug' => $slug)));
		$this->set('contents', $contents);
		//Gets  the container ID of the current content item
		$container_id = $this->viewVars['contents'][0]['Content']['parent_id'];
		//Puts an array of the path based on the tree of current container
		$pathway = $this->Content->ContentContainer->getpath($container_id);
		//makes pathway available for view or an element (path_way.ctp)
		$this->set('pathway', $pathway);

//comments ------
//ToDo:: ordering of comments, switch @ content to enable/disable comments, view by latest post
//
$comments = $this->Content->Comment->find('all', array('conditions'=>array('Content.slug'=>$slug)));
$this->set('comments', $comments);
$this->set(compact('contents','comments'));
	}
	
//eto dinagdag ko... eto din yung kahapon
//Hoy! Alj! ang hilig mo mag comment ng tagalog! stof dowing dhat! spik in inglis!!
	function admin_index() {
		$this->Content->contain(array('Group', 'ContentContainer'));
		//check query to search all items with state 1 or 0
		$filters = array('Content.state != -2') ;
		$this->set('contents', $this->paginate('Content', $filters));
	}

//Add content - admin side
	function admin_add() {
		if (!empty($this->data)) {
			$this->Content->create();
			// update created by field using the users id
			$this->Content->saveField('created_by', $this->Auth->user('id'));
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('Saving content item successfull', true));
				$this->redirect(array('action'=>'admin_index'), null, true);
			} else {
				$this->Session->setFlash(__('Error occured while saving. Please try again.', true));
			}
		}
			// get group data
			$groups = $this->Content->Group->find('list');
			$this->set(compact('groups'));
			//get containers
			$this->set('parentContainer', $this->Content->ContentContainer->generatetreelist(null, null, null, '->'));
			$this->set('currentview', 'Content:: Add');
			$this->render('admin_edit'); 
	}
	
//Edit content - admin side (no validation rule yet)
	function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Content'));
			$this->redirect(array('action'=>'admin_index'), null, true);
		}
		if (empty($this->data)) {
			$this->data = $this->Content->find(array('Content.id' => $id));
		} else {
			// update modified_by field
			$this->Content->saveField('modified_by', $this->Auth->user('id'));
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action'=>'admin_index'), null, true);
			} else {
				$this->Session->setFlash(__('Error occured while saving. Please Try again.'));
			}
		}
		$groups = $this->Content->Group->find('list');
		$this->set(compact('groups'));

		//$this->set('content_containers', $this->Content->ContentContainer->findAll()); 
		$this->set('parentContainer', $this->Content->ContentContainer->generatetreelist(null, null, null, '->'));
		$this->set('currentview', 'Content:: Edit');
	}

	//Delete content - admin side (careful)
	//Change to soft delete - Items will be sent to trash bin
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Content'));
			$this->redirect(array('action'=>'admin_index'), null, true);
		}
		//Update state to -2 to hide
		$this->Content->saveField('state', '-2');
		$this->Session->setFlash(__('Trashing content #'.$id.' successful', true));
		//$this->redirect(array('action'=>'admin_index'), null, true);
		$this->redirect(array('action'=>'index'), null , true);
	}
	
	//for the view function - experimental stage
	function admin_view($id = null) {
		//no admin view. not needed co'z its handled already with fckeditor preview button
		//redirect user to content items index page
		$this->redirect(array('controller' => 'contents', 'action' => 'index'), null, true);
	}
	
	/**
	 * Get the latest contents and display in frontpage as a module
	 * displays only the title of the item
	 * see elemet in /modules/mod_latestItems.ctp
	 * @return sql query $condition, $order, $limit
	**/
	function getLatestItems() {
		$condition 	= 'Content.state = 1';
		$order 		= 'Content.created DESC';
		$limit 		= '5';
		return $this->Content->findAll($condition, null, $order, $limit);
	}
	
}
?>
