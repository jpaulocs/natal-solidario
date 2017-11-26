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
        $this->db->select('carta.*, beneficiado.nome as beneficiado_nome, r.nome as responsavel_nome, a.nome as adotante_nome');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('responsavel r', 'beneficiado.responsavel = r.id');
        $this->db->join('adotante a', 'carta.adotante = a.id', 'left');
        $this->db->order_by('numero', 'desc');
        return $this->db->get('carta')->result_array();
    }
    
    function get_total_responsaveis_por_regiao()
    {
        $this->db->select(
            'nome as regiao_administrativa, COUNT(1) as total FROM ('
	           . ' SELECT ra.nome, r.id FROM carta c' 
	           . ' JOIN beneficiado b ON b.id = c.beneficiado' 
	           . ' JOIN responsavel r ON r.id=b.responsavel' 
	           . ' JOIN regiao_administrativa ra ON ra.id=c.regiao_administrativa'
	           . ' GROUP BY ra.nome, r.id) AS TBL'
            . ' GROUP BY nome'
            . ' ORDER BY nome', FALSE);
        return $this->db->get()->result_array();
    }
    
    function get_total_cartas_por_mobilizador() {
        $this->db->select(
             'CASE u.first_name' 
            .'		WHEN u.first_name IS NULL THEN u.first_name' 
            .'		ELSE \'Sem mobilizador vinculado\' END as nome,' 
            .' COUNT(1) AS total'  
            .' FROM carta c'
            .' LEFT JOIN usuario u ON u.id=c.mobilizador'
            .' GROUP BY u.first_name' 
            .' ORDER BY u.first_name', FALSE);
        return $this->db->get()->result_array();
    }
    
    function get_total_cartas_por_carteiro() {
        $this->db->select(
            'CASE u.first_name'
            .'		WHEN u.first_name IS NULL THEN u.first_name'
            .'		ELSE \'Sem carteiro vinculado\' END as nome,'
            .' COUNT(1) AS total'
            .' FROM carta c'
            .' LEFT JOIN usuario u ON u.id=c.carteiro_associado'
            .' GROUP BY u.first_name'
            .' ORDER BY u.first_name', FALSE);
        return $this->db->get()->result_array();
    }
    
    function get_total_cartas_adotadas_por_regiao() {
        $this->db->select(
            ' ra.nome, COUNT(1) as total FROM carta c'
            . ' JOIN regiao_administrativa ra ON ra.id=c.regiao_administrativa'
            . ' WHERE c.adotante IS NOT NULL'
            . ' GROUP BY ra.nome'
            . ' ORDER BY nome', FALSE);
        return $this->db->get()->result_array();
    }
    
    function get_total_cartas_aguardando_adocao_por_regiao() {
        $this->db->select(
            ' ra.nome, COUNT(1) as total FROM carta c'
            . ' JOIN regiao_administrativa ra ON ra.id=c.regiao_administrativa'
            . ' WHERE c.adotante IS NULL'
            . ' GROUP BY ra.nome'
            . ' ORDER BY nome', FALSE);
        return $this->db->get()->result_array();
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
    
    function get_cartas_por_parametros($limit, $start, $numero_carta, $idCarteiro, $idRegiaoAdministrativa, $idMobilizador, $nomeCrianca, $nomeResponsavel, $situacao)
    {
        $this->db->limit($limit, $start);
        $this->db->select('carta.*, beneficiado.nome as beneficiado_nome, r.nome as responsavel_nome, a.nome as adotante_nome');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('responsavel r', 'beneficiado.responsavel = r.id');
        $this->db->join('adotante a', 'carta.adotante = a.id', 'left');
        if ($idCarteiro) {
            $this->db->where('carteiro_associado', $idCarteiro);
        }
        if ($nomeCrianca) {
            $this->db->like('beneficiado.nome', $nomeCrianca);
        }
        if ($nomeResponsavel) {
            $this->db->like('r.nome', $nomeResponsavel);
        }
        if ($idMobilizador) {
            $this->db->where('carta.mobilizador', $idMobilizador);
        }
        if ($numero_carta) {
            $this->db->where('numero', $numero_carta);
        }
        if ($idRegiaoAdministrativa) {
            $this->db->where('regiao_administrativa', $idRegiaoAdministrativa);
        }
        if ($situacao == 'SEM_CARTEIRO_VINCULADO') {
            $this->db->where('carteiro_associado IS NULL');
        }
        if ($situacao == 'SEM_MOBILIZADOR_VINCULADO') {
            $this->db->where('carta.mobilizador IS NULL');
        }
        if ($situacao == 'AGUARDANDO_ADOCAO') {
            $this->db->where('adotante IS NULL');
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('carta')->result_array();
    }
    
    function contar_cartas_por_parametros($numero_carta, $idCarteiro, $idRegiaoAdministrativa, $idMobilizador, $nomeCrianca, $nomeResponsavel, $situacao) 
    {
        $this->db->select('*');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('responsavel r', 'beneficiado.responsavel = r.id');
        if ($idCarteiro) {
            $this->db->where('carteiro_associado', $idCarteiro);
        }
        if ($nomeCrianca) {
            $this->db->like('beneficiado.nome', $nomeCrianca);
        }
        if ($nomeResponsavel) {
            $this->db->like('r.nome', $nomeResponsavel);
        }
        if ($idMobilizador) {
            $this->db->where('mobilizador', $idMobilizador);
        }
        if ($numero_carta) {
            $this->db->where('numero', $numero_carta);
        }
        if ($idRegiaoAdministrativa) {
            $this->db->where('regiao_administrativa', $idRegiaoAdministrativa);
        }
        if ($situacao == 'SEM_CARTEIRO_VINCULADO') {
            $this->db->where('carteiro_associado IS NULL');
        }
        if ($situacao == 'SEM_MOBILIZADOR_VINCULADO') {
            $this->db->where('carta.mobilizador IS NULL');
        }
        if ($situacao == 'AGUARDANDO_ADOCAO') {
            $this->db->where('adotante IS NULL');
        }
        $query = $this->db->get('carta');
        return $query->num_rows();
    }
    
    function contar_todas_cartas() {
        return $this->db->count_all("carta");
    }
    
    function pesquisar_por_ano_adotante($anoEvento, $idAdotante) {
        $this->db->select('carta.*, beneficiado.nome as beneficiado_nome, responsavel.nome as responsavel_nome, beneficiado.data_nascimento');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('responsavel', 'beneficiado.responsavel = responsavel.id');
        $this->db->like('carta.numero', $anoEvento, 'after');
        $this->db->where('carta.adotante', $idAdotante);
        $this->db->order_by('id', 'asc');
        return $this->db->get('carta')->result_array();
    }
}
