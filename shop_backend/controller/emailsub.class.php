<?php 

	/**
	 * 
	 */
	class controller_emailsub
	{
		
		function __construct()
		{
			# code...
		}

		public function Index()
		{
			$this->List();
		}

		public function List($page = 1)
		{
			// check if login
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['email'])) {
					$mod = new model_emailsub();
					$mod->Delete($_POST['email']);
				}
			}

			// include header
			new view_navbar;

			// load data
			$v = new view_emailsub();
			$v->List($page);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

	}

 ?>