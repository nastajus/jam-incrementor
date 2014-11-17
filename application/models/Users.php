<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 14/11/2014
 * Time: 5:52 PM
 */

class Users extends CI_Model implements ISUD{

    function Login($username, $password)
    {
        //Get Salt
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);

        $query = $this->db->get();
        $result = $query->result_array(); //contains combo hash salt per here: http://php.net/manual/en/faq.passwords.php#faq.password.storing-salts

        if ($query->num_rows() == 1) {

            $comboHashSalt = $result[0]['password'];
            if ( password_verify($password, $comboHashSalt) ) {
                return $query->result();
            }

            return false;
        } else {

            return false;
        }

    }


    function Insert($data)
    {
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    function Select($id)
    {
        $query = $this->db->get_where('users', array('id' => $id), 1, 0);
        return $query->db->result_array();
    }

    function SelectAll()
    {
        $query = $this->db->get('users');
        return $query->db->result_array();
    }

    function Update($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('users', $data);
        return $query->db->result_array();
    }

    function Delete($id)
    {
        // TODO: Implement Delete() method.
    }
}