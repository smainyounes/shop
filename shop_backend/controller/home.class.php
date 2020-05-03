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

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['mail_sub'])) {
					$mod = new model_emailsub();
					$mod->Add();
				}
			}

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// call latest
			$this->product->Latest();

			// call latest category
			$this->product->LatestByCategory();

			// call contact
			new view_contact;

			// subscribe banner
			$v = new view_emailsub();
			$v->Banner();

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>