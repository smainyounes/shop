<?php 

	/**
	 * 
	 */
	class view_basket
	{
		private $text;

		function __construct()
		{
			$this->text = $this->Text();
		}

		private function Text()
		{
			switch ($_SESSION['lang']) {
				case 'fr':
					return array("final" => "Finaliser Commande",
					 "infos" => "Vos informtaions",
					 "name" => "Nom et Prenom",
					 "phone" => "Telephone",
					 "address" => "Adresse",
					 "obs" => "Observation",
					 "basket" => "Panier",
					 "product" => "Produit",
					 "total" => "Total",
					 "confirm" => "Confirmer",
					 "empty" => "Panier Vide",
					 "final" => "Finaliser Commande",
					 "yes" => "Oui",
					 "no" => "Non",
					 "da" => "DA",
					 "rehome" => "Retour page d'acceuil",
					 "remove" => "Enlever du panier?",
					 "retry" => "Réessayer",
					 "done" => "Commande Pris en charge, voila num facture :",
					 "error" => "Erreur, Votre commande n'a pas été pris en charge");
					break;
				case 'ar':
					return array("final" => "إنهاء الطلب",
					 "infos" => "معلوماتكم الشخصية",
					 "name" => "الإسم واللقب",
					 "phone" => "هاتف",
					 "address" => "عنوان",
					 "obs" => "ملاحظة",
					 "basket" => "سلة",
					 "product" => "المنتج",
					 "total" => "مجموع",
					 "confirm" => "تأكيد",
					 "empty" => "سلة فارغة",
					 "final" => "إنهاء الطلب",
					 "yes" => "نعم",
					 "no" => "لا",
					 "da" => "دج",
					 "rehome" => "العودة الى القائمة الرئيسية",
					 "remove" => "إزالة من السلة؟",
					 "retry" => "أعد المحاولة",
					 "done" => "رائع الآن طلبك تحت الخدمة رقم الفاتورة",
					 "error" => "خطىء طلبك غير مدعوم في هذه اللحظة");
					break;

			}
		}

		public function Checkout()
		{
			$basket = new model_basket();
			$data = $basket->GetAll();
			$total = 0;
			$product = new model_product();

			?>
			<div class="h2 text-center"><?php echo $this->text['final']; ?></div>
			<form class="mt-5" method="POST">
				<div class="row">
					<!-- informations form -->
					<div class="col-md-7">
						<div class="h3 text-center mb-3"><?php echo $this->text['infos']; ?></div>
						<div class="form-group">
							<input class="form-control" type="text" name="nom" placeholder="<?php echo($this->text['name']) ?>" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="phone" placeholder="<?php echo($this->text['phone']) ?>" required>
						</div>
						<div class="row">
							<div class="col form-group">
								<select class="form-control wil1" name="wilaya" onchange="f1(this)" required>
									<option value="09" selected="selected">09-Blida</option>
								</select>
							</div>
							<div class="col form-group">
								<select class="form-control com1" name="commune" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="2" placeholder="<?php echo($this->text['address']) ?>" name="address" style="resize: none;" required></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="3" placeholder="<?php echo($this->text['obs']) ?>" name="obs" style="resize: none;"></textarea>
						</div>
					</div>
					<!-- panier -->
					<div class="col-md-4 border">
						<div class="h3 text-center mb-3"><?php echo $this->text['basket']; ?></div>
						<table class="table table-borderless">
							<thead>
								<tr>
									<th><?php echo $this->text['product']; ?></th>
									<th class="text-right"><?php echo $this->text['total']; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($data as $prod): ?>
									<?php 
										$info = $product->GetSingle($prod['id_prod']);
										$total += $info->prix * $prod['qte'];

									 ?>
									 <tr>
									 	<td><b><?php echo "x".$prod['qte']; ?> </b><?php echo $info->nom; ?></td>
									 	<td class="text-right"><?php echo $prod['qte']*$info->prix." DA"; ?></td>
									 </tr>
								<?php endforeach; ?>
								
								<tr>
									<td class="h3"><?php echo $this->text['total']; ?></td>
									<td class="text-right h3 text-primary"><?php echo $total." DA"; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="form-group">
							<button class="btn btn-primary btn-block"><?php echo $this->text['confirm']; ?></button>
						</div>
					</div>
				</div>
			</form>
			<script type="text/javascript">
				//wilaya1(9);
				commune11(9);
				function f1(x) {
					var strUser = x.options[x.selectedIndex].value;
					commune11(strUser);
				}
			</script>
			<?php
		}

		public function Basket()
		{

			// get the basket

			$basket = new model_basket();
			$data = $basket->GetAll();
			$total = 0;
			$product = new model_product();
			?>

	      	
		        <a class="nav-link dropdown-toggle text-muted pl-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fa fa-shopping-cart"></i>
		          <?php if($basket->Size() > 0): ?>
		          <span class="qty"><?php echo $basket->Size(); ?></span>
		          <?php endif; ?>
		        </a>
		        <div class="dropdown-menu dropdown-cart" aria-labelledby="navbarDropdown">
		          <div class="cart-products">
		          	<?php if($basket->Size() > 0): ?>
			         	<?php foreach($data as $prod): ?>
			          	<?php 
			          		$info = $product->GetWithImage($prod['id_prod']);
			          		$total += $info->prix * $prod['qte'];

			          	 ?>
			         	<div class="row">
				          	<div class="col-5">
					          	<img class="img-fluid" src="<?php echo(PUBLIC_URL.'img/'.$info->link) ?>">
				          	</div>
				          	<div class="col-6">
				          		<div class="h5"><?php echo $info->nom; ?></div>
				          		<div class="h6">Quantité: <?php echo $prod['qte']; ?></div>
				          		<div class="h6">Prix: <?php echo $info->prix." DA"; ?></div>
				         		<button class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($info->id_product) ?>">x</button>
				          	</div>
			          	</div>
			          	<div class="dropdown-divider"></div>
			          <?php endforeach; ?>
			          </div>
			          <div class="text-center bg-white py-2">
				          <div class="h5 text-center mt-2"><?php echo $this->text['total'].": ".$total." ".$this->text['da']; ?></div>
				          <a href="<?php echo(PUBLIC_URL.'checkout') ?>" class="btn btn-primary"><?php echo $this->text['final']; ?></a>
			          </div>
		          	<?php else: ?>
		          		<h4 class="text-center"><?php echo $this->text['empty']; ?></h4>
		          	</div>		          
		          	<?php endif; ?>
		          
		        </div>

			<?php
		}

		public function BasketModal()
		{
			?>

			<!-- delete modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->text['confirm']; ?></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <?php echo $this->text['remove']; ?>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->text['no']; ?></button>
			        <div>
			          <input type="number" name="id_prod" id="prod" hidden>
			          <button class="btn btn-primary" id="delete_panier"><?php echo $this->text['yes']; ?></button>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>

			<script type="text/javascript">
			  $('#exampleModalCenter').on('show.bs.modal', function (event) {
			    var button = $(event.relatedTarget) // Button that triggered the modal
			    var id = button.data('id') 
			    $('#prod').val(id);
			  });

			  $("#delete_panier").click(function() {
			  	var id = $('#prod').val();
			  	console.log(id);
			  	var url = '<?php echo(PUBLIC_URL."ajax/basketdelete/") ?>'+id;
			  	$.get(url, function(data){
			  	  if(data != 'error'){
			  	  	$(".mob").html(data);
			  	  	$(".desk").html(data);
			  	  	$("#exampleModalCenter").modal("hide");
			  	  }else{
			  	  	console.log('error');
			  	  }
			  	});
			  });

			</script>

			<?php
		}
		
		public function Done($fac)
		{
			?>

			<div class='container text-center'>
				<h2 class='mt-5'><?php echo $this->text['done']." $fac"; ?></h2>
				<a href="<?php echo(PUBLIC_URL) ?>" class="text-center btn btn-link mx-auto"><?php echo $this->text['rehome']; ?></a>
			</div>;

			<?php
		}

		public function Error()
		{
			?>

			<div class='container text-center'>
				<h2 class='mt-5'><?php echo $this->text['error']; ?></h2>
				<a href="<?php echo(PUBLIC_URL.'checkout') ?>" class="text-center btn btn-link mx-auto"><?php echo $this->text['retry']; ?></a>
			</div>

			<?php
		}

	}

 ?>