<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_controller extends CI_Controller {
	function __construct(){ 
		parent::__construct();
				$this->load->helper('string');
		$this->load->model('user_model');
		$this->load->model('common_model');
		$this->load->model('callback_model');
		$this->load->model('feedback_model');
	}
	public function index()
	{
		
		$data = $this->common_model->emp_loop();
		print_r($data);
	}
}
