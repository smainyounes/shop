<?php 

	/**
	 * 
	 */
	class view_alert
	{
		
		function __construct($msg)
		{
			if (is_bool($msg)) {
				$this->Alert($msg);
			}

			if (is_array($msg)) {
				$this->DetailError($msg);
			}
			
		}

		public function Alert($msg)
		{
			?>
			<?php if($msg): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php else: ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif; ?>
			<?php
		}

		public function DetailError($msg)
		{
			?>

			<?php if(empty($msg)): ?>
				<?php $this->Alert(true); ?>
			<?php else: ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?php foreach($msg as $img): ?>
				  <strong><?php echo $img['filename']; ?> , </strong> <?php echo $img['error']; ?> <br> <hr>
				  	<?php endforeach; ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif; ?>
			<?php
		}
	}

 ?>