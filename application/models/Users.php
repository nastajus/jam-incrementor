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
        $this->db->from('user');
        $this->db->where('username', $username);

        $query = $this->db->get();
        $result = $query->result();
        //If we get more then one
        if ($query->num_rows() == 1) {

            $salt = $result[0]->salt;


            $this->db->select('id, username, password');
            $this->db->from('user');
            $this->db->where('username', $username);
            $this->db->where('password', hash('sha512',$password.$salt));
            $this->db->limit(1);


            $query = $this->db->get();



            return $query->result();
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