<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Employee
#====================================================

class Employee extends CI_Model{
	#=========================================================================
	# Employee related actions 
	
	var $table = "( 
      SELECT 	emp.employeeID,
				emp.name,
				emp.email,
				emp.mobile,
				emp.employeeCode,
				emp.managerName,
				emp.designation,
				emp.address,
				emp.panCard,
				emp.aadharCard,
				emp.role,
				comp.name as companyName,
				dep.name as departmentName
      FROM employee emp
	  LEFT JOIN company comp USING(companyID)
      LEFT JOIN department dep USING(departmentID)    
      WHERE emp.role = 'user'
    ) tempTable";
	
    var $column_order = array(null,'employeeID', 'name','email','mobile','employeeCode','managerName','departmentName','companyName','designation','address','panCard','aadharCard'); 
    var $column_search = array('name','email','mobile','employeeCode','departmentName','companyName','panCard','aadharCard');
    var $order = array('employeeID' => 'desc');
	
	
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper('cookie');
		# load more modules
	}

	public function login($email, $password){
		$password = md5($password);
		$employee = $this->db->get_where('employee', array(
			'email' => $email,
			'password' => $password,
			'status'	=> 'active'
		))->result();
		
		if($employee){
			$this->_setFirstLogin($employee[0]->employeeID);
			$newdata = array(
				'username'  => $employee[0]->name,
				'email'     => $employee[0]->email,
				'employeeID' => $employee[0]->employeeID,
				'role'	=> $employee[0]->role,
				'logged_in' => true
			);
			$this->session->set_userdata($newdata);
		}else{
			$newdata = array(
				'logged_in' => false
			);
		}
		return  $newdata;
	}	
	
	private function _setFirstLogin($employeeID){
		$this->db->where("firstLogin", null);
		$this->db->where("employeeID", $employeeID);
		
		return $this->db->update("employee", array("firstLogin" => getCurrentTimeStamp()));
	}
	
	public function checkLoggedIn(){
		return $this->session->userdata();
	}
	
	public function getByEmail($emailID){
		return $this->db->get_where("employee", array("email" => $emailID))->result()[0];
	}
	
	public function logout(){
		$this->session->unset_userdata(array("username", 'email', 'employeeID', 'role', 'logged_in'));
		return true;
	}
	
	#======================================================================================
	#populating tables data for list of emp
	private function _get_datatables_query(){
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                 
                if($i===0){
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_employees(){
        $this->_get_datatables_query();
		
		#get the post values and apply in this.
		
        if($_POST['length'] != -1)
		$this->db->where('role !=','admin');
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	public function add($data){
		if(isset($data['password'])){
			$data['password'] = md5($data['password']);
		}
		$this->db->insert("employee", $data);
		$empID = $this->db->insert_id();
		return $this->createCourses($empID);
	}
	public function load($id){
		$emp = $this->db->get_where("employee", array("employeeID" => $id));
		return ($emp->num_rows() > 0) ? $emp->result()[0] : null;
	}
	
	public function getInfo($empID){
		$this->db->from($this->table);
		$this->db->where('employeeID',$empID);
		$emp = $this->db->get();
		return ($emp->num_rows() > 0) ? $emp->result()[0] : null;
	}
	
	public function update($employeeID, $inputs){
		if(isset($inputs['password'])){
			$inputs['password'] = md5($inputs['password']);
		}
		$this->db->where("employeeID", $employeeID);
		return $this->db->update("employee", $inputs);
	}
	
	public function delete($employeeID){
		# dependent stuff to delete
		$this->removeCourse(array('employeeID' => $employeeID));
		$this->db->where("employeeID", $employeeID);
		return $this->db->delete("employee");
	}
	
	public function deleteMulti($employeeIDs){
		$ids = explode(",",$employeeIDs);
		if(!empty($ids)){
			foreach($ids as $id){
				$this->delete($id);
			}
			return true;
		}
		return false;
	}
	
	public function email_exists($email){
		$result = $this->db->get_where('employee', array('email'=>$email));
		if ($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	# Employee related actions end
	#____________________________________
	
	public function getCourseData($employeeID){
		$this->db->select("course.*, department.name as departmentName")
				->from("course")
				->join("department","department.departmentID = course.departmentID")
				->join("companycourse", "companycourse.courseID = course.courseID")
				->join("employee", "employee.companyID = companycourse.companyID")
				->where("employee.departmentID = course.departmentID")
				->where("employee.employeeID", $employeeID);
				
		$courses = $this->db->get();
		return ($courses->num_rows() > 0) ? $courses->result() : null;
	}
	
	public function createCourses($employeeID){
		$courses = $this->getCourseData($employeeID);
		if($courses != null){
			foreach($courses as $course){
				$this->_assignCourse($employeeID, $course->courseID);
			}
		}
		
		return true;
	}
	
	public function getCourse($employeeID){
		$this->db->select("course.*, employeecourse.*, department.name as departmentName")
				->from("employeecourse")
				->join("course","employeecourse.courseID = course.courseID")
				->join("department","department.departmentID = course.departmentID")
				->join("companycourse", "companycourse.courseID = course.courseID")
				->join("employee", "employee.companyID = companycourse.companyID")
				->where("employee.departmentID = course.departmentID")
				->where("employeecourse.employeeID", $employeeID)
				->where("employee.employeeID", $employeeID);
				
		$courses = $this->db->get();
		return ($courses->num_rows() > 0) ? $courses->result() : null;
	}
	
	public function updateEmployeeCourses($courseID){
		$this->db->select("course.*,employee.*")
				->from("course")
				->join("companycourse", "companycourse.courseID = course.courseID")
				->join("employee", "employee.companyID = companycourse.companyID")
				->where("employee.departmentID = course.departmentID")
				->where("course.courseID",$courseID);
		$info = $this->db->get();
		if($info->num_rows() > 0){
			$row = $info->result()[0];
			$this->_assignCourse($row->employeeID, $row->courseID);
		}
		return true;
	}
	
	public function loadCourse($courseID){
		$this->db->where("employeeID", $this->session->employeeID);
		$this->db->where("courseID", $courseID);
		$course = $this->db->get('employeecourse');
		return ($course->num_rows() > 0) ? $course->result()[0] : null;
	}

	public function updateCourse($courseID, $inputs){
		$this->db->where("courseID", $courseID);
		$this->db->where("employeeID", $this->session->employeeID);
		return $this->db->update("employeecourse", $inputs);
	}
	
	public function removeCourse($data){
		if(isset($data['employeeID'])){
			$this->db->where("employeeID",$data['employeeID']);
		}
		if(isset($data['courseID'])){
			$this->db->where("courseID",$data['courseID']);
		}
			
		return $this->db->delete("employeecourse");
	}
	
	private function _assignCourse($employeeID, $courseID){
		return $this->db->insert("employeecourse",array('employeeID' => $employeeID, 'courseID'=> $courseID));
	}
	
	public function forgotPassword($email){
		$emp = $this->getByEmail($email);
		$token = $this->encrypt->encode($email);
		$data = array(
			'employeeID' => $emp->employeeID,
			'token' => $token
		);
		if($this->db->insert("forgotPassword", $data)){
			return $token;
		}else{
			return null;
		}
	}
	
	public function getTokenInfo($token){
		$info = $this->db->get_where("forgotPassword", array("token"=>$token));
		if($info->num_rows() > 0){
			return $info->result()[0];
		}else{
			return null;
		}
	}
	public function expireToken($empid){
		$this->db->where("employeeID", $empid);
		return $this->db->delete("forgotPassword");
	}
	
}
