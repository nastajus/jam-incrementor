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

}