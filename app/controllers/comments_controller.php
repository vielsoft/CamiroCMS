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
class CommentsController extends AppController {
	var $name = 'Comments';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');

	function admin_index() {
	$this->set('comments', $this->Comment->find('all', array('order' => 'Comment.created DESC')));
	}
	
	function admin_add() {
	if (!empty($this->data)) {
	$this->Comment->create();
	if ($this->Comment->save($this->data)) {
	$this->Session->setFlash('Comment saved');
	$this->redirect(array('action'=>'index'), null, true);
	} else {
	$this->Session->setFlash('Comment not saved. Try again.');
			}
		}
	}
	function add($id=null) {
	if (!empty($this->data)) {
	$this->Comment->create();
	if ($this->Comment->save($this->data)) {
	$this->Session->setFlash('Comment saved');
	//ToDo:: work with this redirect....
	$this->redirect(array('controller'=>'contents', 'action'=>'view'), $slug, true);
	} else {
	$this->Session->setFlash('Comment not saved. Try again.');
			}
		}
	}
	
//	
//we could remove the admin_add.ctp, like we did in contents, etc...reuse the code..help pls.
//
	function admin_edit($id = null) {
	if (!$id) {
	$this->Session->setFlash('Invalid Comment');
	$this->redirect(array('action'=>'index'), null, true);
	}
	if (empty($this->data)) {
	$this->data = $this->Comment->find(array('Comment.id' => $id));
	} else {
	if ($this->Comment->save($this->data)) {
		$this->Session->setFlash('Comment saved');
		$this->redirect(array('action'=>'index'), null, true);
	} else {
		$this->Session->setFlash('Comment not saved.
					Please, try again.');
			}
		}
	$contents = $this->Comment->Content->find('list');
	}
	
	function admin_delete($id = null) {
	if (!$id) {
	$this->Session->setFlash('Invalid id for Comment');
	$this->redirect(array('action'=>'index'), null, true);
	}
	if ($this->Comment->del($id)) {
	$this->Session->setFlash('Comment #'.$id.' deleted');
	$this->redirect(array('action'=>'index'), null, true);
		}
	}
}
?>
