<?php

	class mUser extends Model{

		function __construct(){
			parent::__construct();
		}

		function createadd($name,$description,$photo=null,$price,$lat,$lon)
		{
			try{
			    $sql="INSERT INTO articles(name,description,photo,price,valoracion,user,lat,lon)
			    		VALUES(:name,:description,:photo,:price,1,:iduser,:lat,:lon)";
			    $this->query($sql);
			    $this->bind(":name",$name);
			    $this->bind(":description",$description);
			    $this->bind(":photo",$photo);
			    $this->bind(":price",$price);
			    $this->bind(":iduser",$_SESSION['hola']);
			    $this->bind(":lat",$lat);
			    $this->bind(":lon",$lon);
			    $this->execute();
			    // print_r($this->resultSet());
			    $res=$this->single();
			    if( $this->rowCount()==1){

		          	return TRUE;
			    }
		    	else {
		          	return FALSE;
		      	}
		    }
		    catch(PDOException $e){
		       echo "Error:".$e->getMessage();
		   	}
		}

		function allusers()
		{
			$sql="SELECT *  FROM users";
			$this->query($sql);
			$this->execute();
			$res=$this->resultSet();

			return $res;
		}

		function oneuser()
		{
			$sql="SELECT * FROM users WHERE id_user = :userid";
			$this->query($stmt);
			$this->bind(':userid', $id);
		 	$this->execute();
		 	$res=$this->resultSet();

			return $res;
		}
		function deluser($id)
		{
			$stmt="DELETE FROM users WHERE id_user = :userid";
			$this->query($stmt);
			$this->bind(':userid', $id);
		 	$this->execute();

		 	if($this->rowCount()==1){
	          	return TRUE;
		    }
	    	else {
	          	return FALSE;
	      	}
		}

		function getedituser($id)
		{
			$sql = "SELECT username, password,email,phone,rol,id_user FROM users WHERE id_user = :userid";
			$this->query($sql);
			$this->bind(':userid', $id);
			$this->execute();
			$row = $this->single();

			return $row;
		}

		function edituser($id,$name,$pass,$email,$phone,$rol)
		{
			$stmt="UPDATE users SET username=:name, password=:pass,email=:email,phone=:phone,rol=:rol WHERE id_user = :innerid";
			$this->query($stmt);
			$this->bind(':name', $name);
			$this->bind(':pass', $pass);
			$this->bind(':email', $email);
			$this->bind(':phone', $phone);
			$this->bind(':rol', $rol);
			$this->bind(':innerid', $id);
		 	$this->execute();
		}

		function vote($art,$type)
		{
			$this->query("SELECT * FROM score WHERE users_id_user = :iduser AND articles_id_article = :idart");
	    	$this->bind(":iduser",$_SESSION['hola']);
	    	$this->bind(":idart",$art);
	    	$this->execute();

	    	$res = $this->rowCount();

	    	if($res == 0)
	    	{
	    		if($type == 0)
				{
					$this->query("INSERT INTO score VALUES(1,:iduser,:idart)");
			    	$this->bind(":iduser",$_SESSION['hola']);
			    	$this->bind(":idart",$art);
			    	$this->execute();

			    	return 0;
				}
				else
				{
					$this->query("INSERT INTO score VALUES(-1,:iduser,:idart)");
			    	$this->bind(":iduser",$_SESSION['hola']);
			    	$this->bind(":idart",$art);
			    	$this->execute();

			    	return 0;
				}
	    	}
	    	else
	    	{
	    		return -3;
	    	}

			
	    	
			// die(var_dump($res));

		}

		function getVote($art){
			$this->query("SELECT 
							(SELECT COUNT(score) FROM score WHERE score = -1 AND articles_id_article = :art ) AS neg,
						    (SELECT COUNT(score) FROM score WHERE score = 1 AND articles_id_article = :art ) AS pos
						FROM score LIMIT 1
						");
	    	$this->bind(":art",$art);
	    	$this->execute();

	    	return $res = $this->single();
		}
	}





