<?php 

	/**
	 * 
	 */
	class controller_category
	{
		
		function __construct()
		{
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL);
			}
		}

		public function Index()
		{
			$msg = null;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$mod = new model_category();

				// check if insertion
				if (isset($_POST['category'])) {
					$msg = $mod->AddNew();
				}
				
				// check if deletion
				if (isset($_POST['categ'])) {
					$msg = $mod->Delete($_POST['categ']);
				}
			}

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// login form
			new view_category($msg);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>