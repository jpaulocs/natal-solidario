<?php
 
class Sala_palestra_turma_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_por_sala_palestra($idSalaPalestra)
    {
        $this->db->select('responsavel.*');
        $this->db->join('responsavel', 'sala_palestra_turma.responsavel = responsavel.id');        
        $this->db->where('sala_palestra', $idSalaPalestra);
        $this->db->order_by('responsavel.nome', 'asc');
        return $this->db->get('sala_palestra_turma')->result_array();
    }
}