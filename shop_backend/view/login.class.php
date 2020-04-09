<?php 

	/**
	 * 
	 */
	class view_login
	{
		
		function __construct()
		{
			$this->Login();
		}

		public function Login()
		{
			?>

			<div class="card mt-5 mx-auto animated fadeInUp" style="max-width: 400px;">
			       <article class="card-body">
			       <h4 class="card-title mb-4 mt-1">Sign in</h4>
			        	<form method="POST">
				           <div class="form-group">
				             <label>Username</label>
				               <input name="username" class="form-control" placeholder="Username" type="text" required>
				           </div> <!-- form-group// -->
				           <div class="form-group">
				             <label>Password</label>
				               <input class="form-control" placeholder="******" type="password" name="password" required>
				           </div> <!-- form-group// -->  
				           <div class="form-group">
				               <button class="btn btn-primary btn-block">Login</button>
				           </div> <!-- form-group// -->
				           <input type="text" name="token" value="<?php echo($_SESSION['token']) ?>" hidden>                                                           
			       		</form>
			       </article>
			</div> <!-- card.// -->

			<?php
		}
	}

 ?>