<?php
	class Register extends Controller{
		protected $model;
		protected $view;

		function __construct($params=null){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mRegister;
			$this->view=new vRegister;
		}

		function home(){
			//Coder::codear($this->conf);
		}

		function register(){
			if(isset($_POST['name'])){
		         $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		         $pass=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
		         $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		         $phone=filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
		         $user=$this->model->register($name,$pass,$email,$phone);
		         if ($user== TRUE){
		            Session::set("user",$name);
	              	header("Location: ".APP_W.'user');
		         }
		         else
		         {
		             // no hi és l'usuari, cal registrar
	              	$output=array('redirect'=>APP_W.'register');
              		$this->ajax_set($output);
	             }
		   }
		}
	}