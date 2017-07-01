<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Chepter
#====================================================

class Chepter extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('chepter','slide'));
		
		# load more modules
	}
	
	public function get($chepterID){
		$chepter = $this->db->get_where("chepter", array("chepterID" => $chepterID));
		return ($chepter->num_rows() > 0) ? $chepter->result()[0] : null;
	}
	
	public function load($courseID, $chepterID){
		$chepter = $this->db->get_where("chepter", array("chepterID" => $chepterID, "courseID" => $courseID));
		return ($chepter->num_rows() > 0) ? $chepter->result()[0] : null;
	}
	
	public function delete($chepterID){	
		
		$this->deleteQuestions($chepterID);
		$this->deleteSlides($chepterID);
		
		$this->db->where("chepterID", $chepterID);
		return $this->db->delete("chepter");
	}
	
	public function add($inputs){
		return $this->db->insert("chepter", $inputs);
	}
	
	public function update($chepterID, $data){
		$this->db->where("chepterID", $chepterID);
		return $this->db->update("chepter", $data);
	}
	
	public function getSlides($chepterID){
		$this->db->where("chepterID", $chepterID);
		$this->db->order_by('sequence','asc');
		
		$sides = $this->db->get('slide');
		return ($sides->num_rows() > 0) ? $sides->result() : null;
	}
	
	public function addQuestion($inputs){
		return $this->db->insert("chepterquestion",$inputs);
	}
	
	public function getQuestions($chepterID){
		$this->db->from("chepterquestion")
		->where("chepterID",$chepterID)
		->order_by("chepterquestionID","ASC");
		$questions = $this->db->get();
		return ($questions->num_rows() > 0) ? $questions->result() : null;
	}
	
	public function deleteQuestions($chepterID){
		$this->db->where("chepterID",$chepterID);
		return $this->db->delete("chepterquestion");
	}
	
	public function deleteSlides($chepterID){
		$slides = $this->getSlides($chepterID);
		if(!empty($slides)){
			foreach($slides as $slide){
				$this->slide->delete($slide->slideID);
			}
			return true;
		}
		return false;
	}
	
	#========================================================
	#Chepter Question Operations
	public function loadQuestion($questionID){
		$question = $this->db->get_where("chepterquestion", array('chepterquestionID' => $questionID));
		
		return (!empty($question)) ? $question->result() : null;
	}
	
	public function updateQuestion($questionID, $inputs){
		$this->db->where('chepterquestionID', $questionID);
		return $this->db->update('chepterquestion', $inputs);
	}
	
	public function deleteQuestion($questionID){
		$this->db->where('chepterquestionID', $questionID);
		return $this->db->delete('chepterquestion');
	}
}
