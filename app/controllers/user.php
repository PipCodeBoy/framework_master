<?php
	
	class User extends Controller{
		protected $model;
		protected $view;
		
		function __construct($params){
			parent::__construct($params);
			$this->model=new mUser();
			$this->view= new vUser();
			//echo 'Hello controller!';
		}
		function home(){
			//$this->showusers();
		}

		function createadd()
		{
			$name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			$description=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
			$photo=filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_STRING);
			$price=filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
			$lat= $_POST['lat'];
			$lon= $_POST['lon'];
			$price=filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);

			if($photo!=null)
			{
				$user=$this->model->createadd($name,$description,$photo,$price,$lat,$lon);
			}
			else
			{
				$user=$this->model->createadd($name,$description,$photo=null,$price,$lat,$lon);
			}
		}

		function showusers()
		{
			$allusers=$this->model->allusers();
			$this->ajax_set($allusers);
		}

		function deluser()
		{
			$miid = $_POST['useriddel'];
			$deleted= $this->model->deluser($miid);
			$this->ajax_set($deleted);
		}

		function getedituser()
		{
			$miid = $_POST['useriddel'];
			$getedited=$this->model->getedituser($miid);
			$this->ajax_set($getedited);
		}

		function edituser()
		{
			$name = $_POST['name'];
			$pass = $_POST['pass'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$rol = $_POST['rol'];
			$innerid = $_POST['innerid'];
			$this->model->edituser($innerid,$name,$pass,$email,$phone,$rol);
		}

		function vote()
		{

			$article = $_POST['art'];
			$type = $_POST['type'];

			$dd = $this->model->vote($article,$type);
			$this->ajax_set($dd);

		}

		function getVote()
		{

			$article = $_POST['id'];

			$dd = $this->model->getVote($article);
			$this->ajax_set($dd);

		}

	}





