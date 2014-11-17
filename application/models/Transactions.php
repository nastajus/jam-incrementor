<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 14/11/2014
 * Time: 5:52 PM
 */

class Transactions extends CI_Model implements ISUD{

    function Insert($data)
    {
        $this->db->insert('transactions',$data);
        return $this->db->insert_id();
    }

    function Select($id)
    {
        // TODO: Implement Select() method.
    }

    function SelectAll()
    {
        // TODO: Implement SelectAll() method.
    }

    function Update($id, $data)
    {
        // TODO: Implement Update() method.
    }

    function Delete($id)
    {
        // TODO: Implement Delete() method.
    }
}