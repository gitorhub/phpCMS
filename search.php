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
          
            if(!isset($_POST['search_submit'])){
              echo '<div class="d-flex justify-content-center text-danger">
              <h3 class="text-danger text-center">There is no result about your search</h3>
            </div>';              
            }else{
              $search_word=$_POST['search_word'];
              if(empty($search_word)){
                echo '<div class="d-flex justify-content-center text-danger">
                <h3 class="text-danger text-center">You sould enter at least a word or a character :))</h3>
              </div>';  

              }else{
                $sql_search="SELECT * FROM posts WHERE post_tags LIKE '%$search_word%' ORDER BY post_id DESC";
                $sql_search_result=mysqli_query($conn, $sql_search);
                if(!$sql_search_result){
                  die('ERROR CONN:' . mysqli_connect_error());
                }
                while($posts=mysqli_fetch_assoc($sql_search_result)){?>

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

          <?php } 
             }
          } ?>


				</div>

			</main>


			<?php include("includes/sidebar.php") ?>



		</div>

	</div>
</section>

<?php include "includes/footer.php" ?>