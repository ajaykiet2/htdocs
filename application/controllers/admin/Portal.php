<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->db->cache_delete_all();
		
		#loading other modules
		#--------------
		$this->load->library('excel');
		$this->load->model(array(
			'employee',
			'faq',
			'gallery',
			'course',
			'accreditation',
			'company',
			'chepter',
			'slide',
			'assessment',
			'guideline'
		));
		
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
	
	#Company page will load function
	public function company(){
		$data = array(
			'env' => $this->environment->load('admin')
		);	
		$this->load->view('admin/company', $data);
	}
	
	#Company page will load function
	public function companyDetail(){
		
		$companyID = $this->encrypt->decode($this->uri->segment(4));
		
		$companyInfo = $this->company->load($companyID);
		$courses = $this->company->getCourses($companyID); 
		$data['env'] = $this->environment->load('admin');
		if($companyInfo){
			$data['companyInfo'] = $companyInfo;
			$data['courses'] = $courses;
			$this->load->view('admin/company_detail', $data);
		}else{
			$this->load->view('admin/error404', $data);
		}
	}
	
	#Department page will load function
	public function department(){
		$data = array(
			'env' => $this->environment->load('admin')
		);	
		$this->load->view('admin/department', $data);
	}
	
	#Employee page will load
	public function employee(){
		$action = $this->input->post("action");
		if($action === 'uploadEmployee'){
			 $configUpload['upload_path'] = FCPATH.'uploads/excel/';
			 $configUpload['allowed_types'] = 'xls|xlsx|csv';
			 $configUpload['max_size'] = '5000';
			 $this->load->library('upload', $configUpload);
			 $this->upload->do_upload('file_to_upload');
			 
			 $upload_data = $this->upload->data();
			 $file_name = $upload_data['file_name'];
			 
			$objReader= PHPExcel_IOFactory::createReader('Excel2007');
			//Set to read only
			$objReader->setReadDataOnly(true); 
			//Load excel file
			$objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);	
			
			$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); 
			$objWorksheet=$objPHPExcel->setActiveSheetIndex(0); 
			$emp_data = array();
			$companyID = $this->input->post("companyID");
			$departmentID = $this->input->post("departmentID");
			
			for($i=2;$i<=$totalrows;$i++){
				$emp_data = array(
					'name' => $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(),
					'email' => $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(),
					'mobile' => $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(),
					'employeeCode' => $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(),
					'managerName' => $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(),
					'designation' => $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(),
					'address' => $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(),
					'panCard' => $objWorksheet->getCellByColumnAndRow(7,$i)->getValue(),
					'aadharCard' => $objWorksheet->getCellByColumnAndRow(8,$i)->getValue(),
					'representative' => 0,
					'companyID' => $companyID,
					'departmentID' => $departmentID,
				);
				if(!$this->employee->email_exist(email))
					$this->employee->add($emp_data);
			}
		}
		
		$data = array(
			'env' => $this->environment->load('admin')
		);	
		$this->load->view('admin/employee', $data);
	}
	
	public function employeeDetail(){
		$employeeID = $this->encrypt->decode($this->uri->segment(3));
		$env = $this->environment->load('admin');
		$data = array(
			'env' => $env,
			'employee' => $this->employee->getInfo($employeeID),
			'courses' => $this->employee->getCourse($employeeID),
		);
		
		if(!empty($data['employee'])){
			
			$this->load->view('admin/employee_detail', $data);
		}else{
			$this->load->view('admin/error404', $data);
		}
	}
	
	
	#function for frequently asked question
	public function course(){
		$pageNum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$limit = 12;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		$courses = $this->course->load($params);
		$data['env'] = $this->environment->load('admin');
		$data['courses'] = $courses;
		$data['pagination'] = (object)array(
			'total' => $this->course->total(),
			'pageNum' => $pageNum,
			'limit'	=> $limit
		);
		$this->load->view('admin/course', $data);
	}
	
	public function courseDetail(){
		$courseID = $this->encrypt->decode($this->uri->segment(4));
		
		$course = $this->course->getInfo($courseID);
		$chepters = $this->course->getChepters($courseID);
		
		$data['env'] =  $this->environment->load('admin');
		$data['courseInfo'] =  $course;
		$data['chepters'] =  $chepters;
		
		if(!empty($course)){
			
		$this->load->view('admin/course_detail', $data);
		}else{
			$this->load->view('admin/error404', $data);
		}	
	}
	
	public function chepterDetail(){
		$courseID = $this->encrypt->decode($this->uri->segment(3));
		$chepterID = $this->encrypt->decode($this->uri->segment(5));
		$data['env'] = $this->environment->load('admin');
		$data['chepterInfo'] = $this->chepter->load($courseID, $chepterID);
		
		if(!empty($data['chepterInfo'])){
			$data['slides'] = $this->chepter->getSlides($chepterID);
			$data['questions'] = $this->chepter->getQuestions($chepterID);
			$this->load->view('admin/chepter_detail', $data);
		}else{
			$this->load->view('admin/error404', $data);
		}
	}
	
	#==============================================================
	# slides action start
	public function slide(){
		
		$courseID = $this->encrypt->decode($this->uri->segment(3));
		$chepterID = $this->encrypt->decode($this->uri->segment(5));
		$action = $this->uri->segment(7);
		#==================================================
		$data['env'] =  $this->environment->load('admin');
		$data['action'] =  $action;
		#---------------------------------------------------
		switch($action){
			case "new":
				
				$data['chepterInfo'] =  $this->chepter->load($courseID, $chepterID);
				if(!empty($data['chepterInfo'])){
					$this->load->view('admin/new_slide', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			case "edit":
				$slideID = $this->encrypt->decode($this->uri->segment(8));
				$data['chepterInfo'] =  $this->chepter->load($courseID, $chepterID);
				$data['slideInfo'] = $this->slide->get($slideID);
				if(!empty($data['chepterInfo']) && !empty($data['slideInfo'])){
					$this->load->view('admin/new_slide', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			case "view":
				$slideID = $this->encrypt->decode($this->uri->segment(8));
				$data['chepterInfo'] =  $this->chepter->load($courseID, $chepterID);
				$data['slideInfo'] = $this->slide->get($slideID);
				if(!empty($data['chepterInfo']) && !empty($data['slideInfo'])){
					$this->load->view('admin/view_slide', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			default: $this->load->view('admin/error404', $data);
		}
		#---------------------------------------------------
		return;
	}
	
	
	#==============================================================
	# Guideline action start
	public function guideline(){
		
		$action = $this->uri->segment(4);
		#==================================================
		$data['env'] =  $this->environment->load('admin');
		$data['action'] =  $action;
		#---------------------------------------------------
		switch($action){
			case "new":
				$this->load->view('admin/new_guidline',$data);
			break;
			case "edit":
				$guidelineID = $this->encrypt->decode($this->uri->segment(5));
				
				$data['guideline'] = $this->guideline->load($guidelineID);
				if(!empty($data['guideline'])){
					$this->load->view('admin/new_guideline', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			case "view":
				$guidelineID = $this->encrypt->decode($this->uri->segment(5));
				
				$data['guideline'] = $this->guideline->load($guidelineID);
				if(!empty($data['guideline'])){
					$this->load->view('admin/view_guideline', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			default: $this->load->view('admin/error404', $data);
		}
		#---------------------------------------------------
		return;
	}
	
	
	#==============================================================
	# Gallery action start
	public function gallery(){
		
		$action = $this->uri->segment(4);
		#==================================================
		$data['env'] =  $this->environment->load('admin');
		$data['action'] =  $action;
		#---------------------------------------------------
		switch($action){
			case "new":
				$this->load->view('admin/new_gallery',$data);
			break;
			case "edit":
				$id = $this->encrypt->decode($this->uri->segment(5));
				
				$data['gallery'] = $this->gallery->get($id);
				if(!empty($data['gallery'])){
					$this->load->view('admin/new_gallery', $data);
				}else{
					$this->load->view('admin/error404', $data);
				}
			break;
			default: $this->load->view('admin/error404', $data);
		}
		#---------------------------------------------------
		return;
	}
	
	
	
	#======================================================
	# Assessment Start
	
	public function assessment(){
		$data['env'] =  $this->environment->load('admin');
		$data['companies'] = $this->company->getAll();
		$this->load->view('admin/pre_assessment', $data);
		
	}
	
	public function assessmentDetail(){
		$data['env'] =  $this->environment->load('admin');
		$courseID = $this->input->post("courseID");
		$companyID = $this->input->post("companyID");
		$assessmentInfo = array(
			'courseID' => $courseID,
			'companyID' => $companyID
		);
		$assessment = $this->assessment->get($assessmentInfo);
		
		$course = $this->course->getInfo($courseID);

		$data['course'] = $course;
		$data['assessmentInfo'] = (object)$assessmentInfo;
		$data['assessment'] = $assessment;
		
		$assessmentID = isset($assessment->assessmentID) ? $assessment->assessmentID : null;
		$data['questionSets'] = $this->assessment->getQuestionSets($assessmentID);
		
		if(!empty($courseID) && !empty($companyID)){
			$this->load->view('admin/assessment_detail', $data);
		}else{
			redirect(base_url('admin/assessment'));
		}
	}
	
	
	public function configurations(){
		$action = $this->uri->segment(3);
		$data['env'] =  $this->environment->load('admin');
		
		switch($action){
			case "gallery":
				$data['galleries'] = $this->gallery->load(array("start"=>0));
				$this->load->view("admin/gallery", $data);
			break;
			case "faq":
				$data['faqs'] = $this->faq->load(array("start"=>0));
				$this->load->view("admin/faq", $data);
			break;
				
			case "accreditation":
				$data['accreditations'] = $this->accreditation->load(array("start"=>0));
				$this->load->view("admin/accreditation", $data);
			break;
			
			case "mocktest":
				$this->load->view("admin/mocktest", $data);
			break;
			case "guidelines":
				$data['guidelines'] = $this->guideline->getAll();
				$this->load->view("admin/guidelines", $data);
			break;
			default:
		}
		if(empty($action)){
			$this->load->view('admin/configuration', $data);
		}
	}
	
	
	public function reports(){
		$data['env'] =  $this->environment->load('admin');
		$data['companies'] = $this->company->getAll();
		$this->load->view('admin/reports', $data);
	}
}