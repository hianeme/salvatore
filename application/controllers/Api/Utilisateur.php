<?php 

class Utilisateur extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
    }

    public function findAll(){

        $users = $this->utilisateur_model->find_users($_GET);
        $user_count = $this->utilisateur_model->count_users($_GET);
        
        echo json_encode([
            'recordsTotal' => $user_count->count_users,
            'recordsFiltered' => $user_count->count_users,
            'data' => $users
        ]);
    }

    public function save(){
        
        try{
            $this->utilisateur_model->save($_POST);

            echo json_encode([
                'status' => 'OK'
            ]);
            die;
        }catch(\Throwable $th){

            echo json_encode([
                'status' => 'KO',
                'log' => $th->getMessage()
            ]);
        }
    }
}