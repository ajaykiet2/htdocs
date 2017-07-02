<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on Accreditation
#====================================================

class Environment extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		$this->load->model(array("accreditation",'employee'));
		# load more modules
	}
	
	# Loading All environment details
	public function load($source = "website"){
		$data = array();
		switch($source){
			case "admin":
				$data = array(
					'loggedInEmployee' => (object)$this->session->userdata(),
				);
			break;
			case "employee":
				$data = array(
					'loggedInEmployee' => (object)$this->session->userdata(),
				);
			break;
			default:
				$data = array(
					'accreditations' => $this->accreditation->load(array("limit" => 5)),
					'breadcrumb' => $this->_createBreadcrumb(),
					'menus' => $this->_createMenus(),
				);
		}
		return $data;
		
	}
	
	#Automated breadcrumb creation function
	private function _createBreadcrumb(){
		$segments = $this->uri->segment_array();
		$breadcrumb = array();
		$link = "/";
		$name = (count($segments)) ? "HOME" : "HOME  /  WELCOME";
		
		array_push($breadcrumb, (object)array(
			"name" => $name,
			"link" => $link,
			"class" => ''
		));
		
		for($i=1; $i <= count($segments); $i++){
			
			$class= ($i >= count($segments)) ? 'active' : '';
			$link .= $segments[$i]."/";
			
			array_push($breadcrumb, (object)array(
				"name" => strtoupper($segments[$i]),
				"link" => $link,
				"class" => $class
			));
		}
		return $breadcrumb;
	}
	
	# Creating Menus
	private function _createMenus(){
		
		// $menus = array("ABOUT", "COURSES", "GALLERY", "FAQ", "GUIDLINES", "CONTACT", "LOGIN");
		$menus = array("ABOUT", "COURSES", "GALLERY", "GUIDELINES", "CONTACT", "LOGIN");
		$currentPage = strtoupper($this->uri->segment(1));
		
		$created = array();
		foreach($menus as $menu){
			
			$link = strtolower($menu);
			$class = ($currentPage === $menu) 
					? "active"
					: (($currentPage == "" || $currentPage == null) && $menu === 'ABOUT') 
						? "active" 
						: '';
						
			array_push($created, (object)array(
				"name" =>$menu,
				"link" => "/".$link,
				"class" => $class
			));
		}
		return $created;
	}
	
}
