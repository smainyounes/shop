<?php 

	/**
	 * 
	 */
	class controller_home
	{
		private $product;

		function __construct()
		{
			$this->product = new view_product();

		}

		public function Index()
		{
			// include header
			include BACKEND_URL."includes/header.inc.php";

			// call latest
			$this->product->Latest();

			// call latest category
			$this->product->LatestByCategory();

			// call contact
			new view_contact;

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>