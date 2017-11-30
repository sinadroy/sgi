<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
            //$this->load->view('welcome_message');
            $data = array();
            $data['web_dir'] = base_url();
            $this->load->view('login', $data);
    }
        
        
        function principal() {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                // en caso contrario cargamos la vista principal
                //$this->load->view('principal_view');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('principal',$data);
            }
        }
        function logout(){
            $this->session->sess_destroy();
            redirect(base_url());
        }
        public function administracao()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Administracao', $data);
            }
        }
        public function rhumanos()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('RHumanos', $data);
            }
        }
        public function presencas()
	{
            //$this->load->view('welcome_message');
            $data = array();
            $data['web_dir'] = base_url();
            $this->load->view('Presencas', $data);
        }
        public function academico()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Academico', $data);
            }
        }
        public function financas()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Financas', $data);
            }
        }
        public function contabilidade()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Contabilidade', $data);
            }
        }
        public function biblioteca()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Biblioteca', $data);
            }
        }
        public function patrimonio()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Patrimonio', $data);
            }
        }
        public function intranet()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Intranet', $data);
            }
        }
        public function jcientificas()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('JCientificas', $data);
            }
        }
        public function auditorias()
	{
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Auditorias', $data);
            }
        }
        public function arquivos()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Arquivos', $data);
            }
        }
        public function presencas_administrativos()
	    {
            $data = array();
            $data['web_dir'] = base_url();
            $this->load->view('Presencas_Administrativos', $data);
        }
        public function backup()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Backup', $data);
            }
        }
        public function estatisticas()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Estatisticas', $data);
            }
        }
        public function secretaria()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Secretaria', $data);
            }
        }
        public function calendarios()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('Calendarios', $data);
            }
        }
        function planificacao() {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                // en caso contrario cargamos la vista principal
                //$this->load->view('principal_view');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('planificacao/index',$data);
            }
        }
        public function cientifica()
	    {
            if (!$this->session->userdata('idusuario')){
                // redirigimos a la función login
                redirect(base_url());
            } else {
                //$this->load->view('welcome_message');
                $data = array();
                $data['web_dir'] = base_url();
                $this->load->view('ACientifica', $data);
            }
        }
}
