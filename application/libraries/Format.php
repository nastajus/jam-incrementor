<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 14/11/2014
 * Time: 6:14 PM
 */

class Format {

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

    static function User($username, $password, $email){
        //record IP here?
        return array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email,
            'date' => Format::GetGMT()
        );
    }
}