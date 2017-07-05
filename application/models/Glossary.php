<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#=================================================
# This module will oprate the actions on Glossary
#===============================================

class Glossary extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		return $this->db->get('glossary')->result();
	}
	
	public function delete($glossaryID){
		$this->db->where('glossaryID',$glossaryID);
		return $this->db->delete('glossary');
	}
	
	public function add($data){
		$this->db->insert("glossary", $data);
		return $this->db->insert_id();
	}
	
}
