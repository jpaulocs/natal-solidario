<?php
 
class Sala_entrega_responsavel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_por_sala_entrega($idSalaEntrega)
    {
        $this->db->select('responsavel.*');
        $this->db->join('responsavel', 'sala_entrega_responsavel.responsavel = responsavel.id');        
        $this->db->where('sala_entrega_presente', $idSalaEntrega);
        $this->db->order_by('responsavel.nome', 'asc');
        return $this->db->get('sala_entrega_responsavel')->result_array();
    }
}