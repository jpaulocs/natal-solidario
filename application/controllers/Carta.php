<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Carta extends CI_Controller{

    const GRUPO_CARTEIROS = 5;
    const GRUPO_REPRESENTANTE_COMUNIDADE = 3;

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
            $this->session->set_userdata('usuario_logado', $user->email);
            $this->session->set_userdata('grupos_usuario', $user_groups);
            
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
				//'carteiro_associado' => $this->input->post('carteiro_associado'),
				'data_cadastro' => date('Y-m-d H:i:s'),
				'numero' => $ano . $regiaoAdministrativa . $idBeneficiado,
                'regiao_administrativa' => $this->input->post('regiao_administrativa')
            );
            
            $carta_pedido_id = $this->Carta_model->add_carta_pedido($params);

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

                $this->Carta_model->update_carta_pedido($id,$params);            
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

                $data['_view'] = 'carta/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The carta_pedido you are trying to edit does not exist.');
    }
}
