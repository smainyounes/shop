<?php 

	/**
	 * 
	 */
	class model_user extends model_database
	{
		
		function __construct()
		{
			# code...
		}

		/*
		 * getters
		 */

		public function Login()
		{
			# code...
		}

		/*
		 * setters
		 */

		public function UpdateUserName()
		{
			# code...
		}

		public function UpdatePassword()
		{
			# code...
		}

		public function Logout()
		{
			// remove all session variables
			session_unset(); 

			// destroy the session
			session_destroy(); 
		}

	}


 ?>