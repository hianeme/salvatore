<?php 

class Employe extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        check_connection();
        $this->load->model('employe_model');
    }

    public function findAll(){

        $employes = $this->employe_model->find_employes($_GET);
        $employes_count = $this->employe_model->count_employes();
        
        echo json_encode([
            'recordsTotal' => $employes_count->count_employes,
            'recordsFiltered' => $employes_count->count_employes,
            'data' => $employes
        ]);
    }

    public function save(){
        
        try{
            
            $this->employe_model->save($_POST);

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
        $employe = $this->employe_model->find($id);

        echo json_encode([
            'status' => 'OK',
            'employe' => $employe
        ]);
    }

    public function delete($id){
        try{
            
            $this->employe_model->delete($id);

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