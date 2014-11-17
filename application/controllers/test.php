<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        //$this->load->view('welcome_message');
        $this->load->view('header');
        $this->load->view('loginpage');
        $this->load->view('footer');

    }

    public function tester(){
        $this->load->model('users');
        $this->load->model('balances');
        $this->load->library('query');

        $this->load->helper('date');
        $now = time();
        $gmt = local_to_gmt($now);
        echo $gmt;
        echo date('Y-m-d H:i:s',$gmt);
        echo print_r(Format::User("victor", "stuff", "please", "i@i.ca"));
        echo var_dump(Format::User("victor", "stuff", "please", "i@i.ca"));

        $this->users->Insert(Format::User("victor", "stuff", "please", "i@i.ca"));
        //$this->balances->Insert()
    }

    //move this function to main.php controller when complete.
    public function testRegister(){

        if($this->input->post()){

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.username]');

            if ($this->form_validation->run()){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');

                $this->load->model('users');

                $cond = $this->users->Insert(Format::User($username, $password, $email));

                if ($cond){
                    $this->load->view('header');
                    $this->load->view('home');
                    $this->load->view('successpage');
                    echo "<br><b>Registered</b><br>";
                    $this->load->view('footer');
                }
                else {
                    $this->load->view('header');
                    //$this->load->view('invalid');
                    echo $this->form_validation->error_string();
                    $this->load->view('footer');
                }

            }

        }
        else {
            $this->load->view('header');
            $this->load->view('register');
            $this->load->view('footer');

        }
    }
}