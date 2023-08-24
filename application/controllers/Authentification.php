<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilisateur_model');
	}

	public function index()
	{
		$this->load->view('authentification/login');
	}

	public function login(){
		
		try{
			$user = $this->utilisateur_model->find_user($_POST);

			if(!$user){
				redirect('/authentification');	
			}
		
			$this->session->set_userdata('user', $user);
			
			redirect('utilisateur');

		}catch(Throwable $th){
			echo $th->getMessage();die;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('authentification');
	}

}
