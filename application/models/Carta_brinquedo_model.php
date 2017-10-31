<?php
class Carta_brinquedo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get all classificacao brinquedo
     */
    function get_brinquedos_por_carta($idCarta)
    {
        $this->db->select('carta_brinquedo.*');
        $this->db->order_by('prioridade', 'asc');
        return $this->db->get_where('carta_brinquedo',array('carta'=>$idCarta))->result_array();
    }
    
    function add_carta_brinquedo($params)
    {
        $this->db->insert('carta_brinquedo',$params);
        return $this->db->insert_id();
    }
    
    function update_carta_brinquedo($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('carta_brinquedo',$params);
    }
}