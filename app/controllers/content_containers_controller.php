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
class ContentContainersController extends AppController {
	var $name = 'ContentContainers';
	var $helpers = array('Fck');
	
	/**
	 *Override app_controller.php beforeFilter function to allow content pages viawable at frontpage
	 * without the nedd to login (guest users)
	 **/
	function beforeFilter() {
	
		parent::beforeFilter();
		/** Add other functions in the elements 'index', 'view', 'others', 'etc' **/
		$this->Auth->allow('index', 'view');
		
	}
	
	//eto dinagdag ko... eto din yung kahapon <--- english dude, english
	// Please use proper indention/spacing of syntax
	function admin_index($id = null) {
	
		if($id){
			//Show Only Child Containers
			$contentcontainers = $this->ContentContainer->find('all', 
						array(
							'conditions' => array('ContentContainer.parent_id' => $id),
							'order' => 'lft ASC'
							)
						);
		} else {
			//Show Only Sections (Containers who have no Parents)
			$contentcontainers = $this->ContentContainer->find('all', 
						array(
							'conditions' => array('ContentContainer.parent_id' => '0'),
							'order' => 'lft ASC'
							)
					);
		}

		$this->set('contentcontainers', $contentcontainers);
		$this->set('parentContainer', $this->ContentContainer->read(null, $id));
	
	}
	
	function index($id = null) {

		$this->ContentContainer->recursive = 0;
		if($id){
			//Show Only Child Containers
			$contentcontainers = $this->ContentContainer->find('all', 
							array(
								'conditions' => array('ContentContainer.parent_id' => $id)
								));
			$currentContainerName = $this->ContentContainer->find('all', 
							array('conditions' => array('ContentContainer.id' => $id)
								));
			$currentview = 'You are inside: '.$currentContainerName['0']['ContentContainer']['title'];
			
			//Try to populate only if Child Container
			$pathway = $this->ContentContainer->getpath();
			$this->set('pathway', $pathway);

		} else {
			//Show Only Sections (Containers who have no Parents)
			$contentcontainers = $this->ContentContainer->find('all', 
						array('conditions' => array('ContentContainer.parent_id' => '0')
							));
			$currentview = "Showing Main Containers";
		}	
		$this->set('contentcontainers', $contentcontainers);
		$this->set('currentview', $currentview);

		/**
		The following code is for the RSS Feeds
		**/
		//Required to Get the Containers Description for the RSS Feed
		$parent = $this->ContentContainer->getparentnode($id);
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
				'link' => array('controller' => 'content_containers', 'action' => 'index', 'ext' => 'rss'),
				'url' => array('controller' => 'content_containers', 'action' => 'index', 'ext' => 'rss'),
				'description' => "$feed_description",
				'language' => 'en-us');
			$rss_data = $contentcontainers;
			$this->set('rss_data', $rss_data);
			$this->set(compact('channelData', 'rss_data'));
	}

	/** I think view action is not needed here
	//Displays specific Items
	function view($id) {
		$contents = $this->ContentContainer->find('all', 
				array('conditions' => array('ContentContainer.id' => $id)
					));
		$this->set('contentcontainers', $contentcontainers);
		$this->set('id', $id);
	}
	**/
	
	//Add content - admin side
	function admin_add() {
	
		if (!empty($this->data)) {
			$this->ContentContainer->create();
		if ($this->ContentContainer->save($this->data)) {
			$this->Session->setFlash('The Containaer has been saved!');
			$this->redirect(array('action'=>'index'), null, true);
		} else {
			$this->Session->setFlash('Content not saved. Try again.');
			}
		}
		
		$groups = $this->ContentContainer->Group->find('list');
		$this->set(compact('groups'));
		$this->set('currentview', 'Container:: Add');
		$this->set('parentContainer', $this->ContentContainer->generatetreelist(null, null, null, '->'));
		$this->render('admin_edit');
	}
	
//Edit content - admin side (no validation rule yet)
	function admin_edit($id = null) {
		
		if (empty($this->data)) {
			$this->set('content_containers', $this->ContentContainer->findAll()); 
			$this->data = $this->ContentContainer->read(null, $id);
		} else {
				//$this->ContentContainer->id = $id;
				$con = $this->ContentContainer->findById($id);
				$id = $con['ContentContainer']['parent_id'];
			if ($this->ContentContainer->save($this->data)) {
				$this->Session->setFlash(__("Saving successful ", true), true);
				$this->redirect(array('action' => 'index', $id), null, true);
			} else {
				$this->Session->setFlash(__("Could not save container.", true), true);
			}
		}
		
		$groups = $this->ContentContainer->Group->find('list');
		$this->set(compact('groups'));
		//Add Blank Option for Main Containers
		//$parentContainer['0'] = 'Main Container';
		//$this->set(compact('content_containers'));
		$this->set('parentContainer', $this->ContentContainer->generatetreelist(null, null, null, '->'));
		$this->set('currentview', 'Container:: Edit');
	}

	//Delete content - admin side (careful)
	// TODO: soft delete containers
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Content');
			$this->redirect(array('action'=>'admin_index'), null, true);
		}
		
		// check for children container inside parent container
		$contentItems = $this->ContentContainer->children($id);
		//if children is found then abort delete
		if($contentItems) {
			$this->Session->setFlash(__("Could not delete container. Delete all children container first!.", true));
		} else {
			// else empty then proceed with the deletion
			if ($this->ContentContainer->del($id)) {
				$this->Session->setFlash('Container #'.$id.' deleted');
			}
		}
		// redirect everyone to index
		$this->redirect(array('action'=>'index'), null, true);
	}

	//for the view function - experimental stage
	function admin_view($id = null) {
		// view file not needed for containers
	}
	
	function admin_movedown($title = null, $delta = null) {
        $con = $this->ContentContainer->findByTitle($title);
        if (empty($con)) {
            $this->Session->setFlash('There is no container named ' . $title);
            $this->redirect(array('action' => 'admin_index'), null, true);
        }
        
        $this->ContentContainer->id = $con['ContentContainer']['id'];
        
        if ($delta > 0) {  
            $this->ContentContainer->moveDown($this->ContentContainer->id, abs($delta));
			$this->Session->setFlash("Moving Down Container Successful");
        } else {
            $this->Session->setFlash('Please provide the number of positions the field should be moved down.'); 
        }
		
		$id = $con['ContentContainer']['parent_id'];	
        $this->redirect(array('action' => 'admin_index' , $id), null, true);
		
    }
	
	function admin_moveup($title = null, $delta = null){
       $con = $this->ContentContainer->findByTitle($title);
        if (empty($con)) {
            $this->Session->setFlash('There is no container named ' . $title);
            $this->redirect(array('action' => 'admin_index'), null, true);
        }
        
        $this->ContentContainer->id = $con['ContentContainer']['id'];
        
        if ($delta > 0) {  
            $this->ContentContainer->moveup($this->ContentContainer->id, abs($delta));
			$this->Session->setFlash("Moving Up Container Successful");
        } else {
            $this->Session->setFlash('Please provide the number of positions the field should be moved down.'); 
        }
		$id = $con['ContentContainer']['parent_id'];
        $this->redirect(array('action' => 'admin_index', $id), null, true);
    }
function getLatestItems() {
		return $this->ContentContainer->find('all', array('order' => 'ContentContainer.title DESC', 'limit' => 5));
	}
}
?>
