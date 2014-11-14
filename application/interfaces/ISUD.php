<?php
/**
 * Created by PhpStorm.
 * User: IAN
 * Date: 13/11/2014
 * Time: 7:13 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


interface ISUD  //SQL: Insert, Select, Update, Delete
{
    function Insert($data);  //always return $id

    function Select($id);

    function SelectAll();

    function Update($id, $data);

    function Delete($id);   //rarely to never use
}