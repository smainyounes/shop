<?php 

	/**
	 * model contact class
	 *
	 * to get the contact infos and update them by the admin
	 */
	class model_contact extends model_database
	{
		
		
		function __construct()
		{
			parent::__construct();
		}

		/*
		 * getters
		 */

		public function GetInfos()
		{
			$this->query("SELECT * FROM shop_contact");
			return $this->single();
		}

		/*
		 * setters
		 */

		public function UpdateInfos()
		{
			$this->query("UPDATE shop_contact SET email = :email, phone = :phone, address = :address");
			$this->bind(":email", strip_tags($_POST['email']));
			$this->bind(":phone", strip_tags($_POST['phone']));
			$this->bind(":address", strip_tags($_POST['address']));

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

	}

 ?>