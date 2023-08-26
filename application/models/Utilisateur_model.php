<?php 

class Utilisateur_model extends CI_Model{
    
    const TABLE_NAME = 'utilisateur';

    public function find($id){
        return $this
            ->db
            ->select('id, nom, prenom, login, role')
            ->where('id', $id)
            ->get(self::TABLE_NAME)
            ->row();
    }

    public function find_user($data){
        return $this
            ->db
            ->where('login', $data['login'])
            ->where('mot_de_passe', md5($data['mot_de_passe']))
            ->get(self::TABLE_NAME)
            ->row();
    }

    public function find_users($parameters){
        $this->db->select('id, nom, prenom, login, 
                CASE 
                    WHEN role = 1 THEN "ADMIN" 
                    WHEN role = 2 THEN "USER" 
                END as role', FALSE);
            
        if(isset($parameters['length']) && isset($parameters['start'])){
            $this->db->limit($parameters['length'], $parameters['start']);
        }

        if(isset($parameters['search']['value'])){
            $this->db->like('nom', $parameters['search']['value']);
            $this->db->or_like('prenom', $parameters['search']['value']);
            $this->db->or_like('login', $parameters['search']['value']);
            
            if(strpos('admin', strtolower($parameters['search']['value'])) > -1){
                $this->db->or_like('role', 1);
            }
            if(strpos('user', strtolower($parameters['search']['value'])) > -1){
                $this->db->or_like('role', 2);
            }
        }

        $this->db->from(self::TABLE_NAME);

        return $this->db->get()->result();
    }

    public function count_users(){
        return $this
            ->db
            ->select('count(id) as count_users')
            ->from(self::TABLE_NAME)
            ->get()
            ->row();
    }

    public function save($user){
        if(isset($user['id']) && !empty($user['id'])){

            $id = $user['id'];
            unset($user['id']);

            return $this->db->update(self::TABLE_NAME, $user, ['id' => $id]);
        }else{
            return $this->db->insert(self::TABLE_NAME, $user);
        }  
    }

    public function delete($id){
        return $this->db->delete(self::TABLE_NAME, ['id' => $id]);
    }

}