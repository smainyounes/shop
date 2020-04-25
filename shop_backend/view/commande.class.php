<?php 

	/**
	 * 
	 */
	class view_commande
	{
		
		function __construct()
		{
			# code...
		}

		public function Head($filter)
		{
			?>

			<div class="h1 text-center">Commandes</div>
			<ul class="nav nav-pills nav-justified my-3">
				<li class="nav-item">
				  <a class="nav-link <?php if(!strcmp($filter, 'tout')) echo('active'); ?>" href="<?php echo(PUBLIC_URL.'commande/list/tout') ?>">Tout</a>
				</li>
				<li class="nav-item ">
				  <a class="nav-link <?php if(!strcmp($filter, 'encours')) echo('active'); ?>" href="<?php echo(PUBLIC_URL.'commande/list/encours') ?>">En cours</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link <?php if(!strcmp($filter, 'encharge')) echo('active'); ?>" href="<?php echo(PUBLIC_URL.'commande/list/encharge') ?>">Pris en charge</a>
				</li>
				<li class="nav-item ">
				  <a class="nav-link <?php if(!strcmp($filter, 'annuler')) echo('active'); ?>" href="<?php echo(PUBLIC_URL.'commande/list/annuler') ?>">Annuler</a>
				</li>
				<li class="nav-item ">
				  <a class="nav-link <?php if(!strcmp($filter, 'delivrer')) echo('active'); ?>" href="<?php echo(PUBLIC_URL.'commande/list/delivrer') ?>">Delivrer</a>
				</li>
			</ul>

			<?php
		}

		public function List($filter, $page)
		{
			$this->Head($filter);

			$mod = new model_commande();
			if ($filter != "tout") {
				$data = $mod->Filter($filter, $page);
				$total_commande = $mod->Nombre($filter);
			}else{
				$data = $mod->GetAll($page);
				$total_commande = $mod->Nombre();
			}

			$total_pages = ceil($total_commande / 10);

			?>

			<table class="table table-hover table-responsive">
			  <thead>
			    <tr>
			      <th scope="col">Numero commande</th>
			      <th scope="col">Nom Complet</th>
			      <th scope="col">Date</th>
			      <th scope="col" class="w-100">Obesrvation</th>
			      <th scope="col">Etat</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($data as $cmd): ?>
			    <tr>
			      <th scope="row"><?php echo $cmd->id_commande; ?></th>
			      <td><?php echo $cmd->nom_complet; ?></td>
			      <td><?php echo date('d/m/Y', strtotime($cmd->date)); ?></td>
			      <td><?php echo $cmd->observation; ?></td>
			      <?php 
			      		switch ($cmd->etat) {
			      			case 'annuler':
			      				echo "<td class='bg-danger'>Annuler</td>";
			      				break;
			      			case 'delivrer':
			      				echo "<td class='bg-success'>Delivrer</td>";
			      				break;
			      			case 'encharge':
			      				echo "<td class='bg-warning'>Pris En charge</td>";
			      				break;
			      			case 'encours':
			      				echo "<td class='bg-primary'>En cours</td>";
			      				break;
			      		}

			       ?>
			      <td>
			      	<a href="<?php echo(PUBLIC_URL.'commande/detail/'.$cmd->id_commande) ?>" class="btn btn-primary">Detail</a>
			      </td>
			    </tr>
			  	<?php endforeach; ?>
			  </tbody>
			</table>
			<?php if($total_pages > 1): ?>
			<nav aria-label="Page navigation example">
			  <ul class="pagination justify-content-center">
			  	<?php for($i = 1; $i < $total_pages; $i++): ?>
			  		<?php if($i == $page): ?>
			  			<li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
			  		<?php else: ?>
			  			<li class="page-item"><a class="page-link" href="<?php echo(PUBLIC_URL.'commande/'.$filter.'/'.$i) ?>"><?php echo $i; ?></a></li>
			  		<?php endif; ?>
			    
				<?php endfor; ?>
			  </ul>
			</nav>
			<?php endif; ?>

			<?php
		}

		public function Detail($id_commande)
		{
			$mod = new model_commande();
			$data = $mod->Detail($id_commande);

			$products = $mod->Products($id_commande);
			$total = 0;
			?>
			<?php if($data): ?>
			<div class="h2 text-center">Facture : <?php echo $data->id_commande; ?></div>
			<form class="container" method="POST">
				<div class="row">
					<div class="col">
						<div class="form-group">
						    <select class="form-control" id="exampleFormControlSelect1" name="etat">
						      <option value="encours" <?php if(!strcmp($data->etat, "encours")) echo "selected"; ?>>En cours</option>
						      <option value="encharge" <?php if(!strcmp($data->etat, "encharge")) echo "selected"; ?>>Pris en charge</option>
						      <option value="delivrer" <?php if(!strcmp($data->etat, "delivrer")) echo "selected"; ?>>Delivrer</option>
						      <option value="annuler" <?php if(!strcmp($data->etat, "annuler")) echo "selected"; ?>>Annuler</option>
						    </select>
						</div>
					</div>
					<div class="col">
						<button class="btn btn-primary">Changer</button>
					</div>
					<div class="col">
						<button class="btn btn-primary" onclick='printDiv();'>Imprimer</button>
					</div>
				</div>

			</form>
			
			<div class="row" id="printDiv">
				<div class="col-md-7">
					<div class="h4">Date: <?php echo $data->date; ?></div>
					<table class="table table-hover table-responsive">
						<thead>
							<tr>
								<th scope="col">numero produit</th>
								<th scope="col">Nom produit</th>
								<th scope="col">Quantité</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($products as $prod): ?>
							<tr>
								<td><?php echo $prod->id_product; ?></td>
								<td><?php echo $prod->nom; ?></td>
								<td><?php echo $prod->quantity; ?></td>
								<td><?php echo $prod->prix; ?></td>
							</tr>
							<?php $total += $prod->prix * $prod->quantity; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				
					<div class="h4">Total: <?php echo $total; ?> DA</div>
					<div class="h6">Facture : <?php echo $data->id_commande; ?></div>
				</div>
			
				<div class="col-md-5">
					<div class="h4">Information</div>
					<table class="table table-borderless">
						<tr>
							<th>Nom complet: </th>
							<td><?php echo $data->nom_complet; ?></td>
						</tr>
						<tr>
							<th>Wilaya et commune </th>
							<td><?php echo $data->wilaya.", ".$data->commune; ?></td>
						</tr>
						<tr>
							<th>Address </th>
							<td><?php echo $data->address; ?></td>
						</tr>
						<tr>
							<th>Telephone</th>
							<td><?php echo $data->phone; ?></td>
						</tr>
						<tr>
							<th>Observation</th>
							<td><?php echo $data->observation; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<script type="text/javascript">
				function printDiv() 
				{

				  var printContents = document.getElementById('printDiv').innerHTML;
				       var originalContents = document.body.innerHTML;
				       document.body.innerHTML = printContents;
				       window.print();
				       document.body.innerHTML = originalContents;

				}

			</script>
			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>
			<?php
		}

		public function Nothing()
		{
			?>

			<h2 class="mt-5 text-center">Commande Exist pas</h2>

			<?php
		}

	}

 ?>