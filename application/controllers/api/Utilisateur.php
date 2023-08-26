<?php 

class Utilisateur extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
        $this->load->model('utilisateur_model');
    }

    public function findAll(){

        $users = $this->utilisateur_model->find_users($_GET);
        $count_users = $this->utilisateur_model->count_users();
        
        echo json_encode([
            'recordsTotal' => $count_users->count_users,
            'recordsFiltered' => $count_users->count_users,
            'data' => $users
        ]);
    }

    public function save(){
        
        try{
            
            if(empty($_POST['mot_de_passe']) || '********' === $_POST['mot_de_passe']){
                unset($_POST['mot_de_passe']);
            }else{
                // @TODO
                // Replace md with CI Encyption library ($this->encrypt->encode($_POST['mot_de_passe'])))
                $_POST['mot_de_passe'] = md5($_POST['mot_de_passe']);
            }
            
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

    public function find($id){
        $user = $this->utilisateur_model->find($id);

        echo json_encode([
            'status' => 'OK',
            'user' => $user
        ]);
    }

    public function delete($id){
        try{
            
            $this->utilisateur_model->delete($id);

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