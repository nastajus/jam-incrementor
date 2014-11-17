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
        $this->load->library('format');

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

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback__space_check|min_length[3]|max_length[32]|alpha_numeric|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|matches[passconf]|min_length[8]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback__space_check|xss_clean');
            $this->form_validation->set_rules('agree', 'I agree to terms and services.', 'callback__accept_terms' );

            if ($this->form_validation->run()){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');

                $this->load->model('users');
                $this->load->library('format');

                $cond = $this->users->Insert(Format::User($username, $password, $email));

                var_dump($cond);

                if ($cond){
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

    function _space_check($str)
    {

        $pattern = '/ /';
        $result = preg_match($pattern, $str);

        if ($result)
        {
            $this->form_validation->set_message('_space_check', 'The %s field can not have spaces.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function _accept_terms(){
        if (isset($_POST['accept'])) return TRUE;
        $this->form_validation->set_message('_accept_terms', 'Please read and accept our terms and conditions.');
        return FALSE;

    }

}