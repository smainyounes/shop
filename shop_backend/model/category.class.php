<?php 

	/**
	 * 
	 */
	class model_category extends model_database
	{
		
		function __construct()
		{
			# code...
		}

		/**
		 * Getters
		 */

		public function GetAll()
		{
			$this->query("SELECT * FROM shop_category");
			return $this->resultSet();
		}

		/**
		 * Setters
		 */

		public function AddNew()
		{
			$this->query("INSERT INTO shop_category(nom_category) VALUES(:nom)");
			$this->bind(":nom", strip_tags($_POST['category']));
			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function Delete($id_categ)
		{
			$this->query("DELETE FROM shop_category WHERE id_category = :id");
			$this->bind(":id", $id_categ);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

	}


 ?>