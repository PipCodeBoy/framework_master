<?php

	class Home extends Controller{
		protected $model;
		protected $view;

		function __construct($params){
			parent::__construct($params);
			$this->model=new mHome();
			$this->view= new vHome();
		}

		function home(){

		}

		function login(){
		   if(isset($_POST['name'])){
		         $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		         $pass=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
		         $user=$this->model->login($name,$pass);
		         if ($user== TRUE){
	              	$output=array('redirect'=>APP_W.'user');
	              	$this->ajax_set($output);
		         }
		         else
		         {
	              	$output=array('redirect'=>APP_W.'register');
              		$this->ajax_set($output);
	             }
		   }
		}

		function logout(){
			session_destroy();
			header("Location: ".APP_W.'home');
		}

		function showarticles(){
			$result = $this->model->articles();
			$this->ajax_set($result);
		}
}//END CLASS HOME