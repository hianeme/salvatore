<?php 

class Employe_model extends CI_Model{
    
    const TABLE_NAME = 'employe';

    public function find($id){
        return $this
            ->db
            ->select('id, nom, prenom, mail, adresse, telephone, poste')
            ->where('id', $id)
            ->get(self::TABLE_NAME)
            ->row();
    }

    public function find_employes($parameters){
        $this->db->select('id, nom, prenom, mail, adresse, telephone, 
                        CASE 
                            WHEN poste = 1 THEN "Gérant" 
                            WHEN poste = 2 THEN "Livreur"
                            WHEN poste = 3 THEN "Cuisinier" 
                        END as poste', FALSE);
                                
        if(isset($parameters['length']) && isset($parameters['start'])){
            $this->db->limit($parameters['length'], $parameters['start']);
        }

        if(isset($parameters['search']['value'])){
            $this->db->like('nom', $parameters['search']['value']);
            $this->db->or_like('prenom', $parameters['search']['value']);
            $this->db->or_like('mail', $parameters['search']['value']);
            $this->db->or_like('adresse', $parameters['search']['value']);
            $this->db->or_like('telephone', $parameters['search']['value']);
            $this->db->or_like('poste', $parameters['search']['value']);
        }

        $this->db->from(self::TABLE_NAME);

        return $this->db->get()->result();
    }

    public function count_employes(){
        return $this
            ->db
            ->select('count(id) as count_employes')
            ->from(self::TABLE_NAME)
            ->get()
            ->row();
    }

    public function save($employe){
        if(isset($employe['id']) && !empty($employe['id'])){

            $id = $employe['id'];
            unset($employe['id']);

            return $this->db->update(self::TABLE_NAME, $employe, ['id' => $id]);
        }else{
            return $this->db->insert(self::TABLE_NAME, $employe);
        }  
    }

    public function delete($id){
        return $this->db->delete(self::TABLE_NAME, ['id' => $id]);
    }

}