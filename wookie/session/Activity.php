<?php

class Activity {

    static $singleton;

    public function __construct() {
        session_start();
    }

    public static function init() {
		if ( Activity::$singleton == null) {

			// create new object
			Activity::$singleton = new Activity();
		}

		return Activity::$singleton;
	}

    public function checkLogin($ops = array(), $redirect = '/home/?alert=need_login') {
        foreach($ops as $i) {
            if(!isset($_SESSION[$i])) {
                redirect($redirect);
            }
        }
    }

    public function setData( $key , $value ) {
        $_SESSION[$key] = $value; return $this;
    }

    public function getData( $key ) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function remove($key = "") {
        unset($_SESSION[$key]);
    }

    public function destory() {
        $_SESSION = array();
    }
}

Activity::init();
