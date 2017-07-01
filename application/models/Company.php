<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Company extends CI_Model {
 
    var $table = 'company';
    var $column_order = array(null,'companyID', 'name','contactName','contactMobile','contactEmail'); 
    var $column_search = array('name','contactName','contactMobile','contactEmail');
    var $order = array('companyID' => 'asc'); 
 
    public function __construct(){
        parent::__construct();
		$this->load->model('course');
    }
 
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
 
    function get_companies(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
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
		return $this->db->insert("company", $data);
	}
	public function load($id){
		$cmp = $this->db->get_where("company", array("companyID" => $id));
		return ($cmp->num_rows() > 0) ? $cmp->result()[0] : null;
		
	}
	
	public function getAll(){
		return $this->db->get("company")->result();
	}
	
	public function update($companyID, $inputs){
		$this->db->where("companyID", $companyID);
		return $this->db->update("company", $inputs);
	}
	
	public function deleteMulti($companyIDs){
		if(!empty($companyIDs)){
			
		}
		$this->db->where_in("companyID", $ids);
		return $this->db->delete("company");
	}
	
	public function delete($companyID){
		
		$courses = $this->getCourses($companyID);
		if(!empty($courses)){
			foreach($courses as $course){
				$this->course->unlinkCourse($companyID, $course->courseID);
			}
		}
		
		$this->db->where("companyID", $companyID);
		return $this->db->delete("company");
	}
	
	public function getCourses($companyID){
		$this->db->select("course.*, department.name as departmentName")
		->from("course")
		->join("department", "course.departmentID = department.departmentID", "left")
		->join("companycourse", "course.courseID = companycourse.courseID", "left")
		->where("companycourse.companyID", $companyID);
		
		$data = $this->db->get();
		
		if($data != null){
			return $data->result();
		}else{
			return null;
		}
	}
	
	public function getUnlinkCourses($companyID){
		
		$this->db->select('courseID')->from('companycourse');
		$this->db->where('companyID', $companyID);
		$subQuery =  $this->db->get_compiled_select();
 
		$data = $this->db->select('*')
         ->from('course')
         ->where("courseID NOT IN ($subQuery)", NULL, FALSE)
         ->get();
		
		if($data != null){
			return $data->result();
		}else{
			return null;
		}
	}	
}
