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
			foreach ($_SESSION['basket'] as $key => $value) {
				
				if ($_SESSION['basket'][$key]['id_prod'] == $_POST['id_prod']) {
					$_SESSION['basket'][$key]['qte'] += $_POST['qte'];
					return true;
				}
			}

			$_SESSION['basket'][] = array('id_prod' => $_POST['id_prod'], 'qte' => $_POST['qte']);
			return true;
		}

		public function Delete($id_prod)
		{
			foreach ($_SESSION['basket'] as $key => $value) {
				
				if ($_SESSION['basket'][$key]['id_prod'] == $id_prod) {
					unset($_SESSION['basket'][$key]);
					return true;
				}
			}

			return false;
		}

		public function Empty()
		{
			unset($_SESSION['basket']);
		}

		public function Size()
		{
			return count($_SESSION['basket']);
		}
	}

 ?>