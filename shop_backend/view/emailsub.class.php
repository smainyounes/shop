<?php 

	/**
	 * 
	 */
	class view_emailsub
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
					return array("sub" => "Souscrire",
					 "subtxt" => "Abonnez-vous et recevez de nouveaux");
					break;
				case 'ar':
					return array("sub" => "الإشتراك",
					 "subtxt" => "اشترك واستقبل الجديد");
					break;

			}
		}
	
		public function PopupSub()
		{
			# code ...
		}

		public function Banner()
		{
			?>

			<div class="m-4 letter">
				<div class="container bg-soft-dark">
					<div class="row p-5">
						<div class="col-md-4 p-2">
							<div class="h3 text-white text-center"><?php echo $this->text['subtxt']; ?></div>
						</div>
						<div class="col-md-8">
							<form class="row" method="POST">
								  
								  <div class="col-md-8 p-2">
								  	<input type="email" name="mail_sub" class="form-control" placeholder="Exemple@boxdz.com" required>
								  </div>
								  <div class="col-md-4 p-2">
								  	<button class="btn btn-purp form-control"><?php echo $this->text['sub']; ?> <i class="far fa-envelope"></i></button>
								  </div>
								  
							</form>
						</div>
					</div>
				</div>
				
			</div>

			<?php
		}

		public function List($page)
		{
			$mod = new model_emailsub();

			$data = $mod->GetByPage($page);
			$total_emails = $mod->NombreEmails();

			$total_pages = ceil($total_emails / 10);

			?>

			<div class="h1 text-center">Emails</div>

			<?php if($data): ?>
				<table class="table table-hover table-responsive">
				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col" class="w-75">Email</th>
				      <th scope="col">Date</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($data as $email): ?>
					    <tr>
					      <th scope="row"><?php echo $email->id_email; ?></th>
					      <td><?php echo $email->email; ?></td>
					      <td><?php echo $email->date; ?></td>
					      <td>
					      	<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($email->id_email) ?>">Supprimer</button>
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
				  			<li class="page-item"><a class="page-link" href="<?php echo(PUBLIC_URL.'emailsub/list/'.$i) ?>"><?php echo $i; ?></a></li>
				  		<?php endif; ?>
				    
					<?php endfor; ?>
				  </ul>
				</nav>
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
				        are u sure u want to delete this Email?
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <form method="POST">
				          <input type="number" name="email" id="email" hidden>
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
				    $('#email').val(id);
				  });
				</script>

			<?php else: ?>
				<?php $this->Nothing(); ?>
			<?php endif; ?>
			

			<?php
		}

		private function Nothing()
		{
			?>
			<h2 class="mt-5 text-center">Aucun Email Trouvé</h2>
			<?php
		}

	}

 ?>