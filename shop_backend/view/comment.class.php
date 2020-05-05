<?php 

	/**
	 * 
	 */
	class view_comment
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
					return array("review" => "Avis",
					 "comment" => "Laissez un avis",
					 "load" => "Charger plus",
					 "cancel" => "Annuler",
					 "save" => "Enregistrer",
					 "fullname" => "Nom Complet",
					 "comm" => "Commentaire ... max 200 caractère.",
					 "nothing" => "Il n'y a pas de commentaire");
					break;
				case 'ar':
					return array("review" => "أراء",
					 "comment" => "ترك التعليق",
					 "load" => "تحميل المزيد",
					 "cancel" => "الغاء",
					 "save" => "حفظ",
					 "fullname" => "الاسم الكامل",
					 "comm" => "تعليق ... 200 حرف كحد أقصى",
					 "nothing" => "لا يوجد اي تعليق");
					break;

			}
		}

		private function CommentCard($comment)
		{
			?>

			<p><?php echo $comment->comment; ?></p>
			<small class="text-muted"><?php echo $comment->username.", ".$comment->date; ?></small>
			<hr>

			<?php
		}

		public function Comments($id_product, $page)
		{
			$mod = new model_comment();
			$data = $mod->GetComments($id_product, $page);

			foreach ($data as $comment) {
				$this->CommentCard($comment);	
			}
			
		}

		public function wrap($id_product)
		{
			$mod = new model_comment();
			$data = $mod->GetComments($id_product, 1);

			?>
			<div>
				<div class="card card-outline-secondary my-4">
				  <div class="card-header">
				    <?php echo $this->text['review']; ?>
				    <button class="btn btn-success float-right" data-toggle="modal" data-target="#comment-modal"><?php echo $this->text['comment']; ?></button>
				  </div>
				  	<?php if($data): ?>
					  <div class="card-body" id="comment">
					  	<?php foreach($data as $comment): ?>
					  	<?php $this->CommentCard($comment); ?>
					  	<?php endforeach; ?>
					  </div>
					  <div class="card-footer">				    
				    	<button class="btn btn-success text-center" id="load" data-page="2"><?php echo $this->text['load']; ?></button>
					  </div>
					<?php else: ?>
						<?php $this->Nothing(); ?>
					<?php endif; ?>
				</div>
			</div>
			

			<script type="text/javascript">
				$("#load").click(function () {
					
					var page = $("#load").data('page');
					$("#load").data('page', page+1);

					var url = "<?php echo(PUBLIC_URL.'ajax/comment/'.$id_product.'/') ?>"+page;
					$.get(url, function(data){
					  if(data != 'error'){
					  	$("#comment").append(data);
					  	page++;
					  }else{
					  	console.log('error');
					  }
					});
				});

			</script>

			<?php

			$this->CommentModal();
		}

		public function CommentModal()
		{

			?>

			<!-- Modal -->
			<div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->text['comment']; ?></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <form method="POST">
			      	<div class="modal-body">
			      		<div class="h5 text-center"></div>
			      	  	<div class="form-group">
			      	  		<input class="form-control" type="text" name="username" required placeholder="<?php echo($this->text['fullname']) ?>">
			      	  	</div>
			      	  	<div class="form-group">
			      	  		<textarea maxlength="200" class="form-control" rows="3" name="comment" required placeholder="<?php echo($this->text['comm']) ?>"></textarea>
			      	  	</div>
			      	  	<input type="text" name="token" value="<?php echo($_SESSION['token']) ?>" hidden>
			      	</div>
			      	<div class="modal-footer">
			      	  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->text['cancel']; ?></button>
			      	  <button class="btn btn-primary"><?php echo $this->text['save']; ?></button>
			      	</div>
			      </form>

			    </div>
			  </div>
			</div>
			<?php
		}

		public function CommentList($id_product, $page)
		{
			$mod = new model_comment();
			$data = $mod->GetComments($id_product, $page);

			$total_comments = $mod->NombreComment($id_product);
			$total_pages = ceil($total_comments / 5);
			?>

			<div class="h2 text-center">List commentaires</div>

			<?php if($data): ?>
			
				<table class="table table-hover table-responsive">
				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Nom complet</th>
				      <th scope="col">Date</th>
				      <th scope="col" class="w-75">commentaire</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($data as $comment): ?>
				    <tr>
				      <th scope="row"><?php echo $comment->id_comment; ?></th>
				      <td><?php echo $comment->username; ?></td>
				      <td><?php echo $comment->date; ?></td>
				      <td><?php echo $comment->comment; ?></td>
				      <td>
				      	<button class="btn btn-danger" data-toggle="modal" data-target="#comment-delete" data-id="<?php echo($comment->id_comment) ?>">Supprimer</button>
				      </td>
				    </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>

				<?php if($total_pages > 1): ?>
				<nav aria-label="Page navigation example">
				  <ul class="pagination flex-wrap justify-content-center">
				  	<?php for($i = 1; $i <= $total_pages; $i++): ?>
				  		<?php if($i == $page): ?>
				  			<li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
				  		<?php else: ?>
				  			<li class="page-item"><a class="page-link" href="<?php echo(PUBLIC_URL.'product/comments/'.$id_product.'/'.$i) ?>"><?php echo $i; ?></a></li>
				  		<?php endif; ?>
				    
					<?php endfor; ?>
				  </ul>
				</nav>
				<?php endif; ?>

				<!-- delete modal -->
				<div class="modal fade" id="comment-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        Suppmrimer se commentaire?
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <form method="POST">
				          <input type="number" name="comment" id="comment" hidden>
				          <button class="btn btn-primary">Yes</button>
				        </form>
				      </div>
				    </div>
				  </div>
				</div>

				<script type="text/javascript">
				  $('#comment-delete').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget) // Button that triggered the modal
				    var id = button.data('id') 
				    $('#comment').val(id);
				  });
				</script>
			
			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>
			<?php
		}

		public function Nothing()
		{
			?>

			<div class="h3 text-center my-4"><?php echo $this->text['nothing']; ?></div>

			<?php
		}
	}

 ?>