<?php
class Brinquedo_classificacao_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get all classificacao brinquedo
     */
    function get_all_classificacao_brinquedo()
    {
        $this->db->select('brinquedo_classificacao.*');
        $this->db->order_by('nome', 'asc');
        return $this->db->get('brinquedo_classificacao')->result_array();
    }
}