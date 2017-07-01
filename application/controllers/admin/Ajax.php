<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->db->cache_delete_all();
		$this->load->model(array(
			'employee',
			'faq',
			'gallery',
			'course',
			'accreditation',
			'company',
			'department',
			'chepter',
			'slide',
			'assessment',
			'report',
			'guidline'
		));
		#loading other modules
		#--------------
		if(!$this->_isAdmin() || !$this->input->is_ajax_request()){
			exit('Unautherized Access!');
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
	
	#=================================================
	# Company Start populate
	public function populateReport(){
		$companyID = $this->input->post('companyID');
		$courseID = $this->input->post('courseID');
		$daterange = $this->input->post('dateRange');
		
		$ranges = explode(" - ", $daterange);
		#formatting the date ranges
		$from = date("Y-m-d H:i:s",strtotime($ranges[0]));
		$to = date("Y-m-d H:i:s",strtotime($ranges[1]));
		
        $report = $this->report->get_report($companyID, $courseID, $from, $to);
        $data = array();
        foreach ($report as $report_row) {
            $row = array();
            $row[] = '<td class="min-width nowrap"></td>';
            $row[] = $report_row->name;
            $row[] = $report_row->mobile;
            $row[] = $report_row->email;
            $row[] = $report_row->questionSet;
            $row[] = $report_row->totalQuestions;
            $row[] = $report_row->duration;
            $row[] = $report_row->passingMarks;
            $row[] = $report_row->maxScore;
            $row[] = $report_row->timeTaken;
            $row[] = $report_row->result;
            $row[] = date("M d Y h:i A",strtotime($report_row->timeStamp));
            array_push($data, $row);
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->report->count_all(),
			"recordsFiltered" => $this->report->count_filtered(),
			"data" => $data,
		);
        echo json_encode($output);
    }

	
	#=================================================
	# Company Start populate
	public function populateCompanies(){
        $list = $this->company->get_companies();
        $data = array();
        foreach ($list as $company) {
            $row = array();
            $row[] = '<td class="min-width nowrap"><input type="checkbox" value="'.$company->companyID.'"></td>';
            $row[] = "#".$company->companyID;
            $row[] = $company->name;
            $row[] = $company->contactName;
            $row[] = $company->contactMobile;
            $row[] = '<a href="mailto:'.$company->contactEmail.'">'.$company->contactEmail.'</a>';
			$row[] ='<p><span  class="btn btn-xs btn-secondary fa fa-edit" onclick="updateClick('.$company->companyID.');"></span> <a href="/admin/company/detail/'.$this->encrypt->encode($company->companyID).'"><span class="btn btn-xs fa fa-eye"></span></a></p>';
			
            array_push($data, $row);
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->company->count_all(),
			"recordsFiltered" => $this->company->count_filtered(),
			"data" => $data,
		);
        echo json_encode($output);
    }
	
	public function companyAction(){
		
		$action = $this->input->post("action");
		switch($action){
			case "add":
				#======================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Company Name", "trim|required");
				$this->form_validation->set_rules("contactName", "Contact Name", "trim|required");
				$this->form_validation->set_rules("contactMobile", "Contact Mobile", "trim|required|exact_length[10]|numeric");
				$this->form_validation->set_rules("contactEmail", "Contact Email", "trim|required|valid_email");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$inputs = array(
						'name' => $this->input->post("name"),
						'contactName' => $this->input->post("contactName"),
						'contactMobile' => $this->input->post("contactMobile"),
						'contactEmail' => $this->input->post("contactEmail")
					);
					
					if($this->company->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "New Company Added Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to save"
						));
					}
				}
				#======================================================================================
			break;
			case "get":
				#======================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("companyID", "Company ID", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$id = $this->input->post("companyID");
					$data = $this->company->load($id);
					if($data){
						echo json_encode( array(
							'status' => true,
							'data' => $data
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Load!"
						));
					}
				}
				#======================================================================================
			break;
			case "update":
				#=====================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Company Name", "trim|required");
				$this->form_validation->set_rules("contactName", "Contact Name", "trim|required");
				$this->form_validation->set_rules("contactMobile", "Contact Mobile", "trim|required|exact_length[10]|numeric");
				$this->form_validation->set_rules("contactEmail", "Contact Email", "trim|required|valid_email");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$companyID = $this->input->post("companyID");
					$inputs = array(
						'name' => $this->input->post("name"),
						'contactName' => $this->input->post("contactName"),
						'contactMobile' => $this->input->post("contactMobile"),
						'contactEmail' => $this->input->post("contactEmail")
					);
					
					if($this->company->update($companyID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Company Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update"
						));
					}
				}
				#======================================================================================
			break;
			case "delete": 
				$companyIDs = $this->input->post("companyIDs");
				
				if($this->company->deleteMulti($companyIDs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Company Deleted Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to delete"
						));
					}
			break;
			case "getUnlinkedCourses":
				#======================================================================================
				$companyID = $this->input->post("companyID");
				$data['courses'] = $this->company->getUnlinkCourses($companyID);
				
				if($data){
					echo json_encode( array(
						'status' => true,
						'data' => $data
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to fetch!"
					));
				}
				#=====================================================================================================
			break;
			
			case "link":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("companyID", "Company", "trim|required");
				$this->form_validation->set_rules("courseID", "Course", "trim|required");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$companyID = $this->input->post("companyID");
					$courseID = $this->input->post("courseID");
										
					if($this->course->linkCourse($companyID, $courseID)){
						echo json_encode( array(
							'status' => true,
							'message' => "Course Linked Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to link!"
						));
					}
				}
				#=====================================================================================================
			break;
			
			case "unlink":
				#===========================================================================================================
				$companyID = $this->input->post("companyID");
				$courseID = $this->input->post("courseID");
				
				if($this->course->unlinkCourse($companyID, $courseID)){
					echo json_encode( array(
						'status' => true,
						'message' => "Course Unlinked Successfully!"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to unlink!"
					));
				}
				#=====================================================================================================
			break;
			
			default:
		}
	}
	#======================
	#Department Start
	public function populateDepartments(){
        $list = $this->department->get_departments();
        $data = array();
        foreach ($list as $department) {
            $row = array();
            $row[] = '<td class="min-width nowrap"><input type="checkbox" value="'.$department->departmentID.'"></td>';
            $row[] = "#".$department->departmentID;
            $row[] = $department->name;
            $row[] = $department->description;
			$row[] ='<p><span  class="btn btn-xs btn-secondary fa fa-edit" onclick="updateClick('.$department->departmentID.');"></span></p>';
			
            array_push($data, $row);
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->department->count_all(),
			"recordsFiltered" => $this->department->count_filtered(),
			"data" => $data,
		);
        echo json_encode($output);
    }
	
	public function departmentAction(){
		
		$action = $this->input->post("action");
		switch($action){
			case "add":
				#=====================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Department Name", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$inputs = array(
						'name' => $this->input->post("name"),
						'description' => $this->input->post("description"),						
					);
					
					if($this->department->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "New Department Added Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to save"
						));
					}
				}
				#===========================================================================================================
			break;
			case "get":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("departmentID", "Department ID", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$id = $this->input->post("departmentID");
					$data = $this->department->load($id);
					if($data){
						echo json_encode( array(
							'status' => true,
							'data' => $data
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Load!"
						));
					}
				}
				#=====================================================================================================
			break;
			case "update":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Department Name", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$departmentID = $this->input->post("departmentID");
					$inputs = array(
						'name' => $this->input->post("name"),
						'description' => $this->input->post("description"),
					);
					
					if($this->department->update($departmentID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Department Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update"
						));
					}
				}
				#===========================================================================================================
			break;
			case "delete": 
				$departmentIDs = $this->input->post("departmentIDs");
				$deptIDs = explode(",", $departmentIDs);
				if($this->department->deleteMulti($deptIDs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Department Deleted Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to delete"
						));
					}
			break;
			default:
		}
	}
	
	
	
	#=================================================
	# Course Start Here
	public function courseAction(){
		
		$action = $this->input->post("action");
		switch($action){
			case "add":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Course Title", "trim|required");
				$this->form_validation->set_rules("departmentID", "Department", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required");
				$this->form_validation->set_rules("duration", "Duration In Hrs.", "trim|required|numeric|greater_than[14]");
				$this->form_validation->set_rules("maxDays", "Max Days", "trim|required|numeric");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$duration = decimalToTime($this->input->post("duration"));
					$inputs = array(
						'title' => $this->input->post("title"),
						'departmentID' => $this->input->post("departmentID"),
						'description' => $this->input->post("description"),
						'duration' => $duration,
						'maxDays' => $this->input->post("maxDays")
					);
					
					if($this->course->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "New Course Added Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to save"
						));
					}
				}
				#===========================================================================================================
			break;
			case "get":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("courseID", "Course ID", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$id = $this->input->post("courseID");
					$data['courseInfo'] = $this->course->get($id);
					if(!empty($data['courseInfo'])){
						$data['courseInfo']->duration = timeToDecimal($data['courseInfo']->duration);
					}
					$data['departments'] = $this->department->getAll();
					if($data){
						echo json_encode( array(
							'status' => true,
							'data' => $data
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Load!"
						));
					}
				}
				#======================================================================================
			break;
			case "update":
				#======================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Course Title", "trim|required");
				$this->form_validation->set_rules("departmentID", "Department", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required");
				$this->form_validation->set_rules("duration", "Duration In Hrs.", "trim|required|numeric|greater_than[14]");
				$this->form_validation->set_rules("maxDays", "Max Days", "trim|required|numeric|greater_than[29]");
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$duration = decimalToTime($this->input->post("duration"));
					$courseID = $this->input->post("courseID");
					$inputs = array(
						'title' => $this->input->post("title"),
						'departmentID' => $this->input->post("departmentID"),
						'description' => $this->input->post("description"),
						'duration' => $duration,
						'maxDays' => $this->input->post("maxDays")
					);
					
					if($this->course->update($courseID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Course Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update!"
						));
					}
				}
				
			#=======================================================================================
			break;
			case "delete": 
				$courseID = $this->input->post("courseID");
				
				if($this->course->delete($courseID)){
						echo json_encode( array(
							'status' => true,
							'message' => "Course Deleted Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to delete"
						));
					}
			break;
			
			default:
		}
	}
	
	#=====================================================
	#Slide Actiion Start
	public function slideAction(){
		$action = $this->input->post("action");
		switch($action){
			case "new":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Slide Title", "trim|required");
				$this->form_validation->set_rules("sequence", "Slide Sequence", "trim|required|numeric");
				$this->form_validation->set_rules("content", "Slide Content", "trim|required");
				$this->form_validation->set_rules("chepterID", "Chepter", "trim|required|numeric");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					
					$inputs = array(
						'title' => $this->input->post("title"),
						'sequence' => $this->input->post("sequence"),
						'content' => $_POST["content"],
						'chepterID' => $this->input->post("chepterID")
					);
					
					if($this->slide->save($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Slide Saved Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to save side!"
						));
					}
				}
			break;
			case "edit":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Slide Title", "trim|required");
				$this->form_validation->set_rules("sequence", "Slide Sequence", "trim|required|numeric");
				$this->form_validation->set_rules("content", "Slide Content", "required");
				$this->form_validation->set_rules("chepterID", "Chepter", "trim|required|numeric");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$slideID =  $this->input->post("slideID");
					$inputs = array(
						'title' => $this->input->post("title"),
						'sequence' => $this->input->post("sequence"),
						'content' => $_POST["content"],
						'chepterID' => $this->input->post("chepterID")
					);
					if($this->slide->update($slideID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Slide Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update side!"
						));
					}
				}
			break;
			
			default:
		}
	}
	
	
	#=====================================================
	#Guidline Action Start
	public function guidlineAction(){
		$action = $this->input->post("action");
		switch($action){
			case "new":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Guidline Title", "trim|required");
				$this->form_validation->set_rules("content", "Slide Content", "trim|required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					
					$inputs = array(
						'title' => $this->input->post("title"),
						'content' => $_POST["content"],
					);
					
					if($this->guidline->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Guidline Saved Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to save guidline!"
						));
					}
				}
			break;
			case "edit":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Guidline Title", "trim|required");
				$this->form_validation->set_rules("content", "Guidline Content", "required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$guidlineID =  $this->input->post("guidlineID");
					$inputs = array(
						'title' => $this->input->post("title"),
						'content' => $_POST["content"]
					);
					if($this->guidline->update($guidlineID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Guidline Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update guidline!"
						));
					}
				}
			break;
			case "delete":
				$guidlineID =  $this->input->post("guidlineID");
				if($this->guidline->delete($guidlineID)){
						echo json_encode( array(
							'status' => true,
							'message' => "Guidline Deleted Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to delete!"
						));
					}
			break;
			default:
		}
	}
	
	
	#=================================================
	# Employee Start Here
	
	public function populateEmployees(){
        $list = $this->employee->get_employees();
        $data = array();
        foreach ($list as $employee) {
            $row = array();
            $row[] = '<td class="min-width nowrap"><input type="checkbox" value="'.$employee->employeeID.'"></td>';
            $row[] = "#".$employee->employeeID;
            $row[] = $employee->name;
            $row[] = '<a href="mailto:'.$employee->email.'">'.$employee->email.'</a>';
            $row[] = $employee->mobile;
            $row[] = $employee->employeeCode;
            $row[] = $employee->managerName;
            $row[] = $employee->departmentName;
            $row[] = $employee->companyName;
            $row[] = $employee->designation;
            $row[] = $employee->address;
            $row[] = $employee->panCard;
            $row[] = $employee->aadharCard;
			$row[] ='<td class="nowrap"><p>
					<span class="btn-xs btn fa fa-edit" onclick="updateClick('.$employee->employeeID.');"></span> 
					<a  class="btn-secondary btn-xs fa fa-eye" href="/admin/employee/'.$this->encrypt->encode($employee->employeeID).'"></a>
					</p></td>';
			
            array_push($data, $row);
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->employee->count_all(),
			"recordsFiltered" => $this->employee->count_filtered(),
			"data" => $data,
		);
        echo json_encode($output);
    }
	
	public function employee_email_exists($key) {
		if($this->employee->email_exists($key)){
			$this->form_validation->set_message('employee_email_exists', 'This email address is already exist.' );
			return false;
		}else{
			return true;
		}
	}
	public function employeeAction(){
		
		$action = $this->input->post("action");
		switch($action){
			case "add":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Name", "trim|required");
				$this->form_validation->set_rules("mobile", "Mobile", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|max_length[16]|matches[confirm_password]");
				$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required");
				$this->form_validation->set_rules("email", "Email ID", "trim|required|valid_email|callback_employee_email_exists");
				$this->form_validation->set_rules("mobile", "Mobile", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("employeeCode", "Employee Code", "trim|required");
				$this->form_validation->set_rules("managerName", "Manager Name", "trim|required");
				$this->form_validation->set_rules("designation", "Designation", "trim|required");
				$this->form_validation->set_rules("address", "Address", "trim|required");
				$this->form_validation->set_rules("panCard", "PAN Card", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("aadharCard", "Aadhar Card", "trim|required|exact_length[12]");
				$this->form_validation->set_rules("companyID", "Company", "trim|required");
				$this->form_validation->set_rules("departmentID", "Department", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$employeeID = $this->input->post("employeeID");
					$inputs = array(
						'name' => $this->input->post("name"),
						'mobile' => $this->input->post("mobile"),
						'email' => $this->input->post("email"),
						'employeeCode' => $this->input->post("employeeCode"),
						'managerName' => $this->input->post("managerName"),
						'designation' => $this->input->post("designation"),
						'address' => $this->input->post("address"),
						'panCard' => $this->input->post("panCard"),
						'aadharCard' => $this->input->post("aadharCard"),
						'companyID' => $this->input->post("companyID"),
						'departmentID' => $this->input->post("departmentID"),
						'password' => $this->input->post("password"),
						'representative' => ($this->input->post("representative") == 'on') ? 1 : 0,
					);
					
					if($this->employee->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Employee Added Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to add"
						));
					}
				}
				#===========================================================================================================
			break;
			case "get":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("employeeID", "Employee ID", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$id = $this->input->post("employeeID");
					$data['empInfo'] = $this->employee->load($id);
					$data['companies'] = $this->company->getAll();
					$data['departments'] = $this->department->getAll();
					unset($data['empInfo']->password);
					if($data){
						echo json_encode( array(
							'status' => true,
							'data' => $data
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Load!"
						));
					}
				}
				#=====================================================================================================
			break;
			case "get_dept_comp":
				#===========================================================================================================
				$data['companies'] = $this->company->getAll();
				$data['departments'] = $this->department->getAll();
				
				if($data){
					echo json_encode( array(
						'status' => true,
						'data' => $data
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to fetch!"
					));
				}
				#=====================================================================================================
			break;
			case "update":
				#===========================================================================================================
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("name", "Name", "trim|required");
				$this->form_validation->set_rules("mobile", "Mobile", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("employeeCode", "Employee Code", "trim|required");
				$this->form_validation->set_rules("managerName", "Manager Name", "trim|required");
				$this->form_validation->set_rules("designation", "Designation", "trim|required");
				$this->form_validation->set_rules("address", "Address", "trim|required");
				$this->form_validation->set_rules("panCard", "PAN Card", "trim|required|exact_length[10]");
				$this->form_validation->set_rules("aadharCard", "Aadhar Card", "trim|required|exact_length[12]");
				$this->form_validation->set_rules("companyID", "Company", "trim|required");
				$this->form_validation->set_rules("departmentID", "Department", "trim|required");
				
				if($this->form_validation->run() == FALSE){
					
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$employeeID = $this->input->post("employeeID");
					$inputs = array(
						'name' => $this->input->post("name"),
						'mobile' => $this->input->post("mobile"),
						'employeeCode' => $this->input->post("employeeCode"),
						'managerName' => $this->input->post("managerName"),
						'designation' => $this->input->post("designation"),
						'address' => $this->input->post("address"),
						'panCard' => $this->input->post("panCard"),
						'aadharCard' => $this->input->post("aadharCard"),
						'companyID' => $this->input->post("companyID"),
						'departmentID' => $this->input->post("departmentID"),
						'representative' => ($this->input->post("representative") == 'on') ? 1 : 0,
					);
					
					if($this->employee->update($employeeID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Employee Updated Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to update"
						));
					}
				}
				#=======================
			break;
			case "delete": 
				$employeeIDs = $this->input->post("employeeIDs");
				
				if($this->employee->deleteMulti($employeeIDs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Employee Deleted Successfully!"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to delete"
						));
					}
			break;
			default:
		}
	}
	
	#====================================================================================
	# Chepter Action Start
	public function chepterAction(){
		$action = $this->input->post("action");
		switch($action){
			case "add":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Title", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required|max_length[100]");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$inputs = array(
						"courseID" => $this->input->post("courseID"),
						"title" => $this->input->post("title"),
						"description" => $this->input->post("description"),
						
					);					
					if($this->chepter->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Chepter Successfully Added."
						));
						return;
					}else{
						echo json_encode( array(
							'status' => true,
							'message' => "Unable to add chepter"
						));
						return;
					}
				}
			break;
			case "get":
				$chepterID = $this->input->post("chepterID");
				$chepter = $this->chepter->get($chepterID);
				echo json_encode( array(
					'status' => true,
					'chepter' => $chepter
				));
				return;
				
			break;
			
			case "update":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Title", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required|max_length[100]");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$chepterID = $this->input->post("chepterID");
					$inputs = array(
						"title" => $this->input->post("title"),
						"description" => $this->input->post("description"),
						
					);					
					if($this->chepter->update($chepterID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Chepter Successfully Added."
						));
						return;
					}else{
						echo json_encode( array(
							'status' => true,
							'message' => "Unable to update chepter"
						));
						return;
					}
				}
			break;
			case "delete":
				$chepterID = $this->input->post("chepterID");
				if($this->chepter->delete($chepterID)){
					echo json_encode( array(
						'status' => true,
						'message' => "Chepter deleted Successfully"
					));
				}
				return;	
			break;
			case "deleteSlide":
				$slideID = $this->input->post("slideID");
				if($this->slide->delete($slideID)){
					echo json_encode( array(
						'status' => true,
						'message' => "Slide deleted Successfully"
					));
				}
				return;	
			break;
			
			case "loadQuestion":
				$chepterquestionID = $this->input->post("chepterquestionID");
				$chepterQuestion = $this->chepter->loadQuestion($chepterquestionID);
				if(!empty($chepterQuestion)){
					echo json_encode( array(
						'status' => true,
						'question' => $chepterQuestion[0], 
						'message' => "Question loaded successfully"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to load"
					));
				}
				return;
			break;
			
			case "updateQuestion":
			
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("question", "Question Text", "trim|required");
				$this->form_validation->set_rules("option_1", "Option 1", "trim|required");
				$this->form_validation->set_rules("option_2", "Option 2", "trim|required");
				$this->form_validation->set_rules("answer", "Answer", "trim|required");
				$this->form_validation->set_rules("explanation", "Explanation", "trim|required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$chepterquestionID = $this->input->post("chepterquestionID");
					$inputs = array(
						'question' => $this->input->post("question"),
						'option_1' => $this->input->post("option_1"),
						'option_2' => $this->input->post("option_2"),
						'option_3' => $this->input->post("option_3"),
						'option_4' => $this->input->post("option_4"),
						'answer' => $this->input->post("answer"),
						'explanation' => $this->input->post("explanation"),
					);
					if($this->chepter->updateQuestion($chepterquestionID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Question Update Successfully"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Update"
						));
					}
					return;
				}
			break;
			case "deleteQuestion":
				$chepterquestionID = $this->input->post("chepterquestionID");
				if($this->chepter->deleteQuestion($chepterquestionID)){
					echo json_encode( array(
						'status' => true,
						'message' => "Question deleted Successfully"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to delete"
					));
				}
			break;
			
			default:
		}
	}
	
	public function assessmentAction(){
		$action = $this->input->post('action');
		
		switch($action){
			case "loadCourses":
				$companyID = $this->input->post('companyID');
				$courses = $this->company->getCourses($companyID);
				print json_encode($courses);
				return;
			break;
			
			case "add":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("companyID", "Hidden Values", "trim|required");
				$this->form_validation->set_rules("courseID", "Hidden Values", "trim|required");
				$this->form_validation->set_rules("code", "Code", "trim|required");
				$this->form_validation->set_rules("title", "Title", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required|max_length[150]");
				$this->form_validation->set_rules("totalQuestions", "Total Question", "trim|required");
				$this->form_validation->set_rules("duration", "Duration", "trim|required");
				$this->form_validation->set_rules("passingMarks", "Passing Marks", "trim|required");
				$this->form_validation->set_rules("questionSets", "Question Sets", "trim|required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$inputs = array(
						'companyID' => $this->input->post('companyID'),
						'courseID' => $this->input->post('courseID'),
						'code' => $this->input->post('code'),
						'title' => $this->input->post('title'),
						'description' => $this->input->post('description'),
						'totalQuestions' => $this->input->post('totalQuestions'),
						'duration' => $this->input->post('duration'),
						'passingMarks' => $this->input->post('passingMarks'),
						'questionSets' => $this->input->post('questionSets'),
					);
					if($this->assessment->add($inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Assessment Added Successfully"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Add"
						));
					}
					return;	
				}
				
			break;
			case "updateAssessment":
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("title", "Title", "trim|required");
				$this->form_validation->set_rules("description", "Description", "trim|required|max_length[150]");
				$this->form_validation->set_rules("totalQuestions", "Total Question", "trim|required");
				$this->form_validation->set_rules("duration", "Duration", "trim|required");
				$this->form_validation->set_rules("passingMarks", "Passing Marks", "trim|required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$assessmentID = $this->input->post('assessmentID');
					$inputs = array(
						'title' => $this->input->post('title'),
						'description' => $this->input->post('description'),
						'totalQuestions' => $this->input->post('totalQuestions'),
						'duration' => $this->input->post('duration'),
						'passingMarks' => $this->input->post('passingMarks'),
					);
					if($this->assessment->update($assessmentID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Assessment Added Successfully"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Add"
						));
					}
					return;
				}
				
			break;
			
			case "loadAssessment":
				$assessmentID = $this->input->post("assessmentID");
				$assessment = $this->assessment->load($assessmentID);
				if(!empty($assessment)){
					echo json_encode( array(
						'status' => true,
						'assessment'=> $assessment,
						'message' => "Assessment loaded Successfully"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to load"
					));
				}
				return;
				
			break;
			
			case "delete":
				$assessmentID = $this->input->post("assessmentID");
				if($this->assessment->delete($assessmentID)){
					echo json_encode( array(
						'status' => true,
						'message' => "Assessment Deleted Successfully"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to Delete"
					));
				}
				return;
				
			break;
			
			case "loadQuestion":
				$assessmentQuestionID = $this->input->post("assessmentQuestionID");
				$question = $this->assessment->loadQuestion($assessmentQuestionID);
				if(!empty($question)){
					echo json_encode( array(
						'status' => true,
						'question' => $question, 
						'message' => "Question loaded successfully"
					));
				}else{
					echo json_encode( array(
						'status' => false,
						'message' => "Unable to load"
					));
				}
				return;
			break;
			
			case "updateQuestion":
			
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules("question", "Question Text", "trim|required");
				$this->form_validation->set_rules("option_1", "Option 1", "trim|required");
				$this->form_validation->set_rules("option_2", "Option 2", "trim|required");
				$this->form_validation->set_rules("answer", "Answer", "trim|required");
				if($this->form_validation->run() == FALSE){
					echo json_encode( array(
						'status' => false,
						'message' => "<p class='text-danger'>".implode('!</br>',explode('.', validation_errors()))."</p>"
					));
					return;
				}else{
					$assessmentQuestionID = $this->input->post("assessmentQuestionID");
					$inputs = array(
						'question' => $this->input->post("question"),
						'option_1' => $this->input->post("option_1"),
						'option_2' => $this->input->post("option_2"),
						'option_3' => $this->input->post("option_3"),
						'option_4' => $this->input->post("option_4"),
						'answer' => $this->input->post("answer"),
					);
					if($this->assessment->updateQuestion($assessmentQuestionID, $inputs)){
						echo json_encode( array(
							'status' => true,
							'message' => "Question Update Successfully"
						));
					}else{
						echo json_encode( array(
							'status' => false,
							'message' => "Unable to Update"
						));
					}
					return;
				}
			break;
			default:
		}
		
	}
	
}