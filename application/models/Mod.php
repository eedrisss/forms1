<?php 
   class Mod extends CI_Model 
   {
	function saverecords($username,$email,$password)
	{
	$query="insert into log () users('','$username','$email','$password')";
	$this->db->query($query);
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