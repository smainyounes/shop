<?php 

	/**
	 * 
	 */
	class controller_checkout
	{
		
		function __construct()
		{
			# code...
		}

		public function Index()
		{
			$bas = new model_basket();

			if ($bas->Size() < 1) {
				header("Location: ".PUBLIC_URL."error");
			}

			// checking posted form
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// insert into commande
				$mod = new model_commande();
				$id_commande = $mod->AddCommande();

				if ($id_commande > 0) {
					// insert into product_commande					
					$test = $mod->AddProducts($id_commande, $bas->GetAll());
				}else{
					header("Location: ".PUBLIC_URL."checkout/error");
				}

				if (isset($test)) {
					if ($test) {
						//empty basket
						$bas->Empty();

						// header to done with success
						header("Location: ".PUBLIC_URL."checkout/done/".$id_commande);
					}else{
						header("Location: ".PUBLIC_URL."checkout/error");
					}
					
				}

			}


			// navbar
			new view_navbar;

			// form and basket content
			$view = new view_basket();
			$view->Checkout();

			// footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Done($fac)
		{
			// header
			new view_navbar;

			echo "<h2 class='text-center mt-5'>DONE num facture : $fac</h2>";
			
			// footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Error()
		{
			// header
			new view_navbar;

			echo "<h2 class='text-center mt-5'>Error</h2>";
			
			// footer
			include BACKEND_URL."includes/footer.inc.php";
		}


	}


 ?>