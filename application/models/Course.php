<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Course
#====================================================

class Course extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		# load more modules
	}

	public function get($courseID){
		$courses = $this->db->get_where("course", array("courseID" => $courseID));
		return ($courses->num_rows() > 0) 
				? $courses->result()[0] : null;
	}
	
	public function getInfo($id){
		$this->db->select('course.*, department.name as departmentName')
        ->from('course')
		->join("department", "course.departmentID = department.departmentID", "left")
        ->where('courseID',$id);
		$rs = $this->db->get();
		if($rs->num_rows() > 0){
			return $rs->result()[0];
		}
		return null;
	}
	
	public function getChepters($id){
		$this->db->select("*")
		->from("chepter")
		->where("courseID", $id);
		$chepters = $this->db->get();
		return ($chepters->num_rows() > 0) ? $chepters->result() : null;
	}
	
	public function load($params){
		$this->db->select('course.*, department.name as departmentName')
        ->from('course')
		->join("department", "course.departmentID = department.departmentID", "left")
        ->order_by('timeStamp','desc');
		
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $courses = $this->db->get();
        return ($courses->num_rows() > 0) ? $courses->result(): null;
	}
	
	public function total(){
		return $this->db->get('course')->num_rows();
	}
	
	public function delete($courseID){
		
		$chepters = $this->getChepters($courseID);
		if($chepters != null){
			foreach($chepters as $chepter){
				$this->chepter->delete($chepter->chepterID);
			}
		}
		$this->unlinkCourse(null, $courseID);
		
		$this->db->where("courseID", $courseID);
		return $this->db->delete("course");
	}
	
	public function add($course){
		$this->db->insert("course", $course);
		return $this->db->insert_id();
	}
	
	public function update($courseID, $data){
		$this->db->where("courseID", $courseID);
		return $this->db->update("course", $data);
	}
	
	public function linkCourse($companyID, $courseID){
		$data = array(
			"companyID" => $companyID,
			"courseID" => $courseID
		);
		$this->db->insert("companycourse", $data);
		
		return $this->employee->updateEmployeeCourses($courseID);
	}
	
	public function unlinkCourse($companyID = null, $courseID){
		
		$this->employee->removeCourse(array('courseID' => $courseID));
		if($companyID != null)
		$this->db->where("companyID", $companyID);
	
		$this->db->where("courseID", $courseID);
		
		return $this->db->delete("companycourse");	
	}
}
