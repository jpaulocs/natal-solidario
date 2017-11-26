<?php 

class Presente_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function pesquisar_por_carta($idCarta) {
        return $this->db->get_where('presente',array('carta'=>$idCarta))->row_array();
    }
    
    function add($params)
    {
        $this->db->insert('presente',$params);
        return $this->db->insert_id();
    }
    
    function update($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('presente',$params);
    }
}