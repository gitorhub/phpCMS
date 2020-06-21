<?php 
$sql="SELECT * FROM categories";

$sql_result=mysqli_query($conn, $sql);

$categories=mysqli_fetch_all($sql_result, MYSQLI_ASSOC);
?>
			

<aside id="aside" class="col-md-4">

	<div class="widget">
		<div class="widget-search">
			<form action="./search.php" method="post">
			<input class="search-input form-control" type="text" placeholder="Search" name="search_word">
			<button class="search-btn" type="submit" name="search_submit"><i class="fas fa-search" ></i></button>
			</form>
		</div>
	</div>
	<!-- /Search -->

	<!-- Category -->
	<div class="widget">
		<h3 class="mb-3">Categories</h3>
		<div class="widget-category">
	

			<?php foreach($categories as $category){
				
				$cat_name=$category['category_name']; 
		
			 $sql_number="SELECT * FROM posts WHERE post_category='$cat_name'";
			 $sql_number_result=mysqli_query($conn, $sql_number);
			 $count_sql_number=mysqli_num_rows($sql_number_result);
			 ?>
				<a href="categories.php?category=<?php echo htmlspecialchars($category['category_name']) ?>"><?php echo $category["category_name"]?><span>(<?php echo htmlspecialchars($count_sql_number); ?>)</span></a>			

<?php }?>
			


		</div>

	</div>
	<!-- /Category -->

	<!-- Posts sidebar -->
	<div class="widget">
		<h3 class="mb-3">Latest Posts</h3>

		<!-- single post -->
		<div class="widget-post">
			<a href="#">
				<img class="img-fluid" src="./img/post1.jpg" alt="">Lorem Ipsum
			</a>
			<ul class="blog-meta">
				<li>Oct 18, 2017</li>
			</ul>
		</div>
		<!-- /single post -->

		<!-- single post -->
		<div class="widget-post">
			<a href="#">
				<img src="./img/post2.jpg" alt="">Lorem Ipsum
			</a>
			<ul class="blog-meta">
				<li>Oct 18, 2017</li>
			</ul>
		</div>
		<!-- /single post -->


		<!-- single post -->
		<div class="widget-post">
			<a href="#">
				<img src="./img/post3.jpg" alt="">Lorem Ipsum
			</a>
			<ul class="blog-meta">
				<li>Oct 18, 2017</li>
			</ul>
		</div>
		<!-- /single post -->

	</div>
	<!-- /Posts sidebar -->

</aside>