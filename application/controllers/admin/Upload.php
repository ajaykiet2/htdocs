<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('employee', 'chepter','assessment'));
		if(!$this->_isAdmin()){
			if($this->input->is_ajax_request()){
				exit("Unautherized Access!");
			}else{
				redirect(base_url("login"));
			}
		}
	}
	private function _isAdmin(){
		$empInfo = $this->employee->checkLoggedIn();
		if(isset($empInfo['role'])){
			return  ($empInfo['role'] === 'admin') ? true : false;
		}else{
			return false;
		}
	}
	
	public function uploadImage(){
		$source = $this->input->post("source");
		
		$config['upload_path']          = FCPATH."uploads/images/$source/";
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['max_size']             = 10000;
		$config['max_width']            = 2448;
		$config['max_height']           = 5000;
		
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('file')){
				$upload_data = $this->upload->data();
				$response = new StdClass;
				$response->link = base_url("uploads/images/$source/").$upload_data['file_name'];
				echo stripslashes(json_encode($response));
			
		}else{
			$data['error'] = 'The following error occured : '.$this->upload->display_errors().'Click on "Remove" and try again!';
			echo stripslashes(json_encode($data));
		}
	}
	
	public function chepterQuestion(){
		$configUpload['upload_path'] = FCPATH.'uploads/excel/';
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '5000';
		$this->load->library('upload', $configUpload);
		if($this->upload->do_upload('file_to_upload')){			
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			
			$objReader= PHPExcel_IOFactory::createReader('Excel2007');
			//Set to read only
			$objReader->setReadDataOnly(true); 
			//Load excel file
			$objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);	
			
			$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); 
			$objWorksheet=$objPHPExcel->setActiveSheetIndex(0); 
			$questionData = array();
			$chepterID = $this->input->post("chepterID");
			
			$this->chepter->deleteQuestions($chepterID);
			
			
			for($i=2;$i<=$totalrows;$i++){
				$questionData = array(
					'chepterID' => $chepterID,
					'question' => $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(),
					'option_1' => $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(),
					'option_2' => $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(),
					'option_3' => $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(),
					'option_4' => $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(),
					'answer' => $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(),
					'explanation' => $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(),
				);
			
				$this->chepter->addQuestion($questionData);
			}
			
			print json_encode( array(
				'uploaded' => true,
				'message' => 'Questions Uploaded Successfully!'
			));
			
		}else{
			print json_encode( array(
				'uploaded' => false,
				'message' => $this->upload->display_errors()
			));
		}
	}
	
	
	public function assessmentQuestion(){
		$configUpload['upload_path'] = FCPATH.'uploads/excel/';
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '5000';
		$this->load->library('upload', $configUpload);
		if($this->upload->do_upload('file_to_upload')){			
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			
			$objReader= PHPExcel_IOFactory::createReader('Excel2007');
			
			$objReader->setReadDataOnly(true); 
			
			$objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);	
			
			$courseID = $this->input->post("courseID");
			$assessmentID = $this->input->post("assessmentID");
			$questionSets = $this->input->post("questionSets");
			$totalQuestions = $this->input->post("totalQuestions");
			
			$response = array(
				'uploaded' => true,
				'message' => 'Questions Uploaded Successfully!'
			);
			
			for($setIdx=1; $setIdx <= $questionSets; $setIdx++){
				$this->assessment->deleteSet($assessmentID,$setIdx);
				$totalrows=$objPHPExcel->setActiveSheetIndex($setIdx-1)->getHighestRow();
				if($totalrows < $totalQuestions){
					$response['uploaded'] = false;
					$response['message'] = "Question are less than ".$totalQuestions." for set ".$setIdx.".";
					break;
				}
				$objWorksheet=$objPHPExcel->setActiveSheetIndex($setIdx-1); 
				
				$questionData = array();
				
				for($i=2;$i<=$totalQuestions+1;$i++){
					
					$questionData = array(
						'assessmentID' => $assessmentID,
						'question' => $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(),
						'option_1' => $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(),
						'option_2' => $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(),
						'option_3' => $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(),
						'option_4' => $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(),
						'answer' => $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(),
						'weight' => $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(),
						'questionSet' => $setIdx,
					);
				
					$this->assessment->addQuestion($questionData);
				}
			}
			
			print json_encode($response);
			
		}else{
			print json_encode( array(
				'uploaded' => false,
				'message' => $this->upload->display_errors()
			));
		}
		unlink(FCPATH.'uploads/excel/'.$file_name);
	}
}
