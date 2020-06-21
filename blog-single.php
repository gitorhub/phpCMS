<?php include "includes/header.php"?>
<!-- Navigation -->
<?php include "includes/navbar.php" ?>

<!--==========================
    INSIDE HERO SECTION Section
============================-->
<section class="page-image page-image-contact md-padding">
	<h1 class="text-white text-center">BLOG</h1>
</section>

<!--==========================
    Contact Section
============================-->
<section id="blog" class="md-padding">
	<div class="container">
		<div class="row">
			<main id="main" class="col-md-8">

				<!-- get single post from database -->
				<?php 
				if(isset($_GET['single'])){
					$p_post_id=$_GET['single'];
					$post_hit="UPDATE posts SET post_hits=post_hits+1 WHERE post_id=$p_post_id ";
					$post_hit_result=mysqli_query($conn,$post_hit);



					$sql="SELECT * FROM posts WHERE post_id='$p_post_id'";
					$sql_result=mysqli_query($conn,$sql);
					$counter=1;
							while($posts=mysqli_fetch_assoc($sql_result)){
								$post_id=$posts["post_id"];
								$post_category=$posts["post_category"];          
								$post_title=$posts["post_title"];          
								$post_author=$posts["post_author"];          
								$post_date=$posts["post_date"];          
								$post_hits=$posts["post_hits"];          
								$post_image=$posts["post_image"];  
								$post_text=$posts["post_text"];
								$post_tags=$posts["post_tags"];

						}?>

				<div class="blog">
					<div class="blog-img">
						<img class="img-fluid" src="./img/<?php echo htmlspecialchars($post_image) ?>" alt="image">
					</div>
					<div class="blog-content">
						<ul class="blog-meta">
							<li><i class="fas fa-user"></i><?php echo htmlspecialchars($post_author) ?></li>
							<li><i class="fas fa-clock"></i><?php echo htmlspecialchars($post_date) ?></li>
							<li><i class="fas fa-eye"></i><?php echo htmlspecialchars($post_hits) ?></li>
						</ul>
						<h3><?php echo htmlspecialchars($post_title) ?></h3>
						<p><?php echo htmlspecialchars($post_text) ?></p>
					</div>

					<!-- <?php } ?> end of if -->

					<?php 
									$sql_get="SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status='approved'";
									$sql_get_result=mysqli_query($conn,$sql_get);
									$count_sql_result=mysqli_num_rows($sql_get_result);
									?>
					<!-- blog comments -->
					<div class="blog-comments">
						<h3>(<?php echo $count_sql_result ?>) Comments</h3>

						<?php 
			     	while($comments=mysqli_fetch_assoc($sql_get_result)) {?>
						<!-- comment -->
						<div class="media">
							<div class="media-body">
								<h4 class="media-heading"><?php echo htmlspecialchars($comments['comment_author']) ?> <span
										class="time text-muted text-small"><?php echo htmlspecialchars($comments['comment_date']) ?></span>
								</h4>
								<p><?php echo htmlspecialchars($comments['comment_text']) ?></p>
							</div>
						</div>
						<!-- /comment -->
						<?php } ?>
					</div>
					<!-- /blog comments -->

					<?php if(isset($_POST['submit_comment'])){
						$p_post_id=$_GET['single'];
						$comment_author=$_POST['comment_author'];
						$comment_email=$_POST['comment_email'];
						$comment_text=$_POST['comment_text'];
						$now=date(('Y-m-d'), time());

						$sql_add="INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_text, comment_status, comment_date)";
						$sql_add .="VALUES ('$p_post_id','$comment_author','$comment_email','$comment_text','unapproved','$now')";
						$sql_add_result=mysqli_query($conn,$sql_add);
						header("location:blog-single.php?single=$p_post_id");
					} ;?>





					<!-- reply form -->
					<div class="reply-form">
						<h3>Leave A Comment</h3>
						<form action="" method="POST" enctype="multipart/form-data">
							<input class="form-control mb-4" type="text" name="comment_author" placeholder="Name">
							<input class="form-control mb-4" type="email" name="comment_email" placeholder="Email">
							<textarea class="form-control mb-4" row="5" name="comment_text"
								placeholder="Add Your Commment"></textarea>

							<button type="submit" class="main-btn" name="submit_comment">Submit</button>
						</form>
					</div>
					<!-- /reply form -->
				</div>
			</main>
			<!-- /Main -->

			<?php include("includes/sidebar.php") ?>




		</div>

	</div>
</section>

<?php include "includes/footer.php" ?>