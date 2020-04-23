<?php 

	/**
	 * 
	 */
	class controller_commande
	{
		
		function __construct()
		{
			# code...
		}

		public function Index()
		{
			$this->List("tout", 1);
		}

		public function List($filter = "tout", $page = 1)
		{
			// check if login
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			// navbar
			new view_navbar;

			// list commandes
			$cmd = new view_commande();
			$cmd->List($filter, $page);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";	
		}

		public function Detail($id_commande)
		{
			// check if login
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			// check if posted
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['etat'])) {
					$mod = new model_commande();
					$test = $mod->UpdateState($id_commande, $_POST['etat']);
				}
			}

			// navbar
			new view_navbar;

			if (isset($test)) {
				new view_alert($test);
			}

			// list commandes
			$cmd = new view_commande();
			$cmd->Detail($id_commande);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";	
		}
	}

 ?>