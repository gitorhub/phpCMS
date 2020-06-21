<?php include "includes/header.php"?>
<!-- Navigation -->
<?php include "includes/navbar.php" ?>

<!--==========================
    INSIDE HERO SECTION Section
============================-->
<section class="page-image page-image-blog md-padding">
	<h1 class="text-white text-center">BLOG</h1>
</section>

<!--==========================
    Contact Section
============================-->
<section id="blog" class="md-padding">
	<div class="container">
		<div class="row">
			<main id="main" class="col-md-8">

				<div class="row">


          <?php
          if(isset($_GET['category'])){
            $get_category_name=$_GET['category'];
            $sql="SELECT * FROM posts WHERE post_category='$get_category_name'";
            $sql_result=mysqli_query($conn,$sql);}
          
          while($posts=mysqli_fetch_assoc($sql_result)){?>
					<div class="col-md-6">
						<div class="blog">
							<div class="blog-img">
								<img src="img/<?php echo htmlspecialchars($posts["post_image"]) ?>" class="img-fluid">
							</div>
							<div class="blog-content">
								<ul class="blog-meta">
									<li><i class="fas fa-users"></i><span
											class="writer"><?php echo htmlspecialchars($posts["post_author"]) ?></span></li>
									<li><i class="fas fa-clock"></i><span
											class="writer"><?php echo htmlspecialchars($posts["post_date"]) ?></span></li>
									<li><i class="fas fa-comments"></i><span
											class="writer"><?php echo htmlspecialchars($posts["post_comment_number"]) ?></span></li>
								</ul>
								<h3><?php echo ucfirst(htmlspecialchars($posts["post_title"])) ?></h3>
								<!-- ucfirst strtoupper -->
								<p><?php echo substr(htmlspecialchars($posts["post_text"]),0,100) ?></p>
								<a href="blog-single.php?single=<?php echo htmlspecialchars($posts['post_id']) ?>">Read More</a>
							</div>
						</div>
					</div>

					<?php } ?>


				</div>
				<div class="row justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">Previous</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">Next</a>
							</li>
						</ul>
					</nav>

				</div>
			</main>


			<?php include("includes/sidebar.php") ?>



		</div>

	</div>
</section>

<?php include "includes/footer.php" ?>