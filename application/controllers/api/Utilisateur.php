<?php 

require APPPATH . 'libraries/Rest_Controller.php';

class Utilisateur extends Rest_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
        $this->load->model('utilisateur_model');
    }

    public function findAll(){

        try{
            $users = $this->utilisateur_model->find_users($_GET);
            $count_users = $this->utilisateur_model->count_users();
            
            $this->response([
                'recordsTotal' => $count_users->count_users,
                'recordsFiltered' => $count_users->count_users,
                'data' => $users
            ], self::HTTP_OK);
        }catch(\Throwable $th){
            $this->response([
                'status' => 'OK',
                'log' => $th->getMessage()
            ], self::HTTP_INTERNAL_ERROR);
        } 
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

            $this->response([
                'status' => 'OK'
            ], self::HTTP_OK);

        }catch(\Throwable $th){
            $this->response([
                'status' => 'OK',
                'log' => $th->getMessage()
            ], self::HTTP_INTERNAL_ERROR);
        }
    }

    public function find($id){
        try{
            $user = $this->utilisateur_model->find($id);

            $this->response([
                'status' => 'OK',
                'user' => $user
            ], self::HTTP_OK);
        }catch(\Throwable $th){
            $this->response([
                'status' => 'OK',
                'log' => $th->getMessage()
            ], self::HTTP_INTERNAL_ERROR);
        }
    }

    public function delete($id){
        try{
            $this->utilisateur_model->delete($id);

            $this->response([
                'status' => 'OK'
            ], self::HTTP_OK);
        }catch(\Throwable $th){
            $this->response([
                'status' => 'OK',
                'log' => $th->getMessage()
            ], self::HTTP_INTERNAL_ERROR);
        }
    }
}