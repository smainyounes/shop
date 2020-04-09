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

		public function Search($catego = 0, $keyword = null)
		{
			// include header
			include BACKEND_URL."includes/header.inc.php";

			// Search
			$this->product->Search($catego, $keyword);

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function Detail($id_prod)
		{
			// include header
			include BACKEND_URL."includes/header.inc.php";

			// Detail
			$this->product->Detail($id_prod);

			// suggestion
			$mod = new model_product();
			$data = $mod->GetIdCateg($id_prod);
			$this->product->Suggestion($data->id_category);

			// conact
			new view_contact;

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}

		public function List($categ= null, $keyword = null)
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
			$this->product->List();

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

		public function Edit($id_prof)
		{
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL);
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
			}
		}
	}

 ?>