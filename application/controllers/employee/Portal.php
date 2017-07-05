<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->db->cache_delete_all();
		$this->load->model(array('employee','faq', 'guideline', 'course','accreditation','chepter','assessment','slide','glossary'));
		#loading other modules
		#--------------
		if(!$this->_isEmployee()){
			redirect(base_url("login"));
		}
	}
	
	private function _isEmployee(){
		$empInfo = $this->employee->checkLoggedIn();
		if(isset($empInfo['role'])){
			return  ($empInfo['role'] === 'user') ? true : false;
		}else{
			return false;
		}
	}
	
	#default function
	public function index(){		
		$env = $this->environment->load('employee');
		$courses = $this->employee->getCourse($env['loggedInEmployee']->employeeID);
		$empCourses = array();
		foreach($courses as $course){
			$course->isAvailable = $this->employee->isCourseAvailable($course->courseID);
			array_push($empCourses, $course);
		}
		$data = array(
			'env' => $env,
			'employee' => $this->employee->load($env['loggedInEmployee']->employeeID),
			'courses' => $empCourses,
		);	
		$this->viewPage('employee/course', $data);
	}
	
	#Function to fetch guidlines
	public function guidelines(){
		$guidelines = $this->guideline->getAll();
		$data = array(
			"env" => $this->environment->load('employee'),
			'guidelines' => $guidelines,
		);
		$this->viewPage('employee/guidelines', $data);
	}
	
	#Function to fetch guidlines
	public function glossary(){
		$glossary = $this->glossary->getAll();
		$data = array(
			"env" => $this->environment->load('employee'),
			'glossary' => $glossary,
		);
		$this->viewPage('employee/glossary', $data);
	}
	
	#Function to fetch guidlines
	public function account(){
		$env = $this->environment->load('employee');
		$employee = $this->employee->load($env['loggedInEmployee']->employeeID);
		if(!empty($employee)) {
			unset($employee->password);
		}
		$data = array(
			"env" => $env,
			'employee' => $employee,
		);
		$this->viewPage('employee/myaccount', $data);
	}
	
	#function for frequently asked question
	public function faq(){
		
		$pageNum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$limit = 5;
		$offset = ($pageNum - 1) * $limit;
		
		$params = array(
			'start' => $offset,
			'limit' => $limit
		);
		$data['env'] =  $this->environment->load('employee');
		$faqs = $this->faq->load($params);
		
		if(!empty($faqs)){
			$data['qadata'] = $faqs;
			$data['pagination'] = (object)array(
				'total' => $this->faq->total(),
				'pageNum' => $pageNum,
				'limit'	=> $limit
			);
			
			$this->viewPage('employee/faq',$data);
		}else{
			$this->viewPage('employee/error404', $data);
		}
		
	}
	
	public function courseDetail(){
		$courseID = $this->encrypt->decode($this->uri->segment(3));
		$env = $this->environment->load('employee');
		$course = $this->employee->getCourse($env['loggedInEmployee']->employeeID,$courseID);
		$chepters = $this->course->getChepters($courseID);
		
		$data['env'] =  $env;
		$data['courseInfo'] =  $course;
		$data['chepters'] =  $chepters;
		
		if(!empty($course) && $this->employee->isCourseAvailable($courseID)){
			$course->remainingDays = $course->maxDays - daysFromToday($course->timeStamp);
			$this->viewPage('employee/course_detail', $data);
		}else{
			$this->viewPage('employee/error404', $data);
		}
	}
	
	public function chepterDetail(){
		$courseID = $this->encrypt->decode($this->uri->segment(3));
		$chepterID = $this->encrypt->decode($this->uri->segment(4));
		
		$data['env'] = $this->environment->load('employee');
		$data['chepterInfo'] = $this->chepter->load($courseID, $chepterID);
		if(!empty($data['chepterInfo']) && $this->employee->isCourseAvailable($courseID)){
			$data['slides'] = $this->chepter->getSlides($chepterID);
			$data['questions'] = $this->chepter->getQuestions($chepterID);
			if(!empty($data['slides'])){
				$this->startCourse($courseID);
			}
			
			$this->viewPage('employee/read_chepter', $data);
		}else{
			$this->viewPage('employee/error404', $data);
		}
		
	}
	
	private function startCourse(){
		$courseID = $this->encrypt->decode($this->input->get("courseID"));
		$this->session->set_userdata(array(
			"studyStartID" => $courseID,
			"startedAt"	=> getCurrentTimeStamp(),
		));
	}
	
	public function stopCourse(){
		if(!$this->input->is_ajax_request()){
			echo "Access Denied!";
			return;
		}
		$courseID = $this->encrypt->decode($this->input->get("courseID"));
		$empID = $this->session->userdata('employeeID');
		$startTime = $this->session->userdata('startedAt');
		
		$mainCourse = $this->course->get($courseID);
		$empCourse = $this->employee->loadCourse($courseID);
		
		$dataToUpdate = array();
		
		$secs = strtotime(getCurrentTimeStamp())-strtotime($startTime);
	
		$timeSpent = date("H:i:s",strtotime($empCourse->timeSpent)+$secs);
		if(timeToDecimal($timeSpent) >= 15){
			$dataToUpdate['eligiblity'] = 'yes';
		}
		$dataToUpdate['status'] = 'started';
		$dataToUpdate['timeSpent'] = $timeSpent;
		
		$this->employee->updateCourse($courseID,$dataToUpdate);
		$this->session->unset_userdata('startedAt','studyStartID');
		
		return true;
	}
	
	public function employeeAction(){
		$data['env'] = $this->environment->load('employee');
		if($this->input->is_ajax_request()){
			$action = $this->input->post("action");
			
			switch($action){
				case "updatePassword":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("password", "Old Password", "trim|required");
				$this->form_validation->set_rules("new_password", "New Password", "trim|required|min_length[8]");
				$this->form_validation->set_rules("re_password", "Repeat Password", "trim|required|matches[new_password]");					
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$password = $this->input->post("password");
					$empID = $this->session->userdata('employeeID');
					
					if($this->employee->isValidPassword($empID,$password)){
						$password = $this->input->post("new_password");
						if($this->employee->changePassword($empID,$password)){
							echo json_encode( array(
								'status' => true,
								'message' => "Your password has been successfully changed!"
							));
						}else{
							echo json_encode( array(
								'status' => false,
								'message' => "Unable to change password"
							));
						}
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Incorrect Old Password"
						));
					}
				}
				break;
				
				case "updateProfile":
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Name", "trim|required");
				$this->form_validation->set_rules("mobile", "Mobile", "trim|required|exact_length[10]|numeric");
				$this->form_validation->set_rules("address", "Address", "trim|required");
				$this->form_validation->set_rules("panCard", "PAN Card", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("aadharCard", "Aadhaar Card", "trim|required|exact_length[12]");
				
				if($this->form_validation->run() == FALSE){
				
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$empID = $this->session->userdata('employeeID');
					
					$data = array(
						"name" => $this->input->post("name"),
						"mobile" => $this->input->post("mobile"),
						"address" => $this->input->post("address"),
						"panCard" => $this->input->post("panCard"),
						"aadharCard" => $this->input->post("aadharCard"),
					);
					if($this->employee->update($empID, $data)){
						echo json_encode( array(
							'status' => true,
							'message' => "Successfully Updated"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update"
						));
					}
				}
			
				break;
				
				default:
			}
		}else{
			$this->viewPage('employee/error404', $data);
		}
	}
	
	
	
	#=================================================================
	# Assessment Operation Start
	public function assessment(){
		$employeeID = $this->session->employeeID;
		$courseID = $this->encrypt->decode($this->uri->segment(3));
		$data['env'] = $this->environment->load('employee');
		$data['employeeInfo'] = $this->employee->getInfo($employeeID);
		$assessment = $this->assessment->get(array(
			'courseID' => $courseID,
		));
		if(!empty($assessment)){
			
			$data['assessment'] = $assessment;
			$data['attempts'] = $this->assessment->getAttempts(array(
				'assessmentID' => $assessment->assessmentID,
				'employeeID' => $employeeID
			));
		
			$this->viewPage('employee/assessment_detail', $data);
		}else{
			$this->viewPage('employee/error404', $data);
		}
		
	}
	
	public function assessmentStart(){
		$this->session->unset_userdata('startedAt','assessmentID');
		$employeeID = $this->session->employeeID;
		$assessmentID = $this->encrypt->decode($this->uri->segment(4));
		
		$data['env'] = $this->environment->load('employee');
		$data['employeeInfo'] = $this->employee->getInfo($employeeID);
		
		$assessment = $this->assessment->get(array('assessmentID' => $assessmentID));
		if(!empty($assessment)){
			$questionSet = rand(1,$assessment->questionSets);
			$questions = $this->assessment->getQuestionSet($assessmentID, $questionSet);
			
			
			$data['assessment'] = $assessment;
			$data['questions'] = $questions;
			
			if(!empty($data['questions'])){
				$this->session->set_userdata(array(
					"assessmentID" => $assessmentID,
					"startedAt"	=> getCurrentTimeStamp(),
				));
				
				$this->viewPage('employee/assessment_start', $data);
			}else{
				$this->viewPage('employee/error404', $data);
			}	
		}else{
			$this->viewPage('employee/error404', $data);
		}
	}
	
	public function submitAssessment(){
		$assessmentID = $this->encrypt->decode($this->input->post_get("assessmentID"));
		$assessment = $this->assessment->load($assessmentID);
		$courseID = $this->input->post_get("courseID");
		
		$questionSet = $this->input->post_get("questionSet");
		
		$questions = $this->assessment->getQuestionSet($assessmentID, $questionSet);
		
		$employeeID = $this->session->userdata('employeeID');
		
		$startedAt = $this->session->userdata('startedAt');
		
		
		$secondsTaken = strtotime(getCurrentTimeStamp()) - strtotime($startedAt);
		
		$min = intval($secondsTaken / 60);
		$minuteTaken = $min . ':' . str_pad(($secondsTaken % 60), 2, '0', STR_PAD_LEFT);
		
		$attemptData['employeeID'] = $employeeID;
		$attemptData['assessmentID'] = $assessmentID;
		$attemptData['questionSet'] = $questionSet;
		$attemptData['minuteTaken'] = $minuteTaken;		
		$attemptData['timeStamp'] = convertToMySqlTimeStamp($startedAt);		
		
		$marksObtained = 0;
		$totalQuestions = count($questions);
		$maxMarks = 0;
		
		foreach($questions as $question){
			$ans = $this->input->post("answer_".$question->assessmentQuestionID);
			if($question->answer === $ans){
				$marksObtained += $question->weight;
			}
			
			$maxMarks += $question->weight; 
		}
		
		$result = 'fail';
		
		if($marksObtained >= $assessment->passingMarks){
			$result = "pass";
		}
		
		$attemptData['markObtained'] = $marksObtained;
		$attemptData['result'] = $result;
		
		$this->assessment->addAttempt($attemptData);
		
		if($this->input->is_ajax_request()){
			$this->session->unset_userdata('startedAt','assessmentID');
			$this->session->set_userdata(array(
				"assessmentID" => $assessmentID,
				"startedAt"	=> getCurrentTimeStamp(),
			));
			return true;
		}else{
			$this->session->unset_userdata('startedAt','assessmentID');
			redirect(base_url("/employee/assessment/").$courseID);
		}
	}
	
	#template parser for multi-type requests.
	private function viewPage($template, $data){
		if($this->input->is_ajax_request()){
			$this->load->view($template, $data);
		}else{
			$this->load->view("employee/includes/header",$data);
			$this->load->view($template, $data);
			$this->load->view("employee/includes/footer");
		}
		
	}
	
	
	
}