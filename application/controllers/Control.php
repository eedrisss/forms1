<?php
class Control extends CI_Controller {
	public function __construct()
	{
		//call CodeIgniter's default Constructor
		parent::__construct();
		$this->load->library('form_validation');
		
		//load database libray manually
		$this->load->database();
		
		//load Model
		$this->load->model('Mod');
	}

	public function index()
	{
		$this->form_validation->set_rules('username','username','required|alpha');
		$this->form_validation->set_rules('email','email','required|valid_email');
        $this->form_validation->set_rules('password','password','required|alpha');
		if ($this->form_validation->run()){
			//load registration view form
			

			//Check submit button 
			if($this->input->post('save')){
				//get form's data and store in local varable
				$username=$this->input->post('username');
				$email=$this->input->post('email');
                $password=$this->input->post('password');
				
				//call saverecords method of Hello_Model and pass variables as parameter
				$this->Mod->saverecords($username,$email,$password);		
				echo "Records Saved Successfully";
			}
		}	

		$this->load->view('reg');
	}
}