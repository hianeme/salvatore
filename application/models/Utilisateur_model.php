<?php 

class utilisateur_model extends CI_Model{
    
    const TABLE_NAME = 'utilisateur';

    public $id;
    public $nom;
    public $prenom;
    public $login;
    public $mot_de_passe;
    public $role;

    public function find_user($data){
        return $this
            ->db
            ->where('login', $data['login'])
            ->where('mot_de_passe', $data['mot_de_passe'])
            ->get(self::TABLE_NAME)
            ->row();
    }

    public function find_users($parameters){
        
        $query = $this
            ->db
            ->select('id, nom, prenom, login, role');

        if(isset($parameters['length']) && isset($parameters['start'])){
            $query->limit($parameters['length'], $parameters['start']);
        }

        if(isset($parameters['search']['value'])){
            $query->like('nom', $parameters['search']['value']);
            $query->or_like('prenom', $parameters['search']['value']);
            $query->or_like('login', $parameters['search']['value']);
        }
        
        return $query->from(self::TABLE_NAME)->get()->result();
    }

    public function count_users($parameters){
        return $this
            ->db
            ->select('count(id) as count_users')
            ->from(self::TABLE_NAME)
            ->get()
            ->row();
    }

}