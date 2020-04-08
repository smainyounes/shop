<?php 

	/**
	 * 
	 */
	class model_user extends model_database
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/*
		 * getters
		 */

		public function Login()
		{
			$this->query("SELECT * FROM users WHERE username = :username");
			$this->bind(":username", $_POST['username']);
			$res = $this->single();
			if ($res) {
				if (password_verify($_POST['password'], $res->password)) {
					$_SESSION['user'] = $res->id_user;
					return true;
				}
			}else{
				return false;
			}
		}

		public function GetUsername()
		{
			$this->query("SELECT * FROM shop_users WHERE id_user = :id");
			$this->bind(":id", $_SESSION['user']);
			return $this->single();
		}

		/*
		 * setters
		 */

		public function UpdatePassword()
		{

			//check old pass
			$this->query("SELECT * FROM users WHERE id_user = :id");
			$this->bind(":id", $_SESSION['user']);

			$res = $this->single();
			if (password_verify($_POST['old'], $res->password)) {
				// password match
				if ($_POST['pass1'] === $_POST['pass2']) {
					$this->query("UPDATE shop_users SET password = :password WHERE id_user = :id");
					$this->bind(":password", password_hash($_POST['pass1'], PASSWORD_DEFAULT));
					$this->bind(":id", $_SESSION['user']);

					try {
						$this->execute();
						return true;
					} catch (Exception $e) {
						return false;
					}
				}
			}else{
				return false;
			}

			

		}

		public function UpdateUsername()
		{
			
			$this->query("UPDATE shop_users SET username = :username WHERE id_user = :id");
			$this->bind(":username", strip_tags($_POST['username']));
			$this->bind(":id", $_SESSION['user']);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}

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