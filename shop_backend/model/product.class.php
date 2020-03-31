<?php 

	/**
	 * the product model
	 */
	class model_product extends model_database
	{
		
		function __construct()
		{
			echo "worked";
		}

		/**
		* getters
		*/
	
		public function GetAll()
		{
			# code...
		}

		public function Latest()
		{
			# code...
		}

		public function GetSingle($id_prod)
		{
			# code...
		}

		public function Suggestion($id_categ)
		{
			# code...
		}

		public function GetImages($id_prod)
		{
			# code...
		}

		public function Search($keyword, $id_categ)
		{
			# code...
		}

		public function GetLatestByCateg($id_categ)
		{
			# code...
		}

		/**
		* setters
		*/

		public function AddNew()
		{
			# code...
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