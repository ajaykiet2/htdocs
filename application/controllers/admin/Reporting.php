<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
  
class Reporting extends CI_Controller {
  /**
   * @desc : load list modal and helpers
   */
	function __Construct(){
		parent::__Construct();
		$this->db->cache_delete_all();
		$this->load->model('report'); 
		$this->load->helper(array('form', 'url'));
		$this->load->helper('download');
		$this->load->library('PHPReport');
		 
		if(!$this->_isAdmin()){
			redirect(base_url("login"));
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
	 
  /**
   *  @desc : This function is used to get data from database 
   *  And export data into excel sheet
   *  @param : void
   *  @return : void
   */
    public function exportCandidate(){
		$companyID = $this->input->post('companyID');
		$courseID = $this->input->post('courseID');
		$daterange = $this->input->post('dateRange');
		
		$ranges = explode(" - ", $daterange);
		#formatting the date ranges
		$from = date("Y-m-d H:i:s",strtotime($ranges[0]));
		$to = date("Y-m-d H:i:s",strtotime($ranges[1]));
		
        $report = $this->report->get_report($companyID, $courseID, $from, $to);
		$data = json_decode(json_encode($report), True);
		
		$template = 'CandidateReport.xlsx';
		//set absolute path to directory with template files
		$templateDir = getcwd()."/application/views/reports/";
 
		//set config for report
		$config = array(
			'template' => $template,
			'templateDir' => $templateDir
		);
 
		//load template
		$R = new PHPReport($config);
	
		$R->load(array(
				'id' => 'candidate',
				'repeat' => TRUE,
				'data' => $data  
			)
		);
       
		// define output directoy 
		$output_file_dir = getcwd()."/tmp/";
      
 
		$output_file_excel = $output_file_dir  . "CandidateReport.xlsx";
		//download excel sheet with data in /tmp folder
		$result = $R->render('excel', $output_file_excel);
		force_download($output_file_excel, null);
    }
}

