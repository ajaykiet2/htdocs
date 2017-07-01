<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Assessment extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function load($assessmentID){
		$assessment = $this->db->get_where("assessment",array('assessmentID' => $assessmentID));
		return ($assessment->num_rows() > 0) ? $assessment->result()[0] : null;
	}
	
	public function add($inputs){
		return $this->db->insert("assessment", $inputs);
	}
	
	public function update($assessmentID, $data){
		$this->db->where("assessmentID", $assessmentID);
		return $this->db->update("assessment",$data);
	}
	
	public function delete($assessmentID){
		#remove depandent data
		$this->deleteQuestion(array('assessmentID'=>$assessmentID));
		
		$this->db->where("assessmentID", $assessmentID);
		return $this->db->delete("assessment");
	}
	
	public function get($inputs){
		$assessment = $this->db->get_where("assessment",$inputs);
		return ($assessment->num_rows() > 0) ? $assessment->result()[0] : null;
	}
	
	#========================================
	# Assessment question related functions
	
	public function addQuestion($data){
		return $this->db->insert("assessmentQuestion", $data);
	}
	
	public function updateQuestion($assessmentQuestionID, $inputs){
		$this->db->where("assessmentQuestionID", $assessmentQuestionID);
		return $this->db->update("assessmentQuestion", $inputs);
	}
	
	public function deleteQuestion($conditions){
		foreach($conditions as $column => $value){
			$this->db->where($column,$value);
		}
		return $this->db->delete("assessmentQuestion");
	}
	
	public function loadQuestion($questionID){
		return $this->db->get_where("assessmentQuestion",array("assessmentQuestionID" => $questionID))->result()[0];
	}
	
	public function getQuestions($assessmentID){
		return $this->db->get_where("assessmentQuestion",array('assessmentID' => $assessmentID))->result();
	}
	
	public function deleteSet($assessmentID, $setNum){
		$this->db->where("assessmentID", $assessmentID);
		$this->db->where("questionSet", $setNum);
		return $this->db->delete("assessmentQuestion");
	}
	
	public function getQuestionSet($assessmentID, $questionSet){
		$conditions = array(
			'assessmentID' => $assessmentID,
			'questionSet' => $questionSet
		);
		return $this->db->get_where('assessmentquestion', $conditions)->result();
	}
	
	public function getQuestionSets($assessmentID){
		$questions = $this->db->get_where("assessmentQuestion",array('assessmentID' => $assessmentID))->result();
		
		$questGroup = array();
		if(!empty($questions)){
			foreach($questions as $question){
				if(!isset($questGroup[$question->questionSet])){
					$questGroup[$question->questionSet] = array();
				}
				array_push($questGroup[$question->questionSet],$question);
			}
		}
		
		return $questGroup;
	}
	
	public function getAttempts($inputs){
		return $this->db->get_where("assessmentattempt", $inputs)->result();
	}
	
	public function addAttempt($inputs){
		return $this->db->insert("assessmentattempt", $inputs);
	}
}
