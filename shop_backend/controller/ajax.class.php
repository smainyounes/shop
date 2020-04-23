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

		public function Test($paramter)
		{
			echo "Parameter :".$paramter;
		}

	}


 ?>