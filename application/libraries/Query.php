<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 14/11/2014
 * Time: 6:14 PM
 */

class Query {

    static function GetGMT(){
        $CI =& get_instance();
        $CI->load->helper('date');
        $now = time();
        $gmt = local_to_gmt($now);
        return date('Y-m-d H:i:s',$gmt);
    }


    static function Balance(){
        return array(

        );
    }

    static function Generator(){
        return array(

        );
    }

    static function User($username, $password, $salt, $email){
        return array(
            'username' => $username,
            'password' => $password,
            'salt' => $salt,
            'email' => $email,
            'date' => Query::GetGMT()
        );
    }
}