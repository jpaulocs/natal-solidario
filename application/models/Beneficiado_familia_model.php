<?php

class Beneficiado_familia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get carta_checklist by id
     */
    function get_familia_beneficiado($idBeneficiado)
    {
        $this->db->select('beneficiado_familia.*');
        return $this->db->get_where('beneficiado_familia',array('beneficiado'=>$idBeneficiado))->result_array();
    }
    
    function delete_por_beneficiado($idBeneficiado)
    {
        $this->db->where('beneficiado', $idBeneficiado);
        $this->db->delete('beneficiado_familia');
    }
    
    function add_beneficiado_familia($params)
    {
        $this->db->insert('beneficiado_familia',$params);
        return $this->db->insert_id();
    }
}
