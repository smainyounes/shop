<?php 

	/**
	 * 
	 */
	class view_error
	{
		private $text;

		function __construct()
		{
			$this->text = $this->Text();

			?>

			<div class="page-wrap d-flex flex-row align-items-center">
			    <div class="container">
			        <div class="row justify-content-center">
			            <div class="col-md-12 text-center">
			                <span class="display-1 d-block">404</span>
			                <div class="mb-4 lead"><?php echo $this->text['404']; ?></div>
			                <a href="<?php echo(PUBLIC_URL) ?>" class="btn btn-link"><?php echo $this->text['rehome']; ?></a>
			            </div>
			        </div>
			    </div>
			</div>

			<?php
		}

		private function Text()
		{
			switch ($_SESSION['lang']) {
				case 'fr':
					return array("404" => "La page que vous recherchez est introuvable.",
					 "rehome" => "Retour page d'acceuil");
					break;
				case 'ar':
					return array("404" => "لم يتم العثور على الصفحة التي تبحث عنها.",
					 "rehome" => "العودة الى القائمة الرئيسية");
					break;

			}
		}
	}


 ?>