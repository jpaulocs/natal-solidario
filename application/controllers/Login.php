<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
		$this->load->library('ion_auth');
        
    }

	public function index()
	{
		$this->load->view('login');
	}
	
	public function logar(){
		
		$usuario = $this->input->post("usuario");
		$senha = $this->input->post("senha");
		$remember = ($this->input->post('remember')=='on');

		if($this->ion_auth->login($usuario, $senha, $remember)) {
			redirect(base_url());
		} else {
			//caso a senha/usuário estejam incorretos, então mando o usuário novamente para a tela de login com uma mensagem de erro.
			$dados['erro'] = "Usuário/Senha incorretos";
			$this->load->view("login", $dados);
		}
		
	}
	
	public function logout(){
		$this->ion_auth->logout();
		redirect(base_url());
		
	}
	
}
