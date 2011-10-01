<?php
/**
 * Camiro App Controllert 
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
 
class AppController extends Controller {
	
    var $components = array('Auth', 'Cookie');
	var $helpers = array('Html', 'Form', 'Time', 'Ajax', 'Javascript');
	var $admin = array();

	/**
	 * Configures the items that appear on the site's menu
	 */
	var $menu = array();
	
	/**
	 * Main admin menus
	 * 
	 * @access public
	 * $returns true if the user has permission
	**/
	var $menuItems = array(
	    array(
		    'restricted' => TRUE, 
			'label' => 'Deleted Items',
			'controller' => 'trash',
			'url' => '#',
			'rel' => 'dropmenu1_a'
			),
	    array(
		    'restricted' => TRUE, 
			'label' => 'Users and Permissions',
			'controller' => 'users',
			'url' => '#',
			'rel' => 'dropmenu2_a'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Contents',
			'controller' => 'contents',
			'url' => '#',
			'rel' => 'dropmenu3_a'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Menus',
			'controller' => 'menus',
			'url' => '#',
			'rel' => 'dropmenu4_a'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Comments',
			'controller' => 'comments',
			'url' => '/admin/comments/',
			'rel' => 'dropmenu5_a'
			),
		);
	/**
	 * Sub menus for Recycle Bin menu
	 * 
	 * @access public
	 * $returns true if the user has permission
	**/
	var $menuRecycleSub = array(
	    array(
		    'restricted' => TRUE, 
			'label' => 'Users',
			'controller' => 'trash',
			'url' => '/admin/trash/users/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Contents',
			'controller' => 'trash',
			'url' => '/admin/trash/contents/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Menus',
			'controller' => 'trash',
			'url' => '/admin/trash/menus/'
			),
		);
		
	/**
	 * Sub menus for ACL management menu
	 * 
	 * @access public
	 * $returns true if the user has permission
	**/
	var $menuACLSub = array(
	    array(
		    'restricted' => TRUE, 
			'label' => 'Users',
			'controller' => 'users',
			'url' => '/admin/users/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Groups',
			'controller' => 'groups',
			'url' => '/admin/groups/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Permissions',
			'controller' => 'permissions',
			'url' => '/admin/permissions/'
			),
		);

	/**
	 * Sub menus for content menu
	 * 
	 * @access public
	 * $returns true if the user has permission
	**/
	var $menuContentSub = array(
	    array(
		    'restricted' => TRUE, 
			'label' => 'Content Items',
			'controller' => 'contents',
			'url' => '/admin/contents/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Content Containers',
			'controller' => 'content_containers',
			'url' => '/admin/content_containers/'
			)
		);

	/**
	 * Sub menus for Menu menu
	 * 
	 * @access public
	 * $returns true if the user has permission
	**/
	var $menuMenuSub = array(
	    array(
		    'restricted' => TRUE, 
			'label' => 'Menu Items',
			'controller' => 'menus',
			'url' => '/admin/menus/'
			),
		array(
		    'restricted' => TRUE,
			'label' => 'Menu Containers',
			'controller' => 'content_containers',
			'url' => '/admin/menu_containers/'
			)
		);


		
	
  /**
     * beforeFilter
     * 
     * Application hook which runs prior to each controller action
     * 
     * @access public 
     */
    function beforeFilter() {
	
		//Call language localization
		uses('L10n');	
		$this->L10n = new L10n();
		$this->L10n->get("en");
		Configure::write('Config.language', "en");
		
		// check authorization 
		$this->checkAuth();  
		
		// login user using stored cookie for front end users only
		if ( !$this->Auth->user('id') ) {
			$cookie = $this->Cookie->read('User');
			if ( $cookie ) {
				$this->Auth->login( $cookie );
			}
		}
		//Load Configuration File
		if(include('config/config.inc.php')){
			$this->set('camiroConfig',$camiroConfig);
		} else {
			echo "Warning No Configuration File Found";
		}
    }
    /**
     * beforeRender
     * 
     * Application hook which runs after each action but, before the view file is 
     * rendered
     * 
     * @access public 
     */
    function beforeRender()	{
		$this->__buildMenu();
		$this->__buildMenuACL();
		$this->__buildMenuRecycle();
		$this->__buildMenuContents();
		$this->__buildMenuMenus();
	}
	
	
  /**
     * Sets configuration options for Auth component.
     *
     * @access public
     */
	function checkAuth() {
		if (isset($this->Auth)) {
			//Override default fields used by Auth component
			$this->Auth->fields = array('username'=>'email_address','password'=>'passwd');
			//Set application wide actions which do not require authentication
			$this->Auth->allow('display');
			//Set the default redirect for users who logout
			$this->Auth->logoutRedirect = '/';
			//Set the default redirect for users who login
			$this->Auth->loginRedirect = '/';
			//Extend auth component to include authorisation via isAuthorized action
			$this->Auth->authorize = 'controller';
			//Restrict access to only users with an active account
			$this->Auth->userScope = array('User.active = 1');
			// Set Autorediretion to false
			$this->Auth->autoRedirect = FALSE;
			// Create cookie name
			$this->Cookie->name = 'CamiroCMS';
			// What to say when the login was incorrect.
			$this->Auth->loginError = __("Sorry, login failed.  Either your username or password are incorrect.", true);
			$this->Auth->authError = __("The page you tried to access is restricted. You have been redirected to the page below.", true);
			
			//check if user wants to access admin, if true then change layout
			if(isset($this->params['admin'])) { 
				$this->layout = 'admin';
				//Set the default redirect for users who logout for admin
				$this->Auth->logoutRedirect = '/admin/';
				//Set the default redirect for users who login for admin
				$this->Auth->loginRedirect = '/admin/main/';
			} else {
				//Set the default redirect for users who logout for admin
				$this->Auth->logoutRedirect = '/';
				//Set the default redirect for users who login for admin
				$this->Auth->loginRedirect = '/';
			}
			
			//Pass auth component data over to view files
			$this->set('Auth',$this->Auth->user());
		
		}
	}
  /**
     * isAuthorized
     * 
     * Called by Auth component for establishing whether the current authenticated 
     * user has authorization to access the current controller:action
     * 
     * @return true if authorised/false if not authorized
     * @access public
     */
    function isAuthorized(){
        return $this->__permitted($this->name,$this->action);
    }

  /**
     * Builds a menu adding restricted links, if user is logged in.
     * @access private
     * @returns null
     */
	function __buildMenu()	{
		$this->menu = array();
		if ($this->Auth->user()) {
            foreach($this->menuItems as $menuLink ) {
                if($menuLink <> 'App')	{
					if($this->__permitted($menuLink['controller'],'index')) {
						$this->menu[] = array('label' => $menuLink['label'], 'url' => $menuLink['url'], 'rel' => $menuLink['rel']);
					}
			    } else {
				    continue;
				}
			}
		}
			$this->set('admin_menu', $this->menu);
	}
	
  /**
     * Builds a ACL submenu adding restricted links, if user is logged in.
     * @access private
     * @returns null
     */
	function __buildMenuACL()	{
		$this->menu = array();
		if ($this->Auth->user()) {
            foreach($this->menuACLSub as $menuLink ) {
                if($menuLink <> 'App')	{
					if($this->__permitted($menuLink['controller'],'index')) {
						$this->menu[] = array('label' => $menuLink['label'], 'url' => $menuLink['url']);
					}
			    } else {
				    continue;
				}
			}
		}
			$this->set('acl_menu', $this->menu);
	}

  /**
     * Builds a Recycle Bin submenu adding restricted links, if user is logged in.
     * @access private
     * @returns null
     */
	function __buildMenuRecycle()	{
		$this->menu = array();
		if ($this->Auth->user()) {
            foreach($this->menuRecycleSub as $menuLink ) {
                if($menuLink <> 'App')	{
					if($this->__permitted($menuLink['controller'],'index')) {
						$this->menu[] = array('label' => $menuLink['label'], 'url' => $menuLink['url']);
					}
			    } else {
				    continue;
				}
			}
		}
			$this->set('recycle_menu', $this->menu);
	}

  /**
     * Builds a Contents submenu adding restricted links, if user is logged in.
     * @access private
     * @returns null
     */
	function __buildMenuContents()	{
		$this->menu = array();
		if ($this->Auth->user()) {
            foreach($this->menuContentSub as $menuLink ) {
                if($menuLink <> 'App')	{
					if($this->__permitted($menuLink['controller'],'index')) {
						$this->menu[] = array('label' => $menuLink['label'], 'url' => $menuLink['url']);
					}
			    } else {
				    continue;
				}
			}
		}
			$this->set('content_menu', $this->menu);
	}

  /**
     * Builds a Menus submenu adding restricted links, if user is logged in.
     * @access private
     * @returns null
     */
	function __buildMenuMenus()	{
		$this->menu = array();
		if ($this->Auth->user()) {
            foreach($this->menuMenuSub as $menuLink ) {
                if($menuLink <> 'App')	{
					if($this->__permitted($menuLink['controller'],'index')) {
						$this->menu[] = array('label' => $menuLink['label'], 'url' => $menuLink['url']);
					}
			    } else {
				    continue;
				}
			}
		}
			$this->set('menu_menu', $this->menu);
	}
	
  /**
     * __permitted
     * 
     * Helper function returns true if the currently authenticated user has permission 
     * to access the controller:action specified by $controllerName:$actionName
     * @return 
     * @param $controllerName Object
     * @param $actionName Object
     */
    function __permitted($controllerName,$actionName){
        //Ensure checks are all made lower case
        $controllerName = low($controllerName);
        $actionName = low($actionName);
        //If permissions have not been cached to session...
        if(!$this->Session->check('Permissions')){
            //...then build permissions array and cache it
            $permissions = array();
            //everyone gets permission to logout
            $permissions[]='users:logout';
            //Import the User Model so we can build up the permission cache
            App::import('Model', 'User');
            $thisUser = new User;
            //Now bring in the current users full record along with groups
            $thisGroups = $thisUser->find(array('User.id'=>$this->Auth->user('id')));
            $thisGroups = $thisGroups['Group'];
            foreach($thisGroups as $thisGroup){
                $thisPermissions = $thisUser->Group->find(array('Group.id'=>$thisGroup['id']));
                $thisPermissions = $thisPermissions['Permission'];
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
            }
            //write the permissions array to session
            $this->Session->write('Permissions',$permissions);
        }else{
            //...they have been cached already, so retrieve them
            $permissions = $this->Session->read('Permissions');
        }
        //Now iterate through permissions for a positive match
        foreach($permissions as $permission){
            if($permission == '*'){
                return true;//Super Admin Bypass Found
            }
            if($permission == $controllerName.':*'){
                return true;//Controller Wide Bypass Found
            }
            if($permission == $controllerName.':'.$actionName){
                return true;//Specific permission found
            }
        }
        return false;
    }
	
}
?>
