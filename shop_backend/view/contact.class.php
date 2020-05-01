<?php 

	/**
	 * 
	 */
	class view_contact
	{
		private $contact;
		private $text;
		function __construct()
		{
			$this->text = $this->Text();

			$this->contact = new model_contact();
			$this->Contact();
		}

		private function Text()
		{
			switch ($_SESSION['lang']) {
				case 'fr':
					return array("contactus" => "Contactez Nous",
					 "map" => "Map",
					 "contact" => "Nos Contact",
					 "address" => "Adresse",
					 "phone" => "Telephone",
					 "email" => "Email");
					break;
				case 'ar':
					return array("contactus" => "اتصل بنا",
					 "map" => "خريطة",
					 "contact" => "اتصالاتنا",
					 "address" => "عنوان",
					 "phone" => "هاتف",
					 "email" => "البريد الإلكتروني");
					break;

			}
		}

		public function Contact()
		{
			$data = $this->contact->GetInfos();
			?>

			<div class="m-4 contact-img animated fadeInLeft">
			  <div class="container py-5 bg-soft-dark">
			    <div class="h1 text-center text-light" id="contact"><?php echo $this->text['contactus']; ?></div>
			  </div>
			</div>
			<div class="row m-2 py-2">
			      <div class="col-md-7">
			        <div class="h2 text-center font-weight-bold"><?php echo $this->text['map']; ?></div>
			          <iframe width="100%" height="80%" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12829.021188116936!2d2.8610017!3d36.499699!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x366fff7331a6cabc!2sFirmwareDZ!5e0!3m2!1sfr!2sdz!4v1575897518342!5m2!1sfr!2sdz" style="border:0;" allowfullscreen=""></iframe>
			      </div>

			      <div class="col-md-5 pt-5 mt-5 font-weight-bold">
			        <table class="mb-5" width="100%">
			          <tr>
			            <td align="center" rowspan="3" valign="top" width="20%"><i class="fa fa-paper-plane fa-2x text-primary"></i></td>
			            <td class="h2 pb-2"><?php echo $this->text['contact']; ?></td>
			          </tr>
			          <tr>
			            <td><?php echo $this->text['email']." ".$data->email; ?></td>
			          </tr>
			          <tr>
			            <td><?php echo $this->text['phone']." ".$data->phone; ?></td>
			          </tr>
			        </table>
			        <table class="mb-5" width="100%">
			          <tr>
			            <td align="center" rowspan="3" valign="top" width="20%"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></td>
			            <td class="h2 pb-2"><?php echo $this->text['address']; ?></td>
			          </tr>
			          <tr>
			            <td><?php echo $this->text['address']." ".$data->address; ?></td>
			          </tr>
			        </table>
			      </div>
			</div>


			<?php
		}
	}

 ?>