<?php 
   class Mod extends CI_Model 
   {
	function saverecords($username,$email,$password)
	{
	$query="insert into log () users('','$username','$email','$password')";
	$this->db->query($query);
	}

	function login($last_name, $e)  
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




	public function hash($password)
   {
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
   }

   //verify password
   public function verifyHash($password,$vpassword)
   {
       if(password_verify($password,$vpassword))
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
   }
}