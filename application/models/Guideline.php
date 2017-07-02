<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#============================================
# This module will oprate the actions on FAQ
#==========================================

class Guideline extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function load($id){
		return $this->db->get_where('guidline', array('guidlineID'=> $id))->result()[0];
	}
	
	public function getAll(){
		return $this->db->get('guidline')->result();
	}
	
	#===========================
	#Operations
	public function add($data){
		return $this->db->insert('guidline',$data);
	}
	
	public function delete($id){
		$this->db->where('guidlineID', $id);
		return $this->db->delete('guidline');
	}
	
	public function update($id, $data){
		$this->db->where('guidlineID', $id);
		return $this->db->update('guidline', $data);
	}
	
}