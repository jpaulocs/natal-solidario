<?php
 
class Presente extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Carta_model');
        $this->load->model('Adotante_model');
        $this->load->model('Brinquedo_classificacao_model');
        $this->load->model('Presente_model');
        $this->load->model('Local_entrega_regiao_model');
        
        $this->session->set_userdata('nomeAdotante', '');
        $this->session->set_userdata('cartasAdotante', []);
    }
    
    function carregarMenu($idAdotante = null, $token = null) {
        log_message('info',print_r('idAdotante:' . $idAdotante, TRUE));
        log_message('info',print_r('token:' . $token, TRUE));
        
        $token_decoded = urldecode($token);
        
        $adotante = $this->Adotante_model->get_adotante_por_id($idAdotante);
        if ($adotante) {
            if ($adotante['token_acesso'] == $token_decoded) {
                $pieces = explode(" ", $adotante['nome']);
                
                $this->session->set_userdata('nomeAdotante', $adotante['nome']);
                $this->session->set_userdata('cartasAdotante', $this->Carta_model->pesquisar_por_ano_adotante(date("Y"), $idAdotante));

            } else {
                $this->session->set_flashdata('message', 'O endereço acessado é inválido, verifique se ele está igual ao recebido por e-mail.');
            }
        } else {
            $this->session->set_flashdata('message', 'Não localizamos o seu cadastro.');
        }
    }
    
    function index($idAdotante = null, $token = null)
    {
        $this->session->set_userdata('idAdotante', $idAdotante);
        $this->session->set_userdata('tokenAdotante', $token);
        
        $this->carregarMenu($idAdotante, $token);
        
        $data['_view'] = 'presente/index';
        $this->load->view('layouts/main_presente',$data);
    }
    
    function add($idCarta = null) {
        
        log_message('info',print_r('idCarta:' . $idCarta, TRUE));
                
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('descricaoBrinquedo','Brinquedo','required');
        $this->form_validation->set_rules('classificacaoBrinquedo','Classificação do brinquedo','required');
        
        if($this->form_validation->run())
        {
            $valorBrinquedo = $this->input->post('valorBrinquedo');
            if ($valorBrinquedo) {
                $valorBrinquedo = str_replace(".","",$valorBrinquedo);
                $valorBrinquedo = str_replace(",",".",$valorBrinquedo);
            }
            
            $params = array(
                'situacao' => 1 /*NOVO*/,
                'carta' => $idCarta,
                'brinquedo_descricao' => $this->input->post('descricaoBrinquedo'),
                'brinquedo_classificacao' => $this->input->post('classificacaoBrinquedo'),
                'valor' => $valorBrinquedo
            );
            
            if ($presente) {
                log_message('info',print_r('UPDATE PRESENTE PARA CARTA: ' . $idCarta, TRUE));
                $this->Presente_model->update($presente['id'], $params);
            } else {
                log_message('info',print_r('INSERT PRESENTE PARA CARTA: ' . $idCarta, TRUE));
                $params['data_cadastro'] = date('Y-m-d H:i:s');
                $this->Presente_model->add($params);
            }
            
            redirect('presente/index/'.$this->session->userdata('idAdotante').'/'.$this->session->userdata('tokenAdotante'), 'location');
            
        } else {
            
            $this->carregarMenu($this->session->userdata('idAdotante')
                , $this->session->userdata('tokenAdotante'));
            
            $presente = $this->Presente_model->pesquisar_por_carta($idCarta);
            
            $data['descricaoPresente'] = ($presente) ? $presente['brinquedo_descricao'] : '';
            $data['valorBrinquedo'] = ($presente) ? $presente['valor'] : '';
            $data['classificacaoBrinquedo'] = ($presente) ? $presente['brinquedo_classificacao'] : '';
            $data['situacao'] = ($presente) ? $presente['situacao'] : '1';
            
            $data['brinquedo_classificacoes'] = $this->Brinquedo_classificacao_model->get_all_classificacao_brinquedo();
            
            
            foreach ($this->session->userdata('cartasAdotante') as $carta) {
                if ($carta['id'] == $idCarta) {
                    $data['cartaSelecionada'] = $carta;
                    break;
                }
            }
            $data['idade'] = date("Y") - date("Y", strtotime($data['cartaSelecionada']['data_nascimento']));
            
            $data['locais_entrega'] = $this->Local_entrega_regiao_model->get_local_entrega_por_regiao($data['cartaSelecionada']['regiao_administrativa'], date('Y/m/d'));
            if (!$data['locais_entrega']) {
                $data['locais_entrega'] = [];
            }
            
            $data['local_entrega_familia'] = $this->Local_entrega_regiao_model->get_local_entrega_familias_por_regiao($data['cartaSelecionada']['regiao_administrativa']);
            if (!$data['local_entrega_familia']) {
                $data['local_entrega_familia'] = '';
            }
            
            $data['_view'] = 'presente/add';
            $this->load->view('layouts/main_presente',$data);
        }
    }
}