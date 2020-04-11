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
	
	public function db()
	{
		// Enter your host name, database username, password, and database name.
		// If you have not set database password on localhost then set empty.
		$con = mysqli_connect("localhost","root","","form1");
		// Check connection
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
}




	public function reg()	{
		$this->load->view('reg');

		// When form submitted, insert values into the database.
		if (isset($_REQUEST['username'])) {
			// removes backslashes
			$username = stripslashes($_REQUEST['username']);
			//escapes special characters in a string
			$username = mysqli_real_escape_string($con, $username);
			$email    = stripslashes($_REQUEST['email']);
			$email    = mysqli_real_escape_string($con, $email);
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con, $password);
			$query    = "INSERT into `users` (username, password, email)
						VALUES ('$username', '" . blowfish($password) . "', '$email')";
			$result   = mysqli_query($con, $query);
			if ($result) {
				echo "<div class='form'>
					<h3>You are registered successfully.</h3><br/>
					<p class='link'>Click here to <a href='login'>Login</a></p>
					</div>";
			} 
			else {
				echo "<div class='form'>
					<h3>Required fields are missing.</h3><br/>
					<p class='link'>Click here to <a href='reg/'>registration</a> again.</p>
					</div>";
			}
		}
	}
	public function login(){
		$this->load->view('login');
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
		} 
		else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login'>Login</a> again.</p>
                  </div>";
		}
		
	}
	
	function dashboard()
	{
	$this->load->view('dashboard');
	}

	
	function logout()
	{
	$this->load->view('logout');
	}
}
}
?>
