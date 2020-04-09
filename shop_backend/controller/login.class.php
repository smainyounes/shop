<?php 

	/**
	 * 
	 */
	class controller_login
	{
		
		function __construct()
		{
			if (isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."product/list");
			}

		}

		public function Index()
		{
			// login
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$mod = new model_user();

				if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token'] && $mod->Login()) {
					unset($_SESSION['token']);
					header("Location: ".PUBLIC_URL."product/list");
				}
				
			}

			// init token
			$_SESSION['token'] = token();

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// login form
			new view_login;

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>