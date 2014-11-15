<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function Login(){
        if($this->input->post()){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                //$this->load->view('myform');

                //They did it wront send tem back to login
                $this->load->view('header');
                echo var_dump($this->input->post());
                echo validation_errors();
                $this->load->view('loginpage');
                $this->load->view('footer');
            }
            else
            {
                //$this->load->view('formsuccess');
                //Ther wew right send tem to the members page
                $this->load->view('header');
                echo var_dump($this->input->post());
                echo "Great success!";
                $this->load->view('loginpage');
                $this->load->view('footer');
            }


        }else{
            $this->load->view('header');
            $this->load->view('loginpage');
            $this->load->view('footer');
        }
    }

}