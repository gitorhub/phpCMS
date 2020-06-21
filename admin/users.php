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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql="SELECT * FROM users";
                  $sql_result=mysqli_query($conn,$sql);
                  $k=1;
                  while($users=mysqli_fetch_assoc($sql_result)){
                    $user_name=$users['user_name'];
                    $user_email=$users['user_email'];
                    $user_password=$users['user_password'];
                    $user_role=$users['user_role'];
                    $user_id=$users['user_id'];?>

                    <tr>
                        <td><?php echo htmlspecialchars($user_id) ?></td>
                        <td><?php echo htmlspecialchars($user_name) ?></td>
                        <td><?php echo htmlspecialchars($user_email) ?></td>
                        <td><?php echo htmlspecialchars($user_password) ?></td>
                        <td><?php echo htmlspecialchars($user_role) ?></td>
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal<?php echo $k ?>' >Edit</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='users.php?delete=<?php echo htmlspecialchars($user_id) ?>'>Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <div id="edit_modal<?php echo $k ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" class="form-control" name="user_name" value="<?php echo htmlspecialchars($user_name) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="email" class="form-control" name="user_email" value="<?php echo htmlspecialchars($user_email) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">User Password</label>
                                            <input type="password" class="form-control" name="user_password" value="<?php echo htmlspecialchars($user_password) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_role">User Role</label>
                                            <div class="form-group">
                                              <select id="my-select" class="form-control" name="user_role" >
                                                <option <?php if($user_role=="Admin")echo "selected"; ?>>Admin</option>
                                                <option <?php if($user_role=="Subscriber")echo "selected"; ?>>Subscriber</option>
                                                <option <?php if($user_role=="Editor")echo "selected"; ?>>Editor</option>
                                              </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id) ?>">
                                            <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php  $k++;} ?>
                </tbody>
            </table>

            <a class='btn btn-success text-white' data-toggle='modal' data-target='#add_modal'>Add</a>
            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" class="form-control" name="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="email" class="form-control" name="user_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">User Password</label>
                                            <input type="password" class="form-control" name="user_password">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_role">User Role</label>
                                            <div class="form-group">
                                              <select id="my-select" class="form-control" name="user_role">
                                                <option>Admin</option>
                                                <option>Subscriber</option>
                                                <option>Editor</option>
                                              </select>
                                            </div>
                                        </div>

                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- delete user php -->
            <?php if(isset($_GET['delete'])){
              $user_id_del=$_GET['delete'];
              $sql_del="DELETE FROM users WHERE user_id=$user_id_del";
              $sql_del_result=mysqli_query($conn, $sql_del);
              header("location:users.php");
            } ?>

            <!-- add user php -->
            <?php if(isset($_POST["add_user"])){
              $user_name=$_POST['user_name'];
              $user_email=$_POST['user_email'];
              $user_password=$_POST['user_password'];
              $user_role=$_POST['user_role'];


              $sql_add="INSERT INTO users (user_name,user_email, user_password,user_role) VALUES ('$user_name', '$user_email','$user_password','$user_role')";
              $sql_add_result=mysqli_query($conn,$sql_add);
              header("location:users.php");
            } ?>

            <!-- user edit php -->

            <?php 
            if(isset($_POST["edit_user"])){
              $user_name=$_POST['user_name'];
              $user_email=$_POST['user_email'];
              $user_password=$_POST['user_password'];
              $user_role=$_POST['user_role'];
              $user_id=$_POST['user_id'];

              $sql_edit="UPDATE users SET user_name='$user_name', user_email='$user_email',user_password='$user_password', user_role='$user_role'  WHERE user_id=$user_id";
              $sql_edit_result=mysqli_query($conn, $sql_edit);
              header("location:users.php");


            }


            
            
            ?>



            <?php include "includes/admin_footer.php"; ?>