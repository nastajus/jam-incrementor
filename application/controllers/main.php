<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function Login(){
        if($this->input->post()){
            $this->load->view('header');
            echo var_dump($this->input->post());
            $this->load->view('loginpage');
            $this->load->view('footer');
        }else{
            $this->load->view('header');
            $this->load->view('loginpage');
            $this->load->view('footer');
        }
    }

}