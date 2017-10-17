<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Carta extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Carta_model');
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
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'beneficiado' => $this->input->post('beneficiado'),
				'representante_comunidade' => $this->input->post('representante_comunidade'),
				'carteiro_associado' => $this->input->post('carteiro_associado'),
				'data_cadastro' => date('Y-m-d H:i:s'),
				'numero' => date('Y') . $this->input->post('regiao_administrativa') . 
                str_pad($this->input->post('beneficiado'), 5, "0", STR_PAD_LEFT),
                //'regiao_administrativa' = $this->input->post('regiao_administrativa')
            );
            
            $carta_pedido_id = $this->Carta_model->add_carta_pedido($params);
            redirect('carta/index');
        }
        else
        {
			$this->load->model('Beneficiado_model');
			$data['all_beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();

			$this->load->model('Usuario_model');
			$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();
			//$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();
            
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
			$this->form_validation->set_rules('data_cadastro','Data Cadastro','required');
			$this->form_validation->set_rules('numero','Numero','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'removida' => $this->input->post('removida'),
					'beneficiado' => $this->input->post('beneficiado'),
					'representante_comunidade' => $this->input->post('representante_comunidade'),
					'carteiro_associado' => $this->input->post('carteiro_associado'),
					'data_cadastro' => $this->input->post('data_cadastro'),
					'numero' => $this->input->post('numero'),
                );

                $this->Carta_model->update_carta_pedido($id,$params);            
                redirect('carta/index');
            }
            else
            {
				$this->load->model('Beneficiado_model');
				$data['all_beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();

				$this->load->model('Usuario_model');
				$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();
				$data['all_usuarios'] = $this->Usuario_model->get_all_usuarios();

                $data['_view'] = 'carta/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The carta_pedido you are trying to edit does not exist.');
    }
}
