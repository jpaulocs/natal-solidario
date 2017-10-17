<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Beneficiado extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Beneficiado_model');
    } 

    /*
     * Listing of beneficiados
     */
    function index()
    {
        $data['beneficiados'] = $this->Beneficiado_model->get_all_beneficiados();
        
        $data['_view'] = 'beneficiado/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new beneficiado
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('responsavel','Responsavel','required');
		$this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('data_nascimento','Data Nascimento','required');
		
		if($this->form_validation->run())     
        {   
            $date1 = strtr($this->input->post('data_nascimento'), '/', '-');
            $params = array(
				'responsavel' => $this->input->post('responsavel'),
                'nome' => $this->input->post('nome'),
                'data_nascimento' => date('Y-m-d', strtotime($date1)),
				'data_cadastro' => date('Y-m-d H:i:s'),
            );
            
            $beneficiado_id = $this->Beneficiado_model->add_beneficiado($params);
            redirect('beneficiado/index');
        }
        else
        {
			$this->load->model('Responsavel_model');
			$data['all_responsaveis'] = $this->Responsavel_model->get_all_responsaveis();
            
            $data['_view'] = 'beneficiado/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a beneficiado
     */
    function edit($id)
    {   
        // check if the beneficiado exists before trying to edit it
        $data['beneficiado'] = $this->Beneficiado_model->get_beneficiado($id);
        
        if(isset($data['beneficiado']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('responsavel','Responsavel','required');
			$this->form_validation->set_rules('nome','Nome','required');
			$this->form_validation->set_rules('data_nascimento','Data Nascimento','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'removido' => $this->input->post('removido'),
					'responsavel' => $this->input->post('responsavel'),
					'data_cadastro' => $this->input->post('data_cadastro'),
					'nome' => $this->input->post('nome'),
					'data_nascimento' => $this->input->post('data_nascimento'),
                );

                $this->Beneficiado_model->update_beneficiado($id,$params);            
                redirect('beneficiado/index');
            }
            else
            {
				$this->load->model('Responsavel_model');
				$data['all_responsaveis'] = $this->Responsavel_model->get_all_responsaveis();

                $data['_view'] = 'beneficiado/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The beneficiado you are trying to edit does not exist.');
    }
}
