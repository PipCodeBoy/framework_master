<?php

	class mHome extends Model{

		function __construct(){
			parent::__construct();
		}

		function login($user,$pass){
		  try{
			    $sql="SELECT * FROM users WHERE username = :user AND password = :pass";
			    $this->query($sql);
			    $this->bind(":user",$user);
			    $this->bind(":pass",$pass);
			    $this->execute();
			    $res=$this->single();


			    if( $this->rowCount()==1){
		          	Session::set('islogged',TRUE);
		          	Session::set('user',$user);
		          	Session::set('hola',$res['id_user']);
		          	Session::set('rol',$res['rol']);
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
		}//END FUCTION LOGIN

		function articles(){
			$sql="SELECT * FROM articles";
			$articles = $this->query($sql);
			$articles = $this->execute();
			$articles = $this->resultSet();
			//$articles = $this->execute($articles);

			return $articles;

		}//END FUNCTION LISTING ARTICLES
	}