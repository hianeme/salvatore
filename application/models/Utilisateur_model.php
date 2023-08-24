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
        $query = $this
            ->db
            ->where('login', $data['login'])
            ->where('mot_de_passe', $data['mot_de_passe'])
            ->get(self::TABLE_NAME);
        return $query->row();
    }

}