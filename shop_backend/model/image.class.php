<?php 

	/**
	 * 
	 */
	class model_image extends model_database
	{
		
		function __construct()
		{
			# code...
		}

		public function GetImages($id_prod)
		{
			$this->query("SELECT * FROM shop_images WHERE id_product = :id");
			$this->bind(":id", $id_prod);

			return $this->resultSet();
		}

		public function GetImgLink($id_img)
		{
			$this->query("SELECT link FROM shop_images WHERE id_image = :id");
			$this->bind(":id", $id_img);

			return $this->single();
		}
		
		public function AddImg($id_prod, $img_name)
		{
			$this->query("INSERT INTO shop_images(id_product, link) VALUES(:id, :link)");
			$this->bind(":id", $id_prod);
			$this->bind(":link", $img_name);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function DeleteImg($id_img)
		{
			$this->query("DELETE FROM shop_images WHERE id_image = :id");
			$this->bind(":id", $id_img);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function DeleteAllImgProd($id_prod)
		{
			$this->query("DELETE FROM shop_images WHERE id_product = :id");
			$this->bind(":id", $id_prod);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
	}


 ?>