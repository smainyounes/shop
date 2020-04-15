<?php 

	/**
	 * 
	 */
	class model_basket
	{
		
		function __construct()
		{
			if (!isset($_SESSION['basket'])) {
				$_SESSION['basket'] = array();
			}
		}

		public function GetAll()
		{
			if (count($_SESSION['basket']) > 0) {
				return $_SESSION['basket'];
			}else{
				return null;
			}
		}

		public function Add()
		{
			$_SESSION['basket'] = array('id_prod' => $_POST['id_prod'], 'qte' => $_POST['qte']);
		}

		public function Delete()
		{
			# code...
		}

		public function Size()
		{
			return count($_SESSION['basket']);
		}
	}

 ?>