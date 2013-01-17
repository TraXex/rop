<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

    var $components = array('Session', 'SparkPlug.Authsome' => array('model' => 'User'));
    var $uses = array('SparkPlug.UserGroup');

    function beforeFilter() {
        parent::beforeFilter();
        SparkPlugIt($this);
//        $this->Auth->authorize = 'controller';
//        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
//        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
//        $this->Auth->logoutRedirect = '/';
    }

//    function isAuthorized() {
//        return true;
//    }
}
