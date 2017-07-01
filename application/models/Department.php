<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Department extends CI_Model {
 
    var $table = 'department';
    var $column_order = array(null,'departmentID', 'name','description'); 
    var $column_search = array('name','description');
    var $order = array('departmentID' => 'asc'); 
 
    public function __construct(){
        parent::__construct();
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
 
    function get_departments(){
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
		return $this->db->insert("department", $data);
	}
	public function load($id){
		$dept = $this->db->get_where("department", array("departmentID" => $id));
		return ($dept->num_rows()) ? $dept->result()[0] : null;
	}
	public function getAll(){
		return $this->db->get("department")->result();
	}
	
	public function getCourses($departmentID){
		$courses = $this->db->get_where("course", array("departmentID" => $departmentID));
		return ($courses->num_rows() > 0) ? $courses->result() : null;
	}
	
	public function update($departmentID, $inputs){
		$this->db->where("departmentID", $departmentID);
		return $this->db->update("department", $inputs);
	}
	
	public function deleteMulti($departmentIDs){
		foreach($departmentIDs as $departmentID){
			$this->delete($departmentID);
		}
		return true;
	}
	
	public function delete($departmentID){
		$courses = $this->getCourses($departmentID);
		
		if(!empty($courses)){
			foreach($courses as $course){
				$this->course->delete($course->courseID);
			}
		}
		
		$this->db->where("departmentID", $departmentID);
		return $this->db->delete("department");
	}
}