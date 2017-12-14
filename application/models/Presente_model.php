<?php 

class Presente_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function pesquisar_por_carta($idCarta) {
        return $this->db->get_where('presente',array('carta'=>$idCarta))->row_array();
    }
    
    function add($params)
    {
        $this->db->insert('presente',$params);
        return $this->db->insert_id();
    }
    
    function update($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('presente',$params);
    }

    function get_dados_presente($numeroCarta){
        $this->db->select('carta.numero as numeroCarta, beneficiado.nome as beneficiado_nome
            , r.nome as responsavel_nome, a.nome as adotante_nome, salap.sala as numeroSalaEntrega
            , local.nome as nomeLocalEntrega, p.local_armazenamento as localArmazenamentoPresente
            , p.id as idPresente, p.situacao as situacaoPresente, p.brinquedo_descricao as descricaoBrinquedo
            , p.brinquedo_classificacao as classificacaoBrinquedo');
        $this->db->join('beneficiado', 'carta.beneficiado = beneficiado.id');
        $this->db->join('responsavel r', 'beneficiado.responsavel = r.id');
        $this->db->join('adotante a', 'carta.adotante = a.id', 'left');
        $this->db->join('presente p', 'carta.id = p.carta', 'left');
        $this->db->join('sala_entrega_responsavel salar', 'r.id = salar.responsavel', 'left');
        $this->db->join('sala_entrega_presente salap', 'salar.sala_entrega_presente = salap.id', 'left');
        $this->db->join('local_entrega local', 'local.id = salap.local_entrega');
        $this->db->like('carta.removida', false);

        $dadosPresente = $this->db->get_where('carta',array('carta.numero'=>$numeroCarta))->row_array();
        return $dadosPresente;

        //return $this->db->get_where('presente',array('carta'=>$idCarta))->row_array();
    }

    function get_all_situacoes_presente() {
        return $this->db->get('presente_situacao')->result_array();
    }
}