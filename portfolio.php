<?php include "includes/header.php"?>
<?php include "includes/db.php" ?>
				<!-- Navigation -->
			<?php include "includes/navbar.php" ?>

			<!--==========================
				INSIDE HERO SECTION Section
			============================-->	
			<section class="page-image page-image-portfolio md-padding">
				<h1 class="text-white text-center">PORTFOLIO</h1>
			</section>
				
			<!--==========================
				PORTFOLIO Section
			============================-->
			<section id="portfolio" class="md-padding">
				<div class="container">

						<div class="row text-center">
							<div class="col-md-4 offset-md-4">
								<div class="section-header">
									<h2 class="title">Our Works</h2>
								</div>
							</div>
						</div>
					<div class="row">

					<?php
					$sql="SELECT * FROM portfolios";
					$sql_result=mysqli_query($conn, $sql);
					while($portfolios=mysqli_fetch_assoc($sql_result)){
						$portfolio_name=$portfolios["portfolio_name"];
						$portfolio_category=$portfolios["portfolio_category"];
						$portfolio_img_sm=$portfolios["portfolio_img_sm"];
						$portfolio_img_bg=$portfolios["portfolio_img_bg"];			
					?>

						<div class="col-md-4 col-sm-6 portfolio-item">
							<a href="img/<?php echo $portfolio_img_bg ?>" class="portfolio-link" data-lightbox="web-design" data-title="Image/ <?php echo $portfolio_name ?>" >
								<div class="portfolio-hover">
									<div class="portfolio-hover-content">
										<i class="fas fa-search fa-3x"></i>
									</div>
								</div>
								<img class="img-fluid" src="img/<?php echo $portfolio_img_sm ?>" alt="img-thumb">
							</a>
							<div class="portfolio-caption">
								<h4><?php echo $portfolio_name ?></h4>
								<p class="text-muted"><?php echo $portfolio_category ?></p>
							</div>
						</div>

						<?php } ?>

					</div>
				</div>
			</section>

			<?php include "includes/footer.php" ?>