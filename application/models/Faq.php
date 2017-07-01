<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#============================================
# This module will oprate the actions on FAQ
#==========================================

class Faq extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		# load more modules
	}
	
	public function load($params){
		$this->db->select('*');
        $this->db->from('faq');
        $this->db->order_by('timeStamp','desc');
		
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $faqs = $this->db->get();
        
        return ($faqs->num_rows() > 0) ? $faqs->result(): FALSE;
	}
	
	public function total(){
		return $this->db->get('faq')->num_rows();
	}
	
	public function add($data){
		return $this->db->insert('faq',$data);
	}
	
	public function delete($id){
		$this->db->where('faqID', $id);
		return $this->db->delete('faq');
	}
	
	public function update($id, $data){
		$this->db->where('faqID', $id);
		return $this->db->update('faq', $data);
	}
}
