<?php 

	/**
	 * 
	 */
	class controller_settings
	{
		
		function __construct()
		{
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL);
			}
		}

		public function Index()
		{
			$test = null;
			
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$user = new model_user();

				// upadate username
				if (isset($_POST['username'])) {
					$test = $user->UpdateUsername();
				}

				// update password
				if (isset($_POST['old'])) {
					$test = $user->UpdatePassword();
				}

				//update contact infos
				if (isset($_POST['email'])) {
					$control = new model_contact();
					$test = $control->UpdateInfos();
				}
			}

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// settings view
			new view_settings($test);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>