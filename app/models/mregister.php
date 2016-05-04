<?php

	class mRegister extends Model{

		function __construct(){
			parent::__construct();

		}

		function register($user,$pass,$email,$phone){
		  try{
			    $sql="INSERT INTO users(username,password,email,phone) VALUES(:user,:pass,:email,:phone)";
			    $this->query($sql);
			    $this->bind(":user",$user);
			    $this->bind(":pass",$pass);
			    $this->bind(":email",$email);
			    $this->bind(":phone",$phone);
			    $this->execute();
			    //print_r($this->resultSet());
			    $res=$this->single();
			    if( $this->rowCount()==1){
		          	Session::set('islogged',TRUE);
		          	Session::set('user',$user);
		          	return TRUE;
			    }
		    	else {
		         	Session::set('islogged',FALSE);
		          	return FALSE;
		      	}
		    }
		    catch(PDOException $e){
		       echo "Error:".$e->getMessage();
		   	}
		}
	}