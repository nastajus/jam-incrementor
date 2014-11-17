<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
    public function loginCheck() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model("users");
            $data['session_data'] = $this->session->userdata('logged_in');
            $data['username'] = $data['session_data']['username'];

            
        } else {
            //If no session, redirect to login page
            header('location: home');
        }
    }
    function dashboard(){
        $data = $this->loginCheck();
        $this->load->view('header');
        $this->load->view('members/dashboard');
        $this->load->view('footer');
    }
    function inventory(){
        $data = $this->loginCheck();
        $this->load->view('header');
        $this->load->view('members/inventory');
        $this->load->view('footer');
    }
    function store(){
        $data = $this->loginCheck();
        $this->load->view('header');
        $this->load->view('members/store');
        $this->load->view('footer');
    }
    function logout(){
        
    }
    function settings(){
        $data = $this->loginCheck();
    }
    function withdraw(){
        
    }
    function deposit(){
        
    }
}