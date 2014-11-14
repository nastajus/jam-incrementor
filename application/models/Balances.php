<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 14/11/2014
 * Time: 5:52 PM
 */

class Balances extends CI_Model implements ISUD{

    function Insert($data)
    {
        $this->db->insert('balances',$data);
        return $this->db->insert_id();
    }

    function Select($id)
    {
        $query = $this->db->get_where('balances', array('id' => $id), 1, 0);
        return $query->db->result_array();
    }

    function SelectAll()
    {
        $query = $this->db->get('balances');
        return $query->db->result_array();
    }

    function Update($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('balances', $data);
        return $query->db->result_array();
    }

    function Delete($id)
    {
        // TODO: Implement Delete() method.
    }
}