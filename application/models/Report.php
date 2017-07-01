<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Reports
#====================================================

class Report extends CI_Model{
	#=============================
	# Report related actions 
	var $table = "(SELECT 
		emp.employeeCode, 
		emp.name, 
		emp.email,
		emp.mobile,
        emp.companyID,
        emp.departmentID,
        aa.questionSet,
		ass.courseID,
        ass.totalQuestions,
        ass.duration,
		ass.passingMarks,
		aa.markObtained as maxScore,
		aa.minuteTaken as timeTaken,
		aa.result,
		aa.timeStamp
	FROM assessmentattempt aa
	INNER JOIN (
		SELECT employeeID,MAX(markObtained) markObtained
		FROM assessmentattempt
		GROUP BY employeeID
	) jaa ON aa.employeeID = jaa.employeeID AND aa.markObtained = jaa.markObtained
	INNER JOIN employee emp on emp.employeeID = aa.employeeID AND emp.role = 'user'
	INNER JOIN assessment ass on ass.assessmentID = aa.assessmentID) reportData";
	
	var $column_order = array(null,'name', 'mobile','email','questionSet','totalQuestions','duration','passingMarks','maxScore','timeTaken','result','timeStamp'); 
    var $column_search = array('name','mobile','email','employeeCode','maxScore','result');
    var $order = array('timeStamp' => 'desc');
	
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper('cookie');
		# load more modules
	}
	
	function get_report($companyID, $courseID,$dateFrom,$dateTo){
        $this->_get_datatables_query();
		$this->db->where('companyID =',$companyID);
		$this->db->where('courseID =',$courseID);
		
		if(!empty($dateFrom) && !empty($dateTo)){			
			$this->db->where('timeStamp >',$dateFrom);
			$this->db->where('timeStamp <',$dateTo);
		}
		if(isset($_POST['length'])){
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		}
        
        $query = $this->db->get();
        return $query->result();
    }
	
	#======================================================================================
	#populating tables data for list of emp
	private function _get_datatables_query(){
         
        $this->db->from($this->table);
 
        $i = 0;
		if(isset($_POST['search']['value'])){
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
		}
        
         
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
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
}
	