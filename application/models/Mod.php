<?php 
   class Mod extends CI_Model 
   {
	function saverecords($username,$email,$password)
	{
	$query="insert into log () users('','$username','$email','$password')";
	$this->db->query($query);
	}
}