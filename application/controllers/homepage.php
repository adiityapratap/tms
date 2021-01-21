<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct() {
        parent::__construct();
         $this->load->library('origami');
         $this->load->helper('url');
    }

	public function index()
	{           
		$this->load->view('homepage');
	}

	public function save_task()
	{  
			
	 $this->load->model('origami_model');
	
     $form_data = array(); 
     $form_data[] = array( 
        "group_data_name" => "Task Data", 
        "data"=> array( 
          array( 
         "task_name" => $_POST['task_name'],
         "task_date" => $_POST['task_date'],
         "task_detail" => $_POST['task_detail'], 
        ), 
        ), 
        ); 


     $this->origami_model->create("Task Data", $form_data);

	}
}
