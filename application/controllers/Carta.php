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
            
        }

    } 

    /*
     * Listing of cartas
     */
    function index()
    {
        $data['cartas'] = $this->Carta_model->get_all_cartas();
        
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
}
