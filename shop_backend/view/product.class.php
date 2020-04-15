<?php 

	/**
	 * 
	 */
	class view_product
	{
		private $product;
		private $category;
		private $image;
		function __construct()
		{
			$this->product = new model_product();
			$this->category = new model_category();
			$this->image = new model_image();
		}

		private function ProductCard($product, $user = null)
		{
			?>

			<div class="card mx-2">
			  <a href="<?php echo(PUBLIC_URL.'product/detail/'.$product->id_product) ?>"><img class="card-img-top" src="<?php echo(PUBLIC_URL.'img/'.$product->link) ?>" alt="" width="300px" height="200px"></a>
			  <div class="card-body">
			    <h5 class="card-title">
			      <a href="<?php echo(PUBLIC_URL.'product/detail/'.$product->id_product) ?>">
			      	<?php echo shortenText($product->nom); ?>
			      </a>
			    </h5>
			    
			    <p class="card-text"><?php echo shortenText($product->infos) ?></p>
			  <?php if(isset($user)): ?>
			  <div class="float-right p-2">
			   <button class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($product->id_product) ?>">Delete</button>
			    <div class="btn-group m-1">
			    	<div class="dropdown">
			    	  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	    Edit
			    	  </a>

			    	  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    	    <a class="dropdown-item" href="#">Edit Infos</a>
			    	    <a class="dropdown-item" href="#">Edit images</a>
			    	  </div>
			    	</div>
			    </div>

			  </div>
			  <?php endif; ?>
			  </div>
			  <?php if($product->prix > 0): ?>
			  <div class="card-footer">
			    <h6 class="text-center"><?php echo "$product->prix DA"; ?></h6>
			  </div>
			  <?php endif; ?>
			</div>

			<?php
		}

		public function Latest()
		{
			$data = $this->product->Latest();
			?>
			<?php if($data): ?>
			<div class="h2 my-3 ml-2 animated fadeInUp">Latest</div>
			<div class="container animated fadeInUp">
			  <div class="autoplay">
			  	<?php foreach($data as $product){
			  		$this->ProductCard($product);
			  	} ?>
			  </div>
			</div>
			<?php endif; ?>
			<?php
		}

		public function LatestByCategory()
		{
			$categ = $this->category->GetAll();

			?>
			<?php if($categ): ?>
			<div class="m-4 category-img animated fadeInLeft">
			  <div class="container py-5 bg-soft-dark">
			    <div class="h1 text-center text-light">Nos Produit par Categorie</div>
			  </div>
			</div>

			<?php foreach($categ as $cat): ?>
				<?php $data = $this->product->GetLatestByCateg($cat->id_category); ?>
				<?php if($data): ?>

			<div class="h2 my-3 ml-2 animated fadeInUp"><?php echo ucwords($cat->nom_category); ?></div>
			<div class="container animated fadeInUp">
			  <div class="category">
			  	<?php foreach ($data as $product) { 
			  		$this->ProductCard($product);
			  	} ?>
			    <div class="mx-2 bg-white d-flex align-items-center justify-content-center">
			      <a href="<?php echo(PUBLIC_URL.'product/search/'.$cat->id_category) ?>" class="">
			        <i class="fas fa-3x fa-plus"></i>
			      </a>
			    </div>
			  </div>
			</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php
		}

		public function Search($categ, $keyword)
		{
			$data = $this->product->Search($categ, $keyword);
			?>
			<div class="h1 text-center animated fadeInUp font-weight-bold">Search</div>
			<?php if($data): ?>
			<div class="row animated fadeInUp">
				<?php foreach($data as $product): ?>
					<div class="col-lg-3 col-md-4 col-6 mb-4">
					<?php $this->ProductCard($product); ?>
					 </div>
				<?php endforeach; ?>
			</div>
			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>
			<?php
		}

		public function Detail($id_prod)
		{
			$data = $this->product->GetSingle($id_prod);
			$imgs = $this->image->GetImages($id_prod);

			?>
			<?php if($data): ?>
				<div class="row">
				  <div class="col-md-8 pl-4 animated fadeInLeft">
				    <div class="slider slider-for container">
				      <?php foreach($imgs as $img): ?>
				      <img src="<?php echo(PUBLIC_URL.'img/'.$img->link) ?>" class="img-fluid">
				  	  <?php endforeach; ?>
				    </div>
				    <div class="slider slider-nav container mt-4">
				      <?php foreach($imgs as $img): ?>
				      <img src="<?php echo(PUBLIC_URL.'img/'.$img->link) ?>" class="img-fluid mx-2">
				  	  <?php endforeach; ?>
				    </div>
				  </div>
				  <div class="col-md-4 animated fadeInRight">
				   <div class="h1 font-weight-bold"><?php echo $data->nom; ?></div>
				   <div class="h4">
				   	<?php echo "$data->infos"; ?>
				   </div>
				   <?php if($data->prix > 0): ?>
				   <div class="h2"><?php echo "$data->prix DA"; ?></div>
				   <?php endif; ?>

				   <form method="POST">
				     <div class="form-row">
				       <div class="col">
				         <input type="number" class="form-control" placeholder="Quantité" min="1">
				       </div>
				       <div class="col">
				         <button class="btn btn-primary">Ajouté</button>
				       </div>
				     </div>
				   </form>

				  </div>
				</div>
			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>


			<?php
		}

		public function Suggestion($id_categ)
		{
			$data = $this->product->GetLatestByCateg($id_categ);
			?>
			<?php if($data): ?>
			<div class="h2 my-3 ml-2 animated fadeInUp">Suggestion</div>
			<div class="container animated fadeInUp">
			  <div class="autoplay">
			  	<?php 

			  	foreach($data as $prod){
			  		$this->ProductCard($prod);
			  	}

			  	 ?>
			  </div>
			</div>
			<?php endif; ?>
			<?php
		}

		public function AddForm($msg)
		{

			$categs = $this->category->GetAll();

			?>

			<div class="h1 text-center animated fadeInUp font-weight-bold">Add Product</div>
			<?php if(isset($msg))
					new view_alert($msg);
			 ?>
			<!-- Form -->
			<form class="my-3 animated fadeInUp" method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nom du Produit</label>
			    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nom du Produit" name="nom" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Categorie</label>
			    <select class="form-control" id="exampleFormControlSelect1" name="id_categ" required>
			    	<?php foreach($categs as $categ): ?>
			      <option value="<?php echo($categ->id_category) ?>"><?php echo ucwords($categ->nom_category); ?></option>
			      	<?php endforeach; ?>

			    </select>
			  </div>
			  <div class="form-group">
			    <label>Prix (en DA)</label>
			    <input type="number" class="form-control" name="prix" placeholder="1200">
			  </div>
			  <div class="form-group custom-file">
			    <input type="file" class="custom-file-input" id="customFile" multiple="" name="imgprod[]" required>
			    <label class="custom-file-label" for="customFile">Images du Produit</label>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="infos" required></textarea>
			  </div>

			  <div class="form-group text-center">
			    <button class="btn btn-primary">Ajouter</button>
			  </div>
			</form>
			
			<?php
		}

		public function List()
		{
			$data = $this->product->GetAll();
			?>

			<div class="h1 text-center animated fadeInUp font-weight-bold">Product List</div>
			<a class="btn btn-primary btn-lg btn-block m-2 animated fadeInUp" href="<?php echo(PUBLIC_URL."product/add") ?>">Ajouter</a>
			<?php if($data): ?>
				<div class="row animated fadeInUp">
					<?php foreach($data as $prod): ?>
						<div class="col-lg-3 col-md-4 col-6 mb-4">
						<?php $this->ProductCard($prod, 1); ?>
						 </div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>
			
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
			        are u sure u want to delete this product?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			          <input type="number" name="prod" id="prod" hidden>
			          <button class="btn btn-primary">Yes</button>
			        </form>
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
			</script>

			<?php
		}

		public function Nothing()
		{
			?>

			<div class="h1 font-weight-bold text-center mt-5 mx-auto">No products Found</div>

			<?php
		}

	}

 ?>