<?php 

	/**
	 * 
	 */
	class model_emailsub extends model_database
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Getters
		 */

		public function GetByPage($page)
		{
			$limit = 10;
			$start = ($page - 1) * $limit;

			$this->query("SELECT * FROM shop_sub_emails LIMIT $limit OFFSET $start");

			return $this->resultSet();
		}

		public function NombreEmails()
		{
			$this->query("SELECT COUNT(id_email) nbr FROM shop_sub_emails");
			$res = $this->single();
			return $res->nbr;
		}

		public function GetAll()
		{
			$this->query("SELECT * FROM shop_sub_emails");

			return $this->resultSet();
		}

		/**
		 * Setters
		 */

		public function Add()
		{
			$this->query("INSERT INTO shop_sub_emails(email) VALUES(:email)");

			$this->bind(":email", filter_var($_POST['mail_sub'], FILTER_SANITIZE_EMAIL));

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function Delete($id_email)
		{
			$this->query("DELETE FROM shop_sub_emails WHERE id_email = :id_email");
			$this->bind(":id_email", $id_email);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function SendEmail($id_email)
		{
			# code...
		}

		public function SendToAll()
		{
			# code...
		}
	}

 ?>