<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Usuario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get usuario by id
     */
    function get_usuario($id)
    {
        return $this->db->get_where('usuario',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all usuarios
     */
    function get_all_usuarios()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('usuario')->result_array();
    }
        
    /*
     * function to add new usuario
     */
    function add_usuario($params)
    {
        $this->db->insert('usuario',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update usuario
     */
    function update_usuario($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('usuario',$params);
    }
    
    /*
     * function to delete usuario
     */
    function delete_usuario($id)
    {
        return $this->db->delete('usuario',array('id'=>$id));
    }
}
