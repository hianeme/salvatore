<?php 

require APPPATH . 'libraries/REST_Controller.php';


class Employe extends Rest_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
        $this->load->model('employe_model');
    }

    public function findAll(){

        try{
            $employes = $this->employe_model->find_employes($_GET);
            $employes_count = $this->employe_model->count_employes();
            
            $this->response([
                'recordsTotal' => $employes_count->count_employes,
                'recordsFiltered' => $employes_count->count_employes,
                'data' => $employes
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
            
            $this->employe_model->save($_POST);

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
            $employe = $this->employe_model->find($id);

            $this->response([
                'status' => 'OK',
                'employe' => $employe
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
            
            $this->employe_model->delete($id);

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