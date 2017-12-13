<?php
 
class Sala_palestra_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_por_ano($ano)
    {
        $this->db->select('sala_palestra.*, local_entrega.nome as local_entrega_nome, regiao_administrativa.nome as regiao_administrativa_nome');
        $this->db->join('local_entrega', 'sala_palestra.local_entrega = local_entrega.id');
        $this->db->join('regiao_administrativa', 'sala_palestra.regiao_administrativa = regiao_administrativa.id');
        $this->db->where('ano', $ano);
        return $this->db->get('sala_palestra')->result_array();
    }
    
    function get_por_id($id)
    {
        $this->db->select('sala_palestra.*, local_entrega.nome as local_entrega_nome, regiao_administrativa.nome as regiao_administrativa_nome');
        $this->db->join('local_entrega', 'sala_palestra.local_entrega = local_entrega.id');
        $this->db->join('regiao_administrativa', 'sala_palestra.regiao_administrativa = regiao_administrativa.id');
        $this->db->where('sala_palestra.id', $id);
        return $this->db->get('sala_palestra')->row_array();
    }
}