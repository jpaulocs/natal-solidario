<?php 

class Presente_historico_situacao_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add($params)
    {
        $this->db->insert('presente_historico_situacao',$params);
        return $this->db->insert_id();
    }

}