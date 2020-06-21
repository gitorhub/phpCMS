<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_sidebar.php"; ?>


    <div id="content-wrapper">
        <div class="container-fluid">
            <h1>Welcome to Admin Page</h1>
            <hr>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Response</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql="SELECT * FROM comments";
                  $sql_result=mysqli_query($conn,$sql);
                  $k=1;
                  while($row=mysqli_fetch_assoc($sql_result)){
                    $comment_id=$row['comment_id'];
                    $comment_post_id=$row['comment_post_id'];
                    $comment_date=$row['comment_date'];
                    $comment_author=$row['comment_author'];
                    $comment_email=$row['comment_email'];
                    $comment_text=$row['comment_text'];
                    $comment_status=$row['comment_status'];                 
                  
                  ?>

                    <tr>
                        <td><?php echo htmlspecialchars($comment_id) ?></td>
                        <td><?php echo htmlspecialchars($comment_author) ?></td>
                        <td><?php echo htmlspecialchars($comment_email) ?></td>
                        <td><?php echo htmlspecialchars($comment_text) ?></td>
                        <td><?php echo htmlspecialchars($comment_date) ?></td>
                        <td><?php echo htmlspecialchars($comment_status) ?></td>
                        <?php 
                                        $sql_post="SELECT * FROM posts WHERE post_id='$comment_post_id'";
                                        $sql_post_result=mysqli_query($conn,$sql_post);
                                        while($post=mysqli_fetch_assoc($sql_post_result)){
                                            $post_id=$post['post_id'];
                                            $post_title=$post['post_title'];
                                        ?>

                        <td><?php echo $post_title; ?></td>
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#view_modal<?php echo $k;  ?>'>View</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='comments.php?delete=<?php echo $comment_id ?>'>Delete</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='comments.php?approved=<?php echo $comment_id ?>'>Approve</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='comments.php?unapproved=<?php echo $comment_id ?>'>Unapprove</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <div id="view_modal<?php echo $k; ?>" class="modal fade">
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
                                            <label for="comment_author">Comment Author</label>
                                            <input type="text" readonly class="form-control" name="comment_author" value="<?php echo $comment_author ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_email">Comment Email</label>
                                            <input type="text" readonly class="form-control" name="comment_email" value="<?php echo $comment_email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_text">Comment Text</label>
                                            <textarea class="form-control" readonly name="comment_text" id="" cols="20" rows="5"> <?php echo $comment_text ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_status">Comment Status</label>
                                            <input type="text" class="form-control" name="comment_status" value="<?php echo $comment_status ?>">
                                        </div>



                                        <div class="form-group">
                                            <label for="commented_post">Commented Post</label>
                                            <input type="text" readonly class="form-control" name="commented_post" value="<?php echo $post_title ?>">
                                        </div>
                                        <?php }; ?>
                                        <!-- <div class="form-group">
                                            <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
                                            <input type="submit" class="btn btn-primary" name="view_post" value="View Post">
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $k++;} ?>
                </tbody>
            </table>

            <?php 
            if(isset($_GET['approved'])){
                $a_comment_id=$_GET['approved'];
                $sql_approved="UPDATE comments SET comment_status='approved' WHERE comment_id=$a_comment_id";
                $sql_approved_result=mysqli_query($conn, $sql_approved);
                header("location:comments.php");
            }            
            if(isset($_GET['unapproved'])){
                $a_comment_id=$_GET['unapproved'];
                $sql_unapproved="UPDATE comments SET comment_status='unapproved' WHERE comment_id=$a_comment_id";
                $sql_unapproved_result=mysqli_query($conn, $sql_unapproved);
                header("location:comments.php");
            }  

            if(isset($_GET['delete'])){
                $comment_id=$_GET['delete'];
                $sql_del="DELETE FROM comments WHERE comment_id='$comment_id'";
                $sql_del_result=mysqli_query($conn, $sql_del);
                header("location:comments.php");
            }

            ?>

            <?php include "includes/admin_footer.php"; ?>