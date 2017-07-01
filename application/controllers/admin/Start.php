<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->db->cache_delete_all();
		$this->load->model(array('employee','faq','gallery', 'course','accreditation'));
		#loading other modules
		#--------------
			if(!$this->_isAdmin()){
			redirect(base_url("login"));
		}
	}
	
	private function _isAdmin(){
		$empInfo = $this->employee->checkLoggedIn();
		if(isset($empInfo['role'])){
			return  ($empInfo['role'] === 'admin') ? true : false;
		}else{
			return false;
		}
	}
	
	#default function
	public function index(){
		$data = array(
			'env' => $this->environment->load('admin')
		);	
		$this->viewPage('admin/dashboard', $data);
	}
	
	
	
	private function viewPage($template, $data){
		if($this->input->is_ajax_request()){
			$this->load->view($template, $data);
		}else{
			$this->load->view("employee/includes/header",$data);
			$this->load->view($template, $data);
			$this->load->view("employee/include/footer");
		}
		
	}
	
}
