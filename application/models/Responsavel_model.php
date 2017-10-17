<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Responsavel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get responsavel by id
     */
    function get_responsavel($id)
    {
        return $this->db->get_where('responsavel',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all responsaveis
     */
    function get_all_responsaveis()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('responsavel')->result_array();
    }
        
    /*
     * function to add new responsavel
     */
    function add_responsavel($params)
    {
        $this->db->insert('responsavel',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update responsavel
     */
    function update_responsavel($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('responsavel',$params);
    }
    
    /*
     * function to delete responsavel
     */
    function delete_responsavel($id)
    {
        return $this->db->delete('responsavel',array('id'=>$id));
    }
}
