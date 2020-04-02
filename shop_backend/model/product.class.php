<?php 

	/**
	 * the product model
	 */
	class model_product extends model_database
	{
		
		function __construct()
		{
			
		}

		/**
		* getters
		*/
	
		public function GetAll()
		{
			$sql = "SELECT *
						FROM shop_product LEFT JOIN shop_images
						ON shop_product.id_product = shop_images.id_product
						WHERE NOT EXISTS(
						    SELECT * 
						    FROM shop_images as T2BIS -- just an alias table
						    WHERE T2BIS.id_product = shop_product.id_product -- usual join
						    AND shop_images.id_image > T2BIS.id_image -- change operator to take the last instead of the first
						) ORDER BY shop_product.id_product DESC";
			$this->query($sql);
			return $this->resultSet();
		}

		public function Latest()
		{
			$sql = "SELECT *
						FROM shop_product LEFT JOIN shop_images
						ON shop_product.id_product = shop_images.id_product
						WHERE NOT EXISTS(
						    SELECT * 
						    FROM shop_images as T2BIS -- just an alias table
						    WHERE T2BIS.id_product = shop_product.id_product -- usual join
						    AND shop_images.id_image > T2BIS.id_image -- change operator to take the last instead of the first
						) ORDER BY shop_product.id_product DESC LIMIT 9";
			$this->query($sql);
			return $this->resultSet();
		}

		public function GetSingle($id_prod)
		{
			$sql = "SELECT *
						FROM shop_product LEFT JOIN shop_images
						ON shop_product.id_product = shop_images.id_product
						WHERE NOT EXISTS(
						    SELECT * 
						    FROM shop_images as T2BIS -- just an alias table
						    WHERE T2BIS.id_product = shop_product.id_product -- usual join
						    AND shop_images.id_image > T2BIS.id_image -- change operator to take the last instead of the first
						) WHERE shop_product = :id";
			$this->query($sql);
			$this->bind(":id", $id_prod);

			return $this->single();
		}

		public function Search($keyword, $id_categ)
		{
			$conc = "";
			if ($id_categ != 0) {
				$conc = " AND shop_product.id_category = :id ";
			}
			$sql = "SELECT *
						FROM shop_product LEFT JOIN shop_images
						ON shop_product.id_product = shop_images.id_product
						WHERE NOT EXISTS(
						    SELECT * 
						    FROM shop_images as T2BIS -- just an alias table
						    WHERE T2BIS.id_product = shop_product.id_product -- usual join
						    AND shop_images.id_image > T2BIS.id_image -- change operator to take the last instead of the first
						) WHERE shop_product.nom LIKE :keyword  $conc ORDER BY shop_product.id_product";
			$this->query($sql);
			$this->bind(":keyword", "%{$keyword}%");
			if ($conc != "") {
				$this->bind(":id", $id_categ);
			}

			return $this->resultSet();
		}

		public function GetLatestByCateg($id_categ)
		{
			$sql = "SELECT *
						FROM shop_product LEFT JOIN shop_images
						ON shop_product.id_product = shop_images.id_product
						WHERE NOT EXISTS(
						    SELECT * 
						    FROM shop_images as T2BIS -- just an alias table
						    WHERE T2BIS.id_product = shop_product.id_product -- usual join
						    AND shop_images.id_image > T2BIS.id_image -- change operator to take the last instead of the first
						) WHERE shop_product.id_category = :id ORDER BY shop_product.id_product DESC LIMIT 9";
			$this->query($sql);
			$this->bind(":id", $id_categ);

			return $this->resultSet();
		}

		/**
		* setters
		*/

		public function AddNew()
		{
			if (!isset($_POST['prix'])) {
				$_POST['prix'] = -1;
			}

			$this->query("INSERT INTO shop_product(id_category, nom, prix, infos) VALUES (:id_categ, :nom, :prix, :infos)");

			$this->bind(":id_categ", strip_tags($_POST['id_categ']));
			$this->bind(":nom", strip_tags($_POST['nom']));
			$this->bind(":prix", strip_tags($_POST['prix']));
			$this->bind(":infos", strip_tags($_POST['infos']));

			try {
				$this->execute();
				return $this->LastId();
			} catch (Exception $e) {
				return false;
			}
		}

		public function Delete()
		{
			# code...
		}

		public function Update()
		{
			# code...
		}

	}


 ?>