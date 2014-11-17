<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
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
    //Home Page
    function index(){
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }
    
    function home(){
        $this->index();
    }

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
                echo var_dump($cond);
                if ($cond){
                    $sess_array = array();
                    foreach($cond as $row)
                    {
                      $sess_array = array(
                        'id' => $row->id,
                        'username' => $row->username
                      );
                      $this->session->set_userdata('logged_in', $sess_array);
                    }
                    header('location: members/dashboard');

                }
                else {
                    $this->load->view('header');
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
        $this->load->view('header');
        $this->load->view('register');
        $this->load->view('footer');
    }
    
  

}