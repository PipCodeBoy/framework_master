<?php
	/**
	 *  vHome
	 *  Prepares and loads the corresponding Template
	 *  @author Guillem
	 * 
	 * */
	class vRegister extends View{

		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('register',$this->view_data);
			
		}

	}