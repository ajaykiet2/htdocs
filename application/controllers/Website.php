<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		
		$this->load->model(array('faq','gallery', 'course','accreditation','guidline'));
		#loading other modules
		#--------------
	}
	
	#default function
	public function index(){
		$data = array(
			'env' => $this->environment->load()
		);	
		$this->load->view('website/welcome', $data);
	}
	
	#function for frequently asked question
	public function faq(){
		
		$pageNum = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		$limit = 5;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		
		$faqs = $this->faq->load($params);
		
		if($faqs != null){
			$data = array(
				"env" => $this->environment->load(),
				'qadata' => $faqs,
				'pagination' => (object)array(
					'total' => $this->faq->total(),
					'pageNum' => $pageNum,
					'limit'	=> $limit
				),
			);
			$this->load->view('website/faq',$data);
		}else{
			$data = array(
				'env' => $this->environment->load(),
			);
			$this->load->view('website/error404', $data);
		}
		
	}
	
	public function guidlines(){
		$guidlines = $this->guidline->getAll();
		$data = array(
			"env" => $this->environment->load(),
			'guidlines' => $guidlines,
		);
		$this->load->view('website/guidlines',$data);
	}
	
	#function for frequently asked question
	public function gallery(){
		$pageIdx = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$pageNum = ($pageIdx == (int) $pageIdx) ? (int) $pageIdx : 0;
		$limit = 9;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		
		$galleries = $this->gallery->load($params);
		
		if($galleries != null){
			$data = array(
				'env' => $this->environment->load(),
				'galleries' => $galleries,
				'pagination' => (object)array(
					'total' => $this->gallery->total(),
					'pageNum' => $pageNum,
					'limit'	=> $limit
				),
			);	
			$this->load->view('website/gallery', $data);
		}else{
			$data = array(
				'env' => $this->environment->load(),
			);
			$this->load->view('website/error404', $data);
		}
		
	}
	#function for frequently asked question
	public function galleryDetail(){
		$id = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		$galleryID = ($id == (int)$id) ? (int)$id : 1;
		
		$gallery = $this->gallery->get($galleryID);
		if($gallery != null){
			$data = array(
				'env' => $this->environment->load(),
				'gallery' => $gallery,
			);
		$this->load->view('website/gallery_detail', $data);
		}else{
			$data = array(
				'env' => $this->environment->load(),
			);
			$this->load->view('website/error404', $data);
		}
		
	}
	
	
	#function for frequently asked question
	public function accreditations(){
		$pageIdx = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		$pageNum = ($pageIdx == (int) $pageIdx) ? (int) $pageIdx : 0;
		$limit = 6;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		
		$accreditations = $this->accreditation->load($params);
		$data = array(
			'env' => $this->environment->load(),
			'accreditations' => $accreditations,
			'pagination' => (object)array(
				'total' => $this->accreditation->total(),
				'pageNum' => $pageNum,
				'limit'	=> $limit
			),
		);	
		$this->load->view('website/accreditations', $data);
		
		
	}
	#function for frequently asked question
	public function accreditationDetail(){
		$ID = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
		
		$accreditation = $this->accreditation->get($ID);
		if($accreditation != null){
			$data = array(
				'env' => $this->environment->load(),
				'accreditation' => $accreditation
			);
			$this->load->view('website/accreditation', $data);
		}else{
			$data = array(
				'env' => $this->environment->load(),
			);
			$this->load->view('website/error404', $data);
		}
		
	}
	
	
	#function for frequently asked question
	public function course(){
		$pageNum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$limit = 9;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		$courses = $this->course->load($params);
		$data = array(
			'env' => $this->environment->load(),
			'courses' => $courses,
			'pagination' => (object)array(
				'total' => $this->course->total(),
				'pageNum' => $pageNum,
				'limit'	=> $limit
			),
		);	
		$this->load->view('website/course', $data);
		
	}
	
	#function for contact page
	public function contact(){
		if($this->input->is_ajax_request()){
			$data = array(
				"contact_name" => $this->input->post("name"),
				"contact_mobile" => $this->input->post("mobile"),
				"contact_email" => $this->input->post("email"),
				"contact_message" => $this->input->post("message"),
				"user" => "Ajay Kumar"
			);
			
			$response = array();
			$this->load->library('email',EMAIL_CONFIG);
			$this->email->from('admin@bricksadvisors.com', 'Ajay Kumar');
			$this->email->to('ajaykiet2@gmail.com');
			$this->email->subject('Enquiry Request');
			$body = $this->load->view("email/contact_request",$data,true);
			$this->email->message($body);
			if (!$this->email->send()) {
				$response['status'] = false;
				$response['message'] = $this->email->print_debugger();
			}else {
				$response['status'] = true;
				$response['message'] = "Your query has been sent successfully, Our representative will contact you shortly";
			}
			print json_encode($response);
			return;
		}
		$data = array(
			'env' => $this->environment->load()
		);
		$this->load->view('website/contact',$data);
	}
}
