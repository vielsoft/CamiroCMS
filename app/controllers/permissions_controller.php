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
class PermissionsController extends AppController {

	var $name = 'Permissions';

	function admin_index() {
		$this->Permission->recursive = -1;
		$this->set('permissions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Permission.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('permission', $this->Permission->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Permission->create();
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The Permission has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Permission could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Permission', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The Permission has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Permission could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permission->read(null, $id);
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Permission', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Permission->del($id)) {
			$this->Session->setFlash(__('Permission deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>