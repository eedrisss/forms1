<?php
class Control extends CI_Controller {
	public function __construct()
	{
		//call CodeIgniter's default Constructor
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Mod');
		
		//load database libray manually
		//$this->load->database();
		
		//load Model
		$this->load->model('Mod');
	}
	
	public function index()
	{
		
		if($this->input->post('save'))
		{
            $username=$this->input->post('username');
            $email=$this->input->post('email');
            $password=$this->input->post('password');;
		
		$que=$this->db->query("select * from users where email='".$email."'");
		$row = $que->num_rows();
		if($row)
		{
		$data['error']="<h3 style='color:red'>This user already exists</h3>";
		}
		else
		{
		$que=$this->db->query("insert into users values('','$username','$email','$password')");
		
		$data['error']="<h3 style='color:blue'>Your account created successfully</h3>";
		}			
				
		}
	$this->load->view('registration',@$data);	
	}

	
	public function reg()
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

		$this->load->view('reg.php');
	}
	

	function can_login($last_name, $e)  
	{  
		$this->db->where('username', $username);  
		$this->db->where('password', $password);  
		$query = $this->db->get('users');  
		//SELECT * FROM users WHERE username = '$username' AND password = '$password'  
		if($query->num_rows() > 0)  
		{  
			return true;  
		}  
		else  
		{  
			return false;       
		}  
	}	

	function login()
	{
		$this->load->view('login.php');	
	}

	function logout()
	{
		$this->load->view('logout.php');	
	}

	function dashboard()
	{
		$this->load->view('dashboard.php');	
	}

}
