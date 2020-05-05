<?php 

	/**
	 * 
	 */
	class model_comment extends model_database
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Getters
		 */

		public function GetComments($id_product, $page)
		{
			$limit = 5;
			$start = ($page - 1) * $limit;


			$this->query("SELECT * FROM shop_product_comments WHERE id_product = :id ORDER BY id_comment DESC LIMIT $limit OFFSET $start");

			$this->bind(":id", $id_product);

			return $this->resultSet();
		}

		public function NombreComment($id_product)
		{
			$this->query("SELECT COUNT(id_comment) nbr FROM shop_product_comments WHERE id_product = :id");
			$this->bind(":id", $id_product);

			$res = $this->single();
			return $res->nbr;
		}

		/**
		 * Setters
		 */

		public function Add($id_product)
		{
			if (strlen($_POST['comment']) > 200)
			{
			    $maxLength = 200;
			    $_POST['comment'] = substr($_POST['comment'], 0, $maxLength);
			}

			$this->query("INSERT INTO shop_product_comments(id_product, username, comment) VALUES(:id, :username, :comment)");

			$this->bind(":id", $id_product);
			$this->bind(":username", strip_tags($_POST['username']));
			$this->bind(":comment", strip_tags($_POST['comment']));

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function Delete($id_comment)
		{
			$this->query("DELETE FROM shop_product_comments WHERE id_comment = :id");

			$this->bind(":id", $id_comment);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

	}

 ?>