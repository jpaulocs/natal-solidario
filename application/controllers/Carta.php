<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Carta extends CI_Controller{

    const GRUPO_CARTEIROS = 5;
    const GRUPO_REPRESENTANTE_COMUNIDADE = 3;

    const ACAO_AUTENTICACAO = 1;
    const ACAO_INCLUSAO = 2;
    const ACAO_ALTERACAO = 3;
    const ACAO_EXCLUSAO = 4;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Carta_model');

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');

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

    } 

    /*
     * Listing of cartas
     */
    function index()
    {
        $data['cartas'] = null;
        if ($this->input->post('carteiro') != null) {
            $data['cartas'] = $this->Carta_model->get_cartas_por_carteiro($this->input->post('carteiro'));
            $data['carteiro_selecionado'] = $this->input->post('carteiro');
        } else {
            $data['cartas'] = $this->Carta_model->get_all_cartas();
        }
        
        $this->load->model('Usuario_model');
        $data['carteiros'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_CARTEIROS);
        
        $data['_view'] = 'carta/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new carta_pedido
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('beneficiado','Beneficiado','required');
        $this->form_validation->set_rules('representante_comunidade','Representante Comunidade','required');
        //$this->form_validation->set_rules('carteiro_associado','Carteiro','required');
        $this->form_validation->set_rules('regiao_administrativa','Região Administrativa','required');
		
		if($this->form_validation->run())     
        {   
            
            $ano = date('Y');
            $regiaoAdministrativa = str_pad($this->input->post('regiao_administrativa'), 2, "0", STR_PAD_LEFT);
            $idBeneficiado = str_pad($this->input->post('beneficiado'), 5, "0", STR_PAD_LEFT);

            $params = array(
				'beneficiado' => $this->input->post('beneficiado'),
				'representante_comunidade' => $this->input->post('representante_comunidade'),
				'carteiro_associado' => $this->input->post('carteiro_associado'),
				'data_cadastro' => date('Y-m-d H:i:s'),
				'numero' => $ano . $regiaoAdministrativa . $idBeneficiado,
                'regiao_administrativa' => $this->input->post('regiao_administrativa')
            );
            
            $carta_pedido_id = $this->Carta_model->add_carta_pedido($params);

            $this->load->model('Carta_checklist_model');

            $paramsChecklist = array(
                'carta' => $this->input->post('checklist_carta'),
                'formularo_social' => $this->input->post('checklist_form_social'),
                'doc_identidade_responsaveis' => $this->input->post('checklist_doc_id_responsaveis'),
                'certidao_nascimeno_crianca' => $this->input->post('checklist_cert_nasc_crianca'),
                'doc_bolsa_familia' => $this->input->post('checklist_doc_bolsa_familia'),
                'comprovante_escolar' => $this->input->post('checklist_comp_escolar'),
                'doc_pne' => $this->input->post('checklist_doc_pne'),
                'id_carta' => $carta_pedido_id
            );

            $this->Carta_checklist_model->add_carta_checklist($paramsChecklist);

            //auditoria
            $this->load->model('Registro_log_model');

            $paramsAudit = array(
                'data_cadastro' => date('Y-m-d H:i:s'),
                'usuario' => $this->ion_auth->user()->row()->id,
                'acao' => self::ACAO_INCLUSAO,
                'titulo' => "CARTA",
                'conteudo_anterior' => '',
                'conteudo_posterior' => http_build_query(array_merge($params, $paramsChecklist))

            );
            $this->Registro_log_model->add_registro_log($paramsAudit);

            //retorna o numero da carta criada
            $this->session->set_flashdata('numero_carta_criada', $ano . $regiaoAdministrativa . $idBeneficiado);

            redirect('carta/index');
        }
        else
        {
			$this->load->model('Beneficiado_model');
			$data['all_beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();

            $this->load->model('Usuario_model');
            $data['all_carteiros'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_CARTEIROS);

            $this->load->model('Usuario_model');
            $data['all_repr_comunidade'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_REPRESENTANTE_COMUNIDADE);

			//$this->load->model('Usuario_model');
			//$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();
			//$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();

            //carrega as regioes administrativas
            $this->load->model('NatalSolidario_model');
            $data['all_regioes'] = $this->NatalSolidario_model->get_all_regiao_administrativa();

            $data['_view'] = 'carta/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a carta_pedido
     */
    function edit($id)
    {   
        // check if the carta_pedido exists before trying to edit it
        $data['carta_pedido'] = $this->Carta_model->get_carta_pedido($id);
        
        if(isset($data['carta_pedido']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('beneficiado','Beneficiado','required');
            $this->form_validation->set_rules('representante_comunidade','Representante Comunidade','required');
            $this->form_validation->set_rules('carteiro_associado','Carteiro','required');
            $this->form_validation->set_rules('regiao_administrativa','Região Administrativa','required');
			//$this->form_validation->set_rules('data_cadastro','Data Cadastro','required');
			//$this->form_validation->set_rules('numero','Numero','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					
					'beneficiado' => $this->input->post('beneficiado'),
					'representante_comunidade' => $this->input->post('representante_comunidade'),
					'carteiro_associado' => $this->input->post('carteiro_associado'),
                    'regiao_administrativa' => $this->input->post('regiao_administrativa')
                );

                $this->load->model('Carta_checklist_model');
                $checklistAnterior = $this->Carta_checklist_model->get_carta_checklist($id);

                $paramsChecklist = array(
                    'carta' => $this->input->post('checklist_carta'),
                    'formularo_social' => $this->input->post('checklist_form_social'),
                    'doc_identidade_responsaveis' => $this->input->post('checklist_doc_id_responsaveis'),
                    'certidao_nascimeno_crianca' => $this->input->post('checklist_cert_nasc_crianca'),
                    'doc_bolsa_familia' => $this->input->post('checklist_doc_bolsa_familia'),
                    'comprovante_escolar' => $this->input->post('checklist_comp_escolar'),
                    'doc_pne' => $this->input->post('checklist_doc_pne')
                );
                $this->Carta_checklist_model->update_carta_checklist($id, $paramsChecklist);

                $this->Carta_model->update_carta_pedido($id,$params);


                //auditoria
                $this->load->model('Registro_log_model');

                $paramsAudit = array(
                    'data_cadastro' => date('Y-m-d H:i:s'),
                    'usuario' => $this->ion_auth->user()->row()->id,
                    'acao' => self::ACAO_ALTERACAO,
                    'titulo' => "CARTA",
                    'conteudo_anterior' => http_build_query(array_merge($data['carta_pedido'], $checklistAnterior)),
                    'conteudo_posterior' => http_build_query(array_merge($params, $paramsChecklist))

                );

                $this->Registro_log_model->add_registro_log($paramsAudit);

                redirect('carta/index');
            }
            else
            {
				$this->load->model('Beneficiado_model');
				$data['all_beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();

				$this->load->model('Usuario_model');
                $data['all_carteiros'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_CARTEIROS);

                $this->load->model('Usuario_model');
                $data['all_repr_comunidade'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_REPRESENTANTE_COMUNIDADE);
				//$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();

                //carrega as regioes administrativas
                $this->load->model('NatalSolidario_model');
                $data['all_regioes'] = $this->NatalSolidario_model->get_all_regiao_administrativa();

                //carrega o checklist
                $this->load->model('Carta_checklist_model');
                $data['checklist'] = $this->Carta_checklist_model->get_carta_checklist($id);

                $data['_view'] = 'carta/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The carta_pedido you are trying to edit does not exist.');
    }
    
    function formulario($id) {
        // check if the carta_pedido exists before trying to edit it
        $data['carta_pedido'] = $this->Carta_model->get_carta_pedido($id);
        
        $this->load->model('Beneficiado_model');
        $data['beneficiado']  = $this->Beneficiado_model->get_beneficiado($data['carta_pedido']['beneficiado']);
        
        if ($data['beneficiado']['data_nascimento'] != null) {
            $data['beneficiado']['data_nascimento'] = date("d-m-Y", strtotime($data['beneficiado']['data_nascimento']));
        }
        
        $this->load->model('Responsavel_model');
        $data['responsavel']  = $this->Responsavel_model->get_responsavel($data['beneficiado']['responsavel']);
        if ($data['responsavel']['data_nascimento'] != null) {
            $data['responsavel']['data_nascimento'] = date("d-m-Y", strtotime($data['responsavel']['data_nascimento']));
        }
        
        $data['responsavel_adicional']  = null; 
        if ($data['beneficiado']['responsavel_adicional'] != null) {
            $data['responsavel_adicional']  = $this->Responsavel_model->get_responsavel($data['beneficiado']['responsavel_adicional']);
        }
        if ($data['responsavel_adicional']['data_nascimento'] != null) {
            $data['responsavel_adicional']['data_nascimento'] = date("d-m-Y", strtotime($data['responsavel_adicional']['data_nascimento']));
        }
        
        $this->load->model('Beneficiado_familia_model');
        $familiares = $this->Beneficiado_familia_model->get_familia_beneficiado($data['beneficiado']['id']);
        if (!empty($familiares)) {
            $data['familiares'] = array_column($familiares, 'familiar');
        }
        
        $this->load->model('Brinquedo_classificacao_model');
        $data['brinquedo_classificacoes'] = $this->Brinquedo_classificacao_model->get_all_classificacao_brinquedo();
        
        $this->load->model('Carta_brinquedo_model');
        $data['brinquedos'] = $this->Carta_brinquedo_model->get_brinquedos_por_carta($id);
        
        $this->load->model('Carta_programacao_model');
        $programacoes = $this->Carta_programacao_model->get_programacoes_por_carta($id);
        if (!empty($programacoes)) {
            $data['programacoes'] = array_column($programacoes, 'programacao');
        }
        
        if(isset($data['carta_pedido']['id'])) {
            
            //log_message('info',print_r('Validando', TRUE));
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('regiao_administrativa','Beneficiado - Comunidade','required');
            $this->form_validation->set_rules('nome','Beneficiado - Nome','required');
            $this->form_validation->set_rules('dataNascimento','Beneficiado - Data de nascimento','required');
            $this->form_validation->set_rules('sexo','Beneficiado - Sexo','required');
            $this->form_validation->set_rules('brinquedo1','1ª opção de brinquedo','required');
            $this->form_validation->set_rules('brinquedo1Tipo','Classificação da 1ª opção de brinquedo','required');
            
            if($this->form_validation->run()){
                
                $this->db->trans_start();
                //$this->db->trans_strict(FALSE);
                
                //ATUALIZACAO DOS BRINQUEDOS ===================================
                
                $params = array(
                    'carta' => $id,
                    'classificacao' => $this->input->post('brinquedo1Tipo'),
                    'descricao' => $this->input->post('brinquedo1'),
                    'prioridade' => 1,
                );
                
                if ($this->input->post('brinquedo1Id')) {
                    $this->Carta_brinquedo_model->update_carta_brinquedo($this->input->post('brinquedo1Id'), $params);
                } else {
                    $this->Carta_brinquedo_model->add_carta_brinquedo($params);
                }
                
                if ($this->input->post('brinquedo2') && $this->input->post('brinquedo2Tipo')) {
                    $params = array(
                        'carta' => $id,
                        'classificacao' => $this->input->post('brinquedo2Tipo'),
                        'descricao' => $this->input->post('brinquedo2'),
                        'prioridade' => 2,
                    );
                    
                    if ($this->input->post('brinquedo2Id')) {
                        $this->Carta_brinquedo_model->update_carta_brinquedo($this->input->post('brinquedo2Id'), $params);
                    } else {
                        $this->Carta_brinquedo_model->add_carta_brinquedo($params);
                    }
                }
                
                if ($this->input->post('brinquedo3') && $this->input->post('brinquedo3Tipo')) {
                    $params = array(
                        'carta' => $id,
                        'classificacao' => $this->input->post('brinquedo3Tipo'),
                        'descricao' => $this->input->post('brinquedo3'),
                        'prioridade' => 3,
                    );
                    
                    if ($this->input->post('brinquedo3Id')) {
                        $this->Carta_brinquedo_model->update_carta_brinquedo($this->input->post('brinquedo3Id'), $params);
                    } else {
                        $this->Carta_brinquedo_model->add_carta_brinquedo($params);
                    }
                }
                
                //ATUALIZACAO DO RESPONSAVEL ===================================
                
                $dataNascimentoResponsavel = strtr($this->input->post('responsavel1DataNascimento'), '/', '-');
                
                $params = array(
                    'nome' => $this->input->post('responsavel1Nome'),
                    'data_nascimento' => date('Y-m-d', strtotime($dataNascimentoResponsavel)),
                    'documento_numero' => $this->input->post('responsavel1NumeroDocumento'),
                    'documento_tipo' => $this->input->post('responsavel1Documento'),
                    'email' => $this->input->post('responsavel1Email'),
                    'endereco' => $this->input->post('responsavel1Endereco'),
                    'telefone' => preg_replace("/[^0-9,.]/", "", $this->input->post('responsavel1Telefone') ),
                    'telefone_operadora' => $this->input->post('responsavel1TelefoneOperadora'),
                    'telefone_whatsapp' => $this->input->post('responsavel1TelefoneWhatsapp'),
                    'ocupacao' => $this->input->post('responsavel1Ocupacao'),
                    'escolaridade' => $this->input->post('responsavel1Escolaridade'),
                );
                
                $this->Responsavel_model->update_responsavel($data['responsavel']['id'],$params);
                
                //ATUALIZACAO DO RESPONSAVEL ADICIONAL =========================
                
                $idResponsavelAdicional = null;
                if ($this->input->post('responsavel2DataNascimento')
                    && $this->input->post('responsavel2Nome')) {
                
                    $dataNascimentoResponsavel = strtr($this->input->post('responsavel2DataNascimento'), '/', '-');
                    
                    $params = array(
                        'nome' => $this->input->post('responsavel2Nome'),
                        'data_nascimento' => date('Y-m-d', strtotime($dataNascimentoResponsavel)),
                        'documento_numero' => $this->input->post('responsavel2NumeroDocumento'),
                        'documento_tipo' => $this->input->post('responsavel2Documento'),
                        'email' => $this->input->post('responsavel2Email'),
                        'endereco' => $this->input->post('responsavel2Endereco'),
                        'telefone' => preg_replace("/[^0-9,.]/", "", $this->input->post('responsavel2Telefone') ),
                        'telefone_operadora' => $this->input->post('responsavel2TelefoneOperadora'),
                        'telefone_whatsapp' => $this->input->post('responsavel2TelefoneWhatsapp'),
                        'ocupacao' => $this->input->post('responsavel2Ocupacao'),
                        'escolaridade' => $this->input->post('responsavel2Escolaridade'),
                    );
                    
                    if ($data['responsavel_adicional']['id']) {
                        $idResponsavelAdicional = $data['responsavel_adicional']['id'];
                        $this->Responsavel_model->update_responsavel($data['responsavel_adicional']['id'],$params);
                    } else {
                        $idResponsavelAdicional = $this->Responsavel_model->add_responsavel($params);
                    }
                }
                
                //ATUALIZACAO DO BENEFICIADO ===================================
                
                $dataNascimentoBeneficiado = strtr($this->input->post('dataNascimento'), '/', '-');
                
                $params = array(
                    'nome' => $this->input->post('nome'),
                    'data_nascimento' => date('Y-m-d', strtotime($dataNascimentoBeneficiado)),
                    'sexo' => $this->input->post('sexo'),
                    'responsavel_adicional' => $idResponsavelAdicional,
                    'pais_separados' => $this->input->post('paisSeparados'),
                );
                $this->Beneficiado_model->update_beneficiado($data['beneficiado']['id'],$params);
                
                $this->Beneficiado_familia_model->delete_por_beneficiado($data['beneficiado']['id']);
                
                if ($this->input->post('familia')) {
                    //log_message('info',print_r($this->input->post('familia'), TRUE));
                    foreach($this->input->post('familia') as $familiar) {
                        $params = array(
                            'beneficiado' => $data['beneficiado']['id'],
                            'familiar' => $familiar,
                        );
                        $this->Beneficiado_familia_model->add_beneficiado_familia($params);
                    }
                }                
                
                //auditoria
                /*
                $this->load->model('Registro_log_model');
                
                $paramsAudit = array(
                    'data_cadastro' => date('Y-m-d H:i:s'),
                    'usuario' => $this->ion_auth->user()->row()->id,
                    'acao' => self::ACAO_ALTERACAO,
                    'titulo' => "CARTA",
                    'conteudo_anterior' => http_build_query(array_merge($data['carta_pedido'], $checklistAnterior)),
                    'conteudo_posterior' => http_build_query(array_merge($params, $paramsChecklist))
                    
                );
                $this->Registro_log_model->add_registro_log($paramsAudit);
                */
                
                //log_message('info',print_r('Validando', TRUE));
                $params = array(
                    'atendimento_preferencial' => $this->input->post('preferencial'),
                    'regiao_administrativa' => $this->input->post('regiao_administrativa'),
                    'escola' => $this->input->post('escola'),
                    'ano' => $this->input->post('ano'),
                    'renda_familiar' => $this->input->post('renda'),
                    'moradia' => $this->input->post('moradia'),
                );
                
                if(is_uploaded_file($_FILES['imagem']['tmp_name'])) {
                    
                    $curYear = date('Y'); 
                    
                    if (!is_dir('uploads')) {
                        mkdir('./uploads', 0777, true);
                        //log_message('info',print_r('Diretorio uploads criado', TRUE));
                    } else {
                        //log_message('info',print_r('Diretorio uploads ja existe', TRUE));
                    }
                    $dir_exist = true; // flag for checking the directory exist or not
                    if (!is_dir('uploads/' . $curYear)) {
                        mkdir('./uploads/' . $curYear, 0777, true);
                        //$dir_exist = false; // dir not exist
                    }
                    
                    
                    $path = $_FILES['imagem']['name'];
                    //log_message('info',print_r($data['carta_pedido'].['numero'], TRUE));
                    //log_message('info',print_r(pathinfo($path, PATHINFO_EXTENSION), TRUE));
                    
                    //$cartaNumero = $data['carta_pedido']['numero'];
                    //$extensao = pathinfo($path, PATHINFO_EXTENSION);
                    
                    //log_message('info',print_r('CARTA_NUMERO_' . $cartaNumero . '.' . $extensao, TRUE));
                    
                    $newName = 'CARTA_NUMERO_' . $data['carta_pedido']['numero'] . '.' . pathinfo($path, PATHINFO_EXTENSION); 
                    
                    //CONFIGURACAO UPLOAD
                    $config['upload_path']      = './uploads/'.$curYear;
                    $config['allowed_types']    = 'gif|jpg|jpeg|png';
                    $config['file_name']        = $newName;
                    #$config['max_size']    	= '100';
                    #$config['max_width']       = '1024';
                    #$config['max_height']      = '768';
                    $this->load->library('upload', $config);
                    
                    $this->upload->do_upload('imagem');
                    $params['arquivo'] = $curYear . '/' . $newName;
                }
                //ATUALIZACAO DA CARTA =========================================

                $this->Carta_model->update_carta_pedido($id,$params);
                
                $this->Carta_programacao_model->delete_por_carta($id);
                
                if ($this->input->post('programacao')) {
                    foreach($this->input->post('programacao') as $programacao) {
                        $params = array(
                            'carta' => $id,
                            'programacao' => $programacao,
                        );
                        $this->Carta_programacao_model->add_carta_programacao($params);
                    }
                }
                
                
                $this->db->trans_complete(); # Completing transaction
                
                //Optional
                
                if ($this->db->trans_status() === FALSE) {
                    # Something went wrong.
                    $this->db->trans_rollback();
                }
                else {
                    # Everything is Perfect.
                    # Committing data to the database.
                    $this->db->trans_commit();
                }
                
                
                redirect('carta/index');
            }
            else
            {
                $this->load->model('Beneficiado_model');
                $data['all_beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();
                
                $this->load->model('Usuario_model');
                $data['all_carteiros'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_CARTEIROS);
                
                $this->load->model('Usuario_model');
                $data['all_repr_comunidade'] = $this->Usuario_model->get_all_usuarios_by_perfil(self::GRUPO_REPRESENTANTE_COMUNIDADE);
                //$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();
                
                //carrega as regioes administrativas
                $this->load->model('NatalSolidario_model');
                $data['all_regioes'] = $this->NatalSolidario_model->get_all_regiao_administrativa();
                
                //carrega o checklist
                $this->load->model('Carta_checklist_model');
                $data['checklist'] = $this->Carta_checklist_model->get_carta_checklist($id);
                
                $data['_view'] = 'carta/formulario';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The carta_pedido you are trying to edit does not exist.');
    }
}
