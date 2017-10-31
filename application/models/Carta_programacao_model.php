<?php
class Carta_programacao_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get all classificacao brinquedo
     */
    function get_programacoes_por_carta($idCarta)
    {
        $this->db->select('carta_programacao.*');
        //$this->db->order_by('prioridade', 'asc');
        return $this->db->get_where('carta_programacao',array('carta'=>$idCarta))->result_array();
    }
    
    function add_carta_programacao($params)
    {
        $this->db->insert('carta_programacao',$params);
        return $this->db->insert_id();
    }
    
    function update_carta_programacao($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('carta_programacao',$params);
    }
    
    function delete_por_carta($idCarta)
    {
        $this->db->where('carta', $idCarta);
        $this->db->delete('carta_programacao');
    }
}