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
		$error = $this->session->flashdata('error');
		$this->load->view('authentification/login', ['error' => $error]);
	}

	public function login(){
		
		try{
			$user = $this->utilisateur_model->find_user($_POST);

			if(!$user){
				$this->session->set_flashdata('error', 'Login / Mot de passe incorrect');
				redirect('/authentification');	
			}
		
			$this->session->set_userdata('user', $user);
			
			$redirectRout = 'ADMIN' === $user->role ? 'utilisateur' : 'employe';  
			
			redirect($redirectRout);

		}catch(Throwable $th){
			echo $th->getMessage();die;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('authentification');
	}

}
