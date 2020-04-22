<?php 

	/**
	 * 
	 */
	class view_basket
	{
		
		function __construct()
		{
			# code...
		}

		public function Checkout()
		{
			$basket = new model_basket();
			$data = $basket->GetAll();
			$total = 0;
			$product = new model_product();

			?>
			<div class="h2 text-center">Finaliser commande</div>
			<form class="mt-5" method="POST">
				<div class="row">
					<!-- informations form -->
					<div class="col-md-7">
						<div class="h3 text-center mb-3">Vos informtaion</div>
						<div class="form-group">
							<input class="form-control" type="text" name="nom" placeholder="Nom & Prenom" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="phone" placeholder="Telephone" required>
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
							<textarea class="form-control" rows="2" placeholder="Address" name="address" style="resize: none;" required></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="3" placeholder="Observation" name="obs" style="resize: none;"></textarea>
						</div>
					</div>
					<!-- panier -->
					<div class="col-md-4 border">
						<div class="h3 text-center mb-3">Panier</div>
						<table class="table table-borderless">
							<thead>
								<tr>
									<th>Produit</th>
									<th class="text-right">Total</th>
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
									<td class="h3">Total</td>
									<td class="text-right h3 text-primary"><?php echo $total." DA"; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="form-group">
							<button class="btn btn-primary btn-block">Confirmer</button>
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
		        <div class="dropdown-menu dropdown-menu-right dropdown-cart" aria-labelledby="navbarDropdown">
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
				          <div class="h5 text-center mt-2">Total : <?php echo $total." DA"; ?></div>
				          <a href="<?php echo(PUBLIC_URL.'checkout') ?>" class="btn btn-primary">Finaliser commande</a>
			          </div>
		          	<?php else: ?>
		          		<h4 class="text-center">Panier vide</h4>
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
			        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        Enlever du panier?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
			        <div>
			          <input type="number" name="id_prod" id="prod" hidden>
			          <button class="btn btn-primary" id="delete_panier">Oui</button>
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
	}

 ?>