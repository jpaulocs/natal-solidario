<?php

/* 
 * João Paulo
 * jpaulocs@gmail.com
 */

class Admin_Controller extends CI_Controller {

	function __construct()
    {
        parent::__construct();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_flashdata('message', 'You must be an admin to view this page');
            redirect('login');
        } else {
            $user = $this->ion_auth->user()->row();
            $this->session->set_userdata('usuario_logado', $user->email);
            $this->session->set_userdata('usuario_logado_id', $user->id);
            
        }
        
    }

    function inicio()
    {
    	//validacao do usuario
    	$this->verify_login();

    }

    // Verify user login (regardless of user group)
	protected function verify_login($redirect_url = NULL)
	{
		// if ( !$this->ion_auth->logged_in() )
		// {
		// 	if ( $redirect_url==NULL )
		// 		$redirect_url = '';

		// 	redirect($redirect_url);
		// }
	}
}