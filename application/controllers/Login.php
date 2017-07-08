<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		parent::__construct();
		$this->load->model('employee');
		$this->load->library('session');
	}
	
	#function for login page
	public function index(){
		if($this->input->is_ajax_request()){
			return false;
		}
		$email = $this->input->post('emailID');
		$password = $this->input->post('password');
		$employee = $this->employee->checkLoggedIn();
		$logged_in = (isset($employee['logged_in'])) ? true : false;
		if($logged_in){
			switch($employee['role']){
				case "admin":
					redirect(base_url('admin'));
					break;
				case "user":
					redirect(base_url('employee/dashboard'));
					break;
				default:
			}
		}elseif($email && $password){
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules("emailID", "Email ID", "trim|required|valid_email");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|max_length[20]");
			
			if($this->form_validation->run() == FALSE){
				$data['response'] = (object)array(
					'status' => false,
					'message' => validation_errors()
				);
				$this->load->view('website/login', $data);
			}else{
				$employee = $this->employee->login($email, $password);
				
				if($employee['logged_in']){
					switch($employee['role']){
						case "admin":
							redirect(base_url('admin/'));
							break;
						case "user":
							redirect(base_url('employee/dashboard'));
							break;
						default:
					}
				}else{
					$data['response'] = (object)array(
						'status' => false,
						'message' => "Invalid Credentials"
					);
					$this->load->view('website/login', $data);
				}
			}
		}else{
			$this->load->view('website/login');
		}
	}
	public function email_exists($emailID) {
		if(!$this->employee->email_exists($emailID)){
			$this->form_validation->set_message('email_exists', 'This email address is not exist in our system.' );
			return false;
		}else{
			return true;	
		}
	}
	public function forgotPassword(){
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules("emailID", "Email ID", "trim|required|valid_email");
		$data = array("response"=>null);
		if($this->form_validation->run() == FALSE){
			$data['response'] = (object)array(
				'status' => false,
				'source' => "forgotPassword",
				'message' => validation_errors()
			);
		}else{
			$emailID = $this->input->post('emailID');
			if($this->email_exists($emailID)){
				$token = $this->employee->forgotPassword($emailID);
				if($token != null){
					$data= array(
						'user' => "User",
						"emailID" => $emailID,
						"token" => $token,
						'logo'	=> base_url('assets/img/hrdlogo.jpg'),
					);
					
					$config = array(
					  'protocol' => 'mail',
					  'mailpath' => '/usr/sbin/sendmail',
					  'mailtype' => 'html',
					  'charset' => 'iso-8859-1',
					  'wordwrap' => TRUE
					);
					$this->load->library('email');
					$this->email->initialize($config);
					
					$this->email->set_newline("\r\n");
					$this->email->from('support@hrdfi.com', 'HRD Foundation');
					$this->email->to($emailID);
					$this->email->subject('Password Reset Request');
					$body = $this->load->view("email/password_reset",$data,true);
					$this->email->message($body);
					
					
					if ($this->email->send()) {
						$data['response'] = (object)array(
							'status' => true,
							'source' => "forgotPassword",
							'message' => "Instructions has been successfully sent to your email id. Please check your email id."
						);
						
					}else {
						
						$data['response'] = (object)array(
							'status' => false,
							'source' => "forgotPassword",
							'message' => $this->email->print_debugger()
						);
					}
				}else{
					$data['response'] = (object)array(
						'status' => false,
						'source' => "forgotPassword",
						'message' => "We are unable to process your request"
					);
				}
				
			}else{
				$data['response'] = (object)array(
					'status' => false,
					'source' => "forgotPassword",
					'message' => "The requested email id is not registered with our system. Please check it and try again"
				);
			}
		}
		$this->load->view('website/login', $data);
	}
	
	public function resetPassword(){
		$this->db->cache_delete_all();
		$token = $this->input->get_post('token');
		$data = array("response" => null);
		$data['env'] = $this->environment->load();
		$emp = $this->employee->getTokenInfo($token);
		if(empty($emp)){
			$this->load->view("website/error404", $data);
			return;
		}
		
		if($this->input->is_ajax_request()){
			unset($data['env']);
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|max_length[15]");
			$this->form_validation->set_rules("re_password", "Repeat Password", "trim|required|matches[password]");
			
			if($this->form_validation->run() == FALSE){
				$data['response'] = (object)array(
					'status' => false,
					'source' => "resetPassword",
					'message' => validation_errors()
				);
				echo json_encode($data);
				return;
			}else{
				$password = $this->input->post("password");
				if($emp != null ){
					if(daysFromToday($emp->timeStamp) < 2){
						$this->employee->changePassword($emp->employeeID, $password);
						
						$data['response'] = (object)array(
							'status' => true,
							'source' => "resetPassword",
							'message' => "Your password has been successfully changed."
						);
						$this->employee->expireToken($emp->employeeID);
					}else{
						$this->employee->expireToken($emp->employeeID);
						$data['response'] = (object)array(
							'status' => false,
							'source' => "resetPassword",
							'message' => "Your token has been expired or removed parmanently."
						);
					}
					
				}else{
					$data['response'] = (object)array(
						'status' => false,
						'source' => "resetPassword",
						'message' => "Access Denied!"
					);
				}
			}
			print json_encode($data);
			return;
		}
		if($emp != null){
			if(daysFromToday($emp->timeStamp) < 2){
				$data['response'] = (object)array(
					'status' => true,
					'source' => "resetPassword",
					'token'	=> $token,
				);
				$this->load->view("website/resetPassword", $data);
			}else{
				$data['response'] = (object)array(
					'status' => true,
					'source' => "resetPassword",
					'message'	=> "Your token has been expired or removed parmanently.",
				);
				$this->load->view("website/token_expired", $data);
				$this->employee->expireToken($emp->employeeID);
			}
		}else{
			$this->load->view("website/token_expired", $data);
		}
	}
	
	public function logout(){
		$this->employee->logout();
		redirect(base_url('login'));
	}
	
}