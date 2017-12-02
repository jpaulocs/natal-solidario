<?php

class Adotante_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function add_adotante($params)
    {
        $this->db->insert('adotante',$params);
        return $this->db->insert_id();
    }
    
    function update_adotante($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('adotante',$params);
    }
    
    function get_adotante_por_id($id)
    {
        return $this->db->get_where('adotante',array('id'=>$id))->row_array();
    }
    
    function get_adotante_por_email($email)
    {
        return $this->db->get_where('adotante',array('email'=>$email))->row_array();
    }

    function get_adotante_por_status_envio_email($status)
    {
        $this->db->where('email_enviado', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get('adotante')->result_array();
    }
}
