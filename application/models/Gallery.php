<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Accreditation
#====================================================

class Gallery extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		# load more modules
	}

	public function get($id){
		$gallery =  $this->db->get_where("gallery", array("id" => $id));
		return ($gallery->num_rows() > 0) ? $gallery->result()[0] : null;
	}
	
	public function load($params){
		$this->db->select('*');
        $this->db->from('gallery');
        $this->db->order_by('timeStamp','desc');
		
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $glry = $this->db->get();
        
        return $glry->result();
	}
	
	public function total(){
		return $this->db->get('gallery')->num_rows();
	}
	
	public function delete($id){
		$this->db->where("id", $id);
		return $this->db->delete("gallery");
	}
	
	public function add($galleryData){
		$this->db->insert("gallery", $galleryData);
		return $this->db->insert_id();
	}
	
	public function update($id, $data){
		$this->db->where("id", $id);
		return $this->db->update("gallery", $data);
	}
}
