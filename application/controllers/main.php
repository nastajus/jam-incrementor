<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function Login(){

        if($this->input->post()){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

            if ($this->form_validation->run() == TRUE)
            {

                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->load->model('users');

                $cond = $this->users->Login($username, $password );

                if ($cond){

                    //$this->load->view('formsuccess');
                    //They were right send them to the members page
                    $this->load->view('header');
                    //echo var_dump($this->input->post());
                    //echo validation_errors();
                    $this->load->view('successpage');
                    $this->load->view('footer');

                }
                else {

                    //They did it wrong send them back to login
                    $this->load->view('header');
                    //echo var_dump($this->input->post());
                    //echo validation_errors();
                    echo "<br>Wrong username or password<br>";
                    $this->load->view('loginpage');
                    $this->load->view('footer');

                }


            }
            else
            {
                //$this->load->view('myform');

                //They did it wrong send them back to login
                $this->load->view('header');
                //echo var_dump($this->input->post());
                //echo validation_errors();
                echo "<br>Invalid input<br>";
                $this->load->view('loginpage');
                $this->load->view('footer');
            }


        }else{
            $this->load->view('header');
            $this->load->view('loginpage');
            $this->load->view('footer');
        }
    }

    function Register(){

    }

}