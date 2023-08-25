<?php 

class Utilisateur extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
    }

    public function index(){
        $this->load->view('layout/header');
        $this->load->view('utilisateur/index');
        $this->load->view('layout/footer');
    }

    public function add(){
        $this->load->view('layout/header');
        $this->load->view('utilisateur/add');
        $this->load->view('layout/footer');
    }
}