<?php 

	/**
	 * 
	 */
	class controller_product
	{
		
		private $product;

		function __construct()
		{
			$this->product = new view_product();
		}

		public function Search($page = 1, $catego = 0, $keyword = null)
		{
			// include header
			include BACKEND_URL."includes/header.inc.php";

			// Search
			$this->product->Search($page, $catego, $keyword);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Detail($id_prod)
		{

			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['username']) && isset($_POST['comment']) && isset($_POST['token'])) {
					if (isset($_SESSION['token']) && !strcmp($_SESSION['token'], $_POST['token'])) {
						$mod = new model_comment();
						$mod->Add($id_prod);
					}
					
				}
			}

			// init token
			$_SESSION['token'] = token();

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// Detail
			$this->product->Detail($id_prod);

			// Comments
			$view = new view_comment();
			$view->wrap($id_prod);

			// suggestion
			$mod = new model_product();
			$data = $mod->GetIdCateg($id_prod);
			$this->product->Suggestion($data->id_category);

			// conact
			new view_contact;

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function List($page = 1)
		{

			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['prod'])) {
					// delete infos
					$mod = new model_product();
					$mod->Delete($_POST['prod']);

					// get imgs
					$mod = new model_image();
					$imgs = $mod->GetImages($_POST['prod']);

					// delete imgs
					foreach ($imgs as $img) {
						DeletePic("img/$img->link");
					}

					$mod->DeleteAllImgProd($_POST['prod']);
				}
			}

			// include header
			include BACKEND_URL."includes/header.inc.php";

			// list
			$this->product->List($page);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Add()
		{
			// check if loggedin
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL);
			}

			$test = null;

			// check if form submited
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// insert product infos
				$mod = new model_product();
				$id_prod = $mod->AddNew();

				if ($id_prod > 0) {
					// upload all images and return array of there names
					$all = UploadPics();

					// insert img links in database
					$mod = new model_image();
					$test = array();
					foreach ($all as $pic) {
						if (empty($pic['error'])) {
							$mod->AddImg($id_prod, $pic['uploadedname']);
						}else{
							$test[] = array('error' => $pic['error'], 'filename' => $pic['filename']);
						}
					}
				}else{
					$test = false;
				}
				
				
			}

			// include header
			include BACKEND_URL."includes/header.inc.php";

			$this->product->AddForm($test);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Comments($id_prod, $page = 1)
		{
			// checking if admin
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				if (isset($_POST['comment'])) {
					$mod = new model_comment();
					$mod->Delete($_POST['comment']);
				}
			}

			// navbar
			new view_navbar;

			$view = new view_comment();
			$view->CommentList($id_prod, $page);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Editinfo($id_prod)
		{
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL."error");
			}

			$test = null;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$mod = new model_product();
				$test = $mod->UpdateInfos($id_prod);
			}

			// navbar
			new view_navbar;

			// edit form
			$view = new view_product();
			$view->EditInfos($id_prod, $test);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>