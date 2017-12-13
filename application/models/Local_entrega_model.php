<?php

class Local_entrega_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_locais_armazenamento() {
        return $this->db->get_where('local_entrega',array('local_entrega_familias'=>0))->result_array();
    }

}