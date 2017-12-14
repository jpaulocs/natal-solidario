<?php
 
class Presente extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');

        $this->load->model('Carta_model');
        $this->load->model('Adotante_model');
        $this->load->model('Brinquedo_classificacao_model');
        $this->load->model('Presente_model');
        $this->load->model('Local_entrega_regiao_model');
        $this->load->model('Local_entrega_model');
        $this->load->model('Presente_historico_situacao_model');
        
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
            if(null !== $this->session->userdata('origem') && $this->session->userdata('origem') == 'recebimentoPresente'){
                $this->session->set_flashdata('message', '');
            } else {
                $this->session->set_flashdata('message', 'Não localizamos o seu cadastro.');
            }
            
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
            if(isset($idCarta)) {
                $data['cartaSelecionada'] = $this->Carta_model->get_dados_complementares_carta_por_id($idCarta);
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
            $dadosPresente = $this->Presente_model->get_dados_presente($this->input->post('numeroCarta'));
            $data['nomeLocalEntrega'] = urlencode($dadosPresente['nomeLocalEntrega']);
            $data['numeroSalaEntrega'] = $dadosPresente['numeroSalaEntrega'];
            
            $data['_view'] = 'presente/add';
            if(null !== $this->session->userdata('origem') && $this->session->userdata('origem') == 'recebimentoPresente'){
                $this->load->view('layouts/main',$data);
            } else {
                $this->load->view('layouts/main_presente',$data);    
            }
            
        }
    }

    function gerarEtiqueta() {
        

        $data = Array(
            'numeroCarta' => urldecode($this->uri->segment(3)),
            'nomeResponsavel' => urldecode($this->uri->segment(4)),
            'nomeCrianca' => urldecode($this->uri->segment(5)),
            'localEntrega' => urldecode($this->uri->segment(6)) . "<br/> Sala: " . urldecode($this->uri->segment(7)),
            'urlQrcode' => urlencode(site_url().'presente/receberPresente/'.$this->uri->segment(3))
        );

        //load the view and saved it into $html variable
        $this->load->view('presente/template_etiqueta', $data);
    }

    function receberPresente($numeroCarta = null) {
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_flashdata('message', 'You must be an admin to view this page');
            redirect('login');
        } else {
            $user = $this->ion_auth->user()->row();
            $user_groups = $this->ion_auth->get_users_groups()->result();

            $grupos = array();
            foreach ($user_groups as $grupo) {
                array_push($grupos, $grupo->name);
            }

            $this->session->set_userdata('usuario_logado', $user->email);
            $this->session->set_userdata('grupos_usuario', $grupos);
            $this->session->set_userdata('usuario_logado_id', $user->id);
        }

        if($this->input->post('numeroCarta') || isset($numeroCarta)) {
            $numeroCarta = isset($numeroCarta) ? $numeroCarta : $this->input->post('numeroCarta');

            $usuario = $this->ion_auth->user()->row();

            $dadosPresente = $this->Presente_model->get_dados_presente($numeroCarta);

            if(is_null($dadosPresente['idPresente'])) {
                $this->session->set_flashdata('message', 'Não existe presente cadastrado para a carta número ' . $numeroCarta);
                $this->session->set_flashdata('idCarta', $dadosPresente['idCarta']);
            } else {
                $this->session->set_flashdata('message', '');
            }

            $data['allLocaisArmazenamento'] = $this->Local_entrega_model->get_locais_armazenamento();
            $data['allSituacoesPresente'] = $this->Presente_model->get_all_situacoes_presente();

            if($this->input->post('local_armazenamento')) {
                $params = array(
                    'local_armazenamento' => $this->input->post('local_armazenamento')
                );
                $this->Presente_model->update($dadosPresente['idPresente'], $params);
            }

            if($this->input->post('situacao_presente')) {
                $params = array(
                    'situacao' => $this->input->post('situacao_presente')
                );
                $this->Presente_model->update($dadosPresente['idPresente'], $params);

                $paramsSituacao = array(
                    'presente' => $dadosPresente['idPresente'],
                    'situacao' => $this->input->post('situacao_presente'),
                    'usuario' => $user->id,
                    'data_situacao' => date('Y-m-d H:i:s')
                );
                $this->Presente_historico_situacao_model->add($paramsSituacao);

            }

            $dadosPresenteAposAtualizacao = $this->Presente_model->get_dados_presente($numeroCarta);
            $dados = array(
                'idPresente' => $dadosPresenteAposAtualizacao['idPresente'],
                'numeroCarta' => $dadosPresenteAposAtualizacao['numeroCarta'],
                'nomeAdotante' => $dadosPresenteAposAtualizacao['adotante_nome'],
                'numeroSalaEntrega' => $dadosPresenteAposAtualizacao['numeroSalaEntrega'],
                'nomeLocalEntrega' => $dadosPresenteAposAtualizacao['nomeLocalEntrega'],
                'responsavel_nome' => $dadosPresenteAposAtualizacao['responsavel_nome'],
                'beneficiado_nome' => $dadosPresenteAposAtualizacao['beneficiado_nome'],
                'localArmazenamentoPresente' => $dadosPresenteAposAtualizacao['localArmazenamentoPresente'],
                'situacaoPresente' => $dadosPresenteAposAtualizacao['situacaoPresente']
            );

            $data['_view'] = 'presente/receber-presente';
            $data['dados'] = $dados;


            $this->load->view('layouts/main',$data);
        } else {
            $data['_view'] = 'presente/receber-presente';
            $this->load->view('layouts/main',$data);
        }

    }
}