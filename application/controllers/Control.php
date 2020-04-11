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
	
	// public function db()
	// {
	// 	// Enter your host name, database username, password, and database name.
	// 	// If you have not set database password on localhost then set empty.
	// 	$con = mysqli_connect("localhost","root","","form1");
	// 	// Check connection
	// 	if (mysqli_connect_errno()){
	// 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	// 	}
	// }	

	public function auth_sessions()	{
		session_start();
		if(!isset($_SESSION["username"])) {
			header("Location: login.php");
			exit();
		}
	}

	public function reg()	{
		$this->load->view('reg');
		
		$this->form_validation->set_rules('username','username','required|alpha');
		$this->form_validation->set_rules('email','email','required|valid_email');
		$this->form_validation->set_rules('password','password','required|numeric|exact_length[11]');
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
				// redirect("Hello/dispdata");		
				// echo "Records Saved Successfully";
				if($this->Mod->login($username, $password))  
                {  
                     $session_data = array(  
                          'username'     =>     $username
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(base_url() . 'Control/login');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url() . 'Control/login');  
				}  
				function enter(){  
					if($this->session->userdata('username') != '')  
					{  
						 echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
						 echo '<label><a href="'.base_url
		 
		 				().'main/logout">Logout</a></label>';  
					}  
					else  
					{  
						 redirect(base_url() . 'Control/login');  
					}  
			   }  
			   function logout()  
			   {  
					$this->session->unset_userdata('username');  
					redirect(base_url() . 'Control/login');  
			   }  
			}
		}	

	}

	public function login()
	{
			
			if($this->input->post('login'))
			{
				
				$username=trim($this->input->post('username'));
				$password=trim($this->input->post('password'));
				
			
				$query = "select * from users where username='".$username."' and password='".$password."'";
				$row = $this->db->get_where('users', ['username' => $username, 'password' => $password])->num_rows();
	
				//$que=$this->db->query($query);
				//$row = $que->num_rows();
	
			
				if($row)
				{
					redirect('Control/dashboard');
				}
				else
				{
					$data['error']="<h3 style='color:red'>Invalid login details</h3>";
				}	
			}
			$this->load->view('login',@$data);		
		
		
		
		function dashboard()
		{
		$this->load->view('dashboard');
		}

	}

	function logout()
	{
	$this->load->view('logout');
	}
}



?>
