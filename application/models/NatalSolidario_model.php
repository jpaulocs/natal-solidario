<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class NatalSolidario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get todas as regioes administrativas
     */
    function get_all_regiao_administrativa()
    {
        $this->db->order_by('nome', 'asc');
        return $this->db->get('regiao_administrativa')->result_array();
    }
}