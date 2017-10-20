<?php
/* 
 * João Paulo
 * jpaulocs@gmail.com
 */
 
class Dashboard extends CI_Controller{
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
			
		}

		// $username = '';
		// $password = '';
		// $email = '@gmail.com';
		// $additional_data = array(
		// 						'first_name' => '',
		// 						'last_name' => '',
		// 						);
		// $group = array('1'); // Sets user to admin.

		// $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        
    }

    function index()
    {

        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}
