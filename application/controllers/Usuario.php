<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Usuario extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
    } 

    /*
     * Listing of usuarios
     */
    function index()
    {
        $data['usuarios'] = $this->Usuario_model->get_all_usuarios();
        
        $data['_view'] = 'usuario/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new usuario
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'nome' => $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'senha' => $this->input->post('senha'),
				'perfil' => $this->input->post('perfil'),
				'removido' => $this->input->post('removido'),
				'area_abrangencia' => $this->input->post('area_abrangencia'),
				'referencia' => $this->input->post('referencia'),
				'telefone' => $this->input->post('telefone'),
            );
            
            $usuario_id = $this->Usuario_model->add_usuario($params);
            redirect('usuario/index');
        }
        else
        {            
            $data['_view'] = 'usuario/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a usuario
     */
    function edit($id)
    {   
        // check if the usuario exists before trying to edit it
        $data['usuario'] = $this->Usuario_model->get_usuario($id);
        
        if(isset($data['usuario']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'nome' => $this->input->post('nome'),
					'email' => $this->input->post('email'),
					'senha' => $this->input->post('senha'),
					'perfil' => $this->input->post('perfil'),
					'removido' => $this->input->post('removido'),
					'area_abrangencia' => $this->input->post('area_abrangencia'),
					'referencia' => $this->input->post('referencia'),
					'telefone' => $this->input->post('telefone'),
                );

                $this->Usuario_model->update_usuario($id,$params);            
                redirect('usuario/index');
            }
            else
            {
                $data['_view'] = 'usuario/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The usuario you are trying to edit does not exist.');
    }
}
