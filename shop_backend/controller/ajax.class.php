<?php 

	/**
	 * 
	 */
	class controller_ajax
	{
		
		function __construct()
		{
			# code...
		}

		public function Index()
		{
			header("Location: ".PUBLIC_URL."error");
		}

		public function Basketdelete($id_prod)
		{
			$mod = new model_basket();
			if ($mod->Delete($id_prod)) {
				$v = new view_basket();
				$v->Basket();
			}else{
				echo "error";
			}
			
		}

		public function Addbasket()
		{
			if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
				$mod = new model_basket();
				if ($mod->Add()) {
					$v = new view_basket();
					$v->Basket();
				}else{
					echo "error";
				}
			}else{
				echo "error";
			}
			$mod= new model_basket();

			
		}

		public function Comment($id_product, $page)
		{
			$view = new view_comment();
			$view->Comments($id_product, $page);
		}

		public function Test($paramter)
		{
			echo "Parameter :".$paramter;
		}

	}


 ?>