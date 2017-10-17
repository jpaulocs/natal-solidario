<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Carta_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get carta_pedido by id
     */
    function get_carta_pedido($id)
    {
        return $this->db->get_where('carta',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all cartas
     */
    function get_all_cartas()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('carta')->result_array();
    }
        
    /*
     * function to add new carta_pedido
     */
    function add_carta_pedido($params)
    {
        $this->db->insert('carta',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update carta_pedido
     */
    function update_carta_pedido($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('carta',$params);
    }
    
    /*
     * function to delete carta_pedido
     */
    function delete_carta_pedido($id)
    {
        return $this->db->delete('carta',array('id'=>$id));
    }
}
