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

    //move this function to main.php controller when complete.
    public function Register(){

        if($this->input->post()){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_space_check|min_length[3]|max_length[32]|alpha_numeric|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|matches[passconf]|min_length[8]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback__space_check|xss_clean');
            $this->form_validation->set_rules('agree', '', 'callback_accept_terms' );

            if ($this->form_validation->run()){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');

                $this->load->model('users');
                $this->load->library('format');

                $success_id = $this->users->Insert(Format::User($username, $password, $email));

                if ($success_id){

                    $this->load->model('transactions');
                    $this->transactions->Insert( Format::Transaction($success_id, 100, "CREDIT") );


                    $data['message']= "Successfully Registered!!!";
                    $this->load->view('header');
                    $this->load->view('Message',$data);
                    $this->load->view('footer');


                }
                else {
                    $data['message']= "Error Registering" . "<br/>" . $this->form_validation->error_string();
                    $this->load->view('header');
                    $this->load->view('registerpage',$data);
                    $this->load->view('footer');
                }

            }else {
                $data['message']= "Error Registering" . "<br/>" . $this->form_validation->error_string();
                $this->load->view('header');
                $this->load->view('registerpage',$data);
                $this->load->view('footer');
            }

        }
        else {
            $this->load->view('header');
            $this->load->view('registerpage');
            $this->load->view('footer');

        }
    }

    function space_check($str)
    {

        $pattern = '/ /';
        $result = preg_match($pattern, $str);

        if ($result)
        {
            $this->form_validation->set_message('space_check', 'The %s field can not have spaces.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function accept_terms(){
        if (isset($_POST['accept'])) return TRUE;
        $this->form_validation->set_message('accept_terms', 'Please read and accept our terms and conditions.');
        return FALSE;

    }

    function Contact(){
        $this->load->view('header');
        $this->load->view('contact');
        $this->load->view('footer');
    }
    function About(){
        $this->load->view('header');
        $this->load->view('about');
        $this->load->view('footer');
    }
    function Faq(){
        $this->load->view('header');
        $this->load->view('faq');
        $this->load->view('footer');
    }

  

}