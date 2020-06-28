<?php 

	/**
	 * 
	 */
	class view_carousel
	{
		
		function __construct()
		{
			# code...
		}

		public function HomeCarousel()
		{
			$mod = new model_category();
			$data = $mod->GetAll();
			?>
			<div class="row my-4">
				<div class="col-md-4 my-2">
					<div class="list-group" style="max-height: 300px; overflow: auto;">
						<?php foreach($data as $categ): ?>
						<a class="list-group-item font-weight-bold py-2" href="<?php echo(PUBLIC_URL.'product/search/1/'.$categ->id_category) ?>"><?php echo $categ->nom_category; ?></a>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-md-8 my-2" id="carousel">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="<?php echo(PUBLIC_URL.'img/carousel2.png') ?>" alt="First slide">
					    </div>
					    <div class="carousel-item">
					          <img class="d-block w-100" src="<?php echo(PUBLIC_URL.'img/ban.jpg') ?>" alt="Second slide">
					        </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
			

			<?php
		}
	}

 ?>