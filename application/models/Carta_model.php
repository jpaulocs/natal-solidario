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
    
    function get_carta_pedido($id)
    {
        return $this->db->get_where('carta',array('id'=>$id))->row_array();
    }
        
    function get_all_cartas($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('carta.*, beneficiado.nome as beneficiado_nome, u.first_name as representante_comunidade_nome, u2.first_name as carteiro_nome, u2.id as carteiro_id');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('usuario u', 'carta.representante_comunidade = u.id');
        $this->db->join('usuario u2', 'carta.carteiro_associado = u2.id', 'left');
        $this->db->order_by('numero', 'desc');
        return $this->db->get('carta')->result_array();
    }
    
    function get_cartas_por_parametros($limit, $start, $numero_carta, $idCarteiro, $idRegiaoAdministrativa)
    {
        $this->db->limit($limit, $start);
        $this->db->select('carta.*, beneficiado.nome as beneficiado_nome, u.first_name as representante_comunidade_nome, u2.first_name as carteiro_nome, u2.id as carteiro_id');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('usuario u', 'carta.representante_comunidade = u.id');
        $this->db->join('usuario u2', 'carta.carteiro_associado = u2.id', 'left');
        if ($idCarteiro) {
            $this->db->where('carteiro_associado', $idCarteiro);
        }
        if ($numero_carta) {
            $this->db->where('numero', $numero_carta);
        }
        if ($idRegiaoAdministrativa) {
            $this->db->where('regiao_administrativa', $idRegiaoAdministrativa);
        }
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
    
    function contar_cartas_por_parametros($numero_carta, $idCarteiro, $idRegiaoAdministrativa) {
        $this->db->select('*');
        if ($idCarteiro) {
            $this->db->where('carteiro_associado', $idCarteiro);
        }
        if ($numero_carta) {
            $this->db->where('numero', $numero_carta);
        }
        if ($idRegiaoAdministrativa) {
            $this->db->where('regiao_administrativa', $idRegiaoAdministrativa);
        }        
        $query = $this->db->get('carta');
        return $query->num_rows();
    }
    
    function contar_todas_cartas() {
        return $this->db->count_all("carta");
    }
}
