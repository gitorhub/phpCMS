<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <?php include "includes/admin_sidebar.php"; ?>


  <div id="content-wrapper">
    <div class="container-fluid">
      <h1>Welcome to Admin Page</h1>
      <hr>
      <div class="col-12 ">
      <a class='btn btn-success text-white font-weight-bold float-right m-1' data-toggle='modal' data-target='#add_modal'>Add Post</a>
      </div>

      <table class="table table-bordered">
        <thead class="text-white bg-success">
          <tr>
            <th>ID</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date</th>
            <th>Comments</th>
            <th>Image</th>
            <th>Text</th>
            <th>Tags</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php 


                  $sql="SELECT * FROM posts";
                  $sql_result=mysqli_query($conn,$sql);
                  $counter=1;
                  while($posts=mysqli_fetch_assoc($sql_result)){
                    $post_id=$posts["post_id"];
                    $post_category=$posts["post_category"];          
                    $post_title=$posts["post_title"];          
                    $post_author=$posts["post_author"];          
                    $post_date=$posts["post_date"];    
                    
                    $sql_get="SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved'";
                    $sql_get_result=mysqli_query($conn,$sql_get);
                    $count_sql_result=mysqli_num_rows($sql_get_result);

                    $post_comment_number=$count_sql_result;
                    $post_image=$posts["post_image"];  
                    $post_text=$posts["post_text"];
                    $post_tags=$posts["post_tags"];           
                    ?>

          <tr>
            <td><?php echo htmlspecialchars($post_id) ?></td>
            <td><?php echo htmlspecialchars($post_title) ?></td>
            <td><?php echo htmlspecialchars($post_category) ?></td>
            <td><?php echo htmlspecialchars($post_author) ?></td>
            <td><?php echo htmlspecialchars($post_date) ?></td>
            <td><?php echo htmlspecialchars($post_comment_number) ?></td>
            <td><img src="../img/<?php echo $post_image ?>" alt="img_from_data" style="width:70px; height:70px"></td>
            <td><?php echo substr(htmlspecialchars($post_text),0,70). '...' ?></td>
            <td><?php echo htmlspecialchars($post_tags) ?></td>
            <td>
              <div class='dropdown'>
                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton'
                  data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Actions
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                  <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal<?php echo $counter; ?>'
                    href='#'>Edit</a>
                  <div class='dropdown-divider'></div>
                  <a class='dropdown-item' href='posts.php?delete=<?php echo htmlspecialchars($post_id) ?>'>Delete</a>

                </div>
              </div>
            </td>
          </tr>
          <!-- edit Modal -->
          <div id="edit_modal<?php echo $counter; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Portfolio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="post_title">Post Title</label>
                      <input type="text" class="form-control" name="post_title" value="<?php echo $post_title;?>">
                    </div>
                    <div class="form-group">
                      <label for="post_category">Post Category</label>
                      <select name="post_category" class="custom-select">
                        <?php
                          $sql_cat="SELECT * FROM categories";
                          $sql_cat_result=mysqli_query($conn, $sql_cat);
                          while($cat=mysqli_fetch_assoc($sql_cat_result)){
                            $cat_name=$cat["category_name"];
                            if($cat_name==$post_category){ //öenli kısım 
                              echo "<option value='{$cat_name}' selected>{$cat_name}</option>";             
                            }else{
                              echo "<option value='{$cat_name}'>{$cat_name}</option>";
                            }
                          }; ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="post_author">Post Author</label>
                      <input type="text" class="form-control" name="post_author" value="<?php echo $post_author;?>">
                    </div>

                    <div class="form-group">
                      <img src="../img/<?php echo $post_image ?>" alt="img_from_data" style="width:80px; height:80px">
                      <input type="file" class="form-control" name="post_image" value="<?php echo $post_image;?>">
                    </div>
                    <div class="form-group">
                      <label for="post_tags">Post Tags</label>
                      <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags;?>">
                    </div>
                    <div class="form-group">
                      <label for="post_text">Post Text</label>
                      <textarea class="form-control" name="post_text" id="" cols="20"
                        rows="5"><?php echo $post_text;?></textarea>
                    </div>

                    <div class="form-group">
                      <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
                      <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php $counter++; } ?>
        </tbody>
      </table>



      <!-- add portfolio modal -->

      <div id="add_modal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="post_title">Post Title</label>
                  <input type="text" class="form-control" name="post_title">
                </div>
                <div class="form-group">
                  <label for="post_category">Post Category</label>
                  <select name="post_category" class="custom-select">
                    <?php
                      $sql_cat="SELECT * FROM categories";
                      $sql_cat_result=mysqli_query($conn, $sql_cat);
                      while($cat=mysqli_fetch_assoc($sql_cat_result)){
                        $cat_name=$cat["category_name"];
                          echo "<option value='{$cat_name}'>{$cat_name}</option>";
                      }; ?>
                  </select>

                </div>
                <div class="form-group">
                  <label for="post_author">Post Author</label>
                  <input type="text" class="form-control" name="post_author">
                </div>

                <div class="form-group">
                  <label for="post_image">Post Image</label>
                  <input type="file" class="form-control" name="post_image">
                </div>
                <div class="form-group">
                  <label for="post_tags">Post Tags</label>
                  <input type="text" class="form-control" name="post_tags">
                </div>
                <div class="form-group">
                  <label for="post_text">Post Text</label>
                  <textarea class="form-control" name="post_text" id="" cols="20" rows="5"></textarea>
                </div>

                <div class="form-group">
                  <input type="hidden" name="post_id" value="">
                  <input type="submit" class="btn btn-primary" name="add_post" value="Add Post">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- add portfolio php -->
      <?php 
            if(isset($_POST["add_post"])){
              $post_title=$_POST["post_title"];
              $post_category=$_POST["post_category"];
              $post_author=$_POST["post_author"];
              $post_date=date("y-m-d");
              $post_comment_number=8;
              $post_image=$_FILES["post_image"]["name"];
              $post_image_tmp=$_FILES["post_image"]["tmp_name"];

              move_uploaded_file($post_image_tmp, "../img/$post_image");
              $post_text=$_POST["post_text"];
              $post_tags=$_POST["post_tags"];

              $sql_add="INSERT INTO posts (post_title, post_category, post_author, post_date, post_comment_number, post_image, post_text, post_tags) VALUES ('$post_title', '$post_category', '$post_author', '$post_date', '$post_comment_number','$post_image','$post_text', '$post_tags')";
              $sql_add_result=mysqli_query($conn, $sql_add);
              header("location:posts.php");
            }            
            ?>
      <!-- edit modal php -->
      <?php
            if(isset($_POST["edit_post"])){
              $post_id=$_POST["post_id"];
              $post_title=$_POST["post_title"];
              $post_category=$_POST["post_category"];
              $post_author=$_POST["post_author"];
              $post_date=date("y-m-d");
              $post_comment_number=8;
              $post_image=$_FILES["post_image"]["name"];
              $post_image_tmp=$_FILES["post_image"]["tmp_name"];
              if(empty($post_image)){
                $sql_edit="SELECT * FROM posts WHERE post_id='$post_id'";
                $sql_edit_result=mysqli_query($conn, $sql_edit);
                while($row=mysqli_fetch_assoc($sql_edit_result)){
                $post_image=$row["post_image"];
                }
              }

              move_uploaded_file($post_image_tmp, "../img/$post_image");
              $post_text=$_POST["post_text"];
              $post_tags=$_POST["post_tags"];

              $sql_edit="UPDATE posts  SET post_title='$post_title', post_category='$post_category', post_author='$post_author', post_date='$post_date', post_comment_number='$post_comment_number', post_image='$post_image', post_text='$post_text', post_tags='$post_tags' WHERE post_id='$post_id'";
              $sql_edit_result=mysqli_query($conn, $sql_edit);
              header("location:posts.php");
            }
             ?>

      <!-- delete portfolio php -->
      <?php 
            if(isset($_GET["delete"])){
              $del_post=$_GET["delete"];

              //to delete the real image unlink();
              // $sql_del2="SELECT * FROM posts WHERE post_id='$del_post'";
              // $sql_del2_result=mysqli_query($conn, $sql_del2);
              // while($row=mysqli_fetch_assoc($sql_del2_result)){
              //   $post_image=$row['post_image'];
              // }
              // unlink("../img/$post_image");



              $sql_del="DELETE FROM posts WHERE post_id='$del_post'";
              $sql_del_result=mysqli_query($conn, $sql_del);
              header("location: posts.php");
            }
            ?>



      <?php include "includes/admin_footer.php"; ?>