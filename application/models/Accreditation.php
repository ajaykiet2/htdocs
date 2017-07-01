<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Accreditation
#====================================================

class Accreditation extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		# load more modules
	}

	public function get($id){
		$acrdtion = $this->db->get_where("accreditation", array("id" => $id));
		return ($acrdtion->num_rows() > 0) ? $acrdtion->result()[0] : null;
	}
	
	public function load($params){
		$this->db->select('*');
        $this->db->from('accreditation');
        $this->db->order_by('timeStamp','desc');
		
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $acrdtion = $this->db->get();
        
        return ($acrdtion->num_rows() > 0) ? $acrdtion->result(): null;
	}
	
	public function total(){
		return $this->db->get('accreditation')->num_rows();
	}
	
	public function delete($id){
		$this->db->where("id", $id);
		return $this->db->delete("accreditation");
	}
	
	public function add($accrData){
		$this->db->insert("accreditation", $accrData);
		return $this->db->insert_id();
	}
	
	public function update($id, $data){
		$this->db->where("id", $id);
		return $this->db->update("accreditation", $data);
	}
}
