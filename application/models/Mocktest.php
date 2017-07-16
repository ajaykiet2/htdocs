<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#=================================================
# This module will oprate the actions on Mocktest
#===============================================

class Mocktest extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAll(){
		$all = $this->db->get("mocktest")->result();
		$mocktests = array();
		foreach($all as $row){
			if(!isset($mocktests[$row->name])) $mocktests[$row->name] = array();
			array_push($mocktests[$row->name], $row);
		}
		return $mocktests;
	}
	public function load($testName){
		$this->db->where('name',"$testName");
        $mocktest = $this->db->get("mocktest"); 
        return ($mocktest->num_rows() > 0) ? $mocktest->result(): null;
	}
	
	public function loadQuestion($questionID){
		$this->db->where("id",$questionID);
        $mocktest = $this->db->get("mocktest"); 
        return ($mocktest->num_rows() > 0) ? $mocktest->result()[0]: null;
	}

	public function add($input){
		return $this->db->insert_batch('mocktest',$input);
	}

	public function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete('mocktest');
	}
	
	public function deleteTest($test){
		$this->db->where("name",$test);
		return $this->db->delete("mocktest");
	}
	
	public function update($id, $data){
		$this->db->where('id', $id);
		return $this->db->update('mocktest', $data);
	}
}
