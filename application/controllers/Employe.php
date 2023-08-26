<?php 

class Employe extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
    }

    public function index(){
        $this->load->view('layout/header');
        $this->load->view('employe/index');
        $this->load->view('layout/footer');
    }

    public function save(){
        $this->load->view('layout/header');
        $this->load->view('employe/save');
        $this->load->view('layout/footer');
    }
}