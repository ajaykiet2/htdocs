<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Slide
#====================================================

class Slide extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		# load more modules
	}

	public function get($slideID){
		$slides = $this->db->get_where("slide", array("slideID" => $slideID));
		return ($slides->num_rows() > 0) ? $slides->result()[0] : null;
	}
	
	public function delete($slideID){
		$this->db->where("slideID", $slideID);
		return $this->db->delete("slide");
	}
	
	public function save($slide){
		$this->db->insert("slide", $slide);
		return $this->db->insert_id();
	}
	
	public function update($slideID, $data){
		$this->db->where("slideID", $slideID);
		return $this->db->update("slide", $data);
	}
}
