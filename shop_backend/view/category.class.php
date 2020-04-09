<?php 

	/**
	 * 
	 */
	class view_category
	{
		private $category;
		function __construct($msg)
		{
			$this->category = new model_category();
			$this->List($msg);
		}

		public function List($msg)
		{
			$data = $this->category->GetAll();
			?>

			<div class="h1 text-center animated fadeInUp font-weight-bold">Category List</div>
			<?php if (isset($msg)) {
				new view_alert($msg);
			} ?>
			<div class="btn btn-primary btn-lg btn-block m-2 animated fadeInUp" data-toggle="modal" data-target="#exampleModal">Ajouter</div>
			<table class="table mx-2 table-hover table-bordered animated fadeInUp">
			  <thead>
			    <tr>
			      <th scope="col">id</th>
			      <th scope="col">Nom Categorie</th>
			      <th scope="col">Supprimer</th>
			    </tr>
			  </thead>
			  <?php if($data): ?>
			  <tbody>
			  	<?php foreach($data as $categ): ?>
			      <tr>
			        <td><?php echo $categ->id_category; ?></td>
			        <td><?php echo ucwords($categ->nom_category); ?></td>
			        <td><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($categ->id_category) ?>">Supprimer</button></td>
			      </tr> 
			    <?php endforeach; ?>  
			  </tbody>
			  <?php endif; ?>
			</table>
			
			<!-- Adding Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Ajouter Categorie</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <form method="POST">
			        <div class="modal-body">
			            <div class="form-group">
			              <label for="exampleFormControlInput1">Nom Categorie</label>
			              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nom Categorie" name="category">
			            </div>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			          <button type="submit" type="button" class="btn btn-primary" name="newcateg">Ajouter</button>
			        </div>
			      </form>
			    </div>
			  </div>
			</div>

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
			        are u sure u want to delete this category?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			          <input type="number" name="categ" id="categ" hidden>
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
			    $('#categ').val(id);
			  });
			</script>
			
			<?php
		}
	}

 ?>