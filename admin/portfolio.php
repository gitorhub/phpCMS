<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <?php include "includes/admin_sidebar.php"; ?>


  <div id="content-wrapper">
    <div class="container-fluid">
      <h1>Welcome to Admin Page</h1>
      <hr>

      <table class="table table-bordered">
        <thead class="text-white bg-info">
          <tr>
            <th>ID</th>
            <th>Portfolio Name</th>
            <th>Portfolio Category</th>
            <th>Small Image</th>
            <th>Big Image</th>
            <th>Add - Edit - Delete</th>
          </tr>
        </thead>
        <tbody>
          <!-- edit portfolio php -->
          <?php 
          if(isset($_POST["edit_portfolio"])){
            $portfolio_id=$_POST["portfolio_id"];
            $portfolio_name=$_POST["portfolio_name"];
            $portfolio_category=$_POST["portfolio_category"];
            $portfolio_img_sm=$_FILES["image"]["name"];
            $portfolio_img_sm_tmp=$_FILES["image"]["tmp_name"];
            $portfolio_img_bg=$_FILES["imagebg"]["name"];
            $portfolio_img_bg_tmp=$_FILES["imagebg"]["tmp_name"];

            if(empty( $portfolio_img_sm)){

              $sql_data="SELECT * FROM portfolios WHERE portfolio_id='$portfolio_id'";
              $sql_data_result=mysqli_query($conn, $sql_data);
              while($row=mysqli_fetch_array($sql_data_result)){
                $portfolio_img_sm=$row["portfolio_img_sm"];
              }
            }
            if(empty( $portfolio_img_bg)){
              $sql_data="SELECT * FROM portfolios WHERE portfolio_id='$portfolio_id'";
              $sql_data_result=mysqli_query($conn, $sql_data);

              while($row=mysqli_fetch_array($sql_data_result)){
                $portfolio_img_bg=$row["portfolio_img_bg"];
              }
            }
            move_uploaded_file($portfolio_img_sm_tmp, "../img/$portfolio_img_sm");
            move_uploaded_file($portfolio_img_bg_tmp, "../img/$portfolio_img_bg");
          $sql_edit="UPDATE portfolios SET portfolio_name='{$portfolio_name}', portfolio_category='{$portfolio_category}', portfolio_img_sm='{$portfolio_img_sm}', portfolio_img_bg='{$portfolio_img_bg}' WHERE portfolio_id='$portfolio_id'";
          $sql_edit_result=mysqli_query($conn, $sql_edit);
          header("location:portfolio.php");
          }          
          ?>

          <!-- add portfolio php -->
          <?php if(isset($_POST["add_portfolio"])){
            $portfolio_name=$_POST["portfolio_name"];
            $portfolio_category=$_POST["portfolio_category"];

            $portfolio_img_sm=$_FILES["image"]["name"];
            $portfolio_img_sm_tmp=$_FILES["image"]["tmp_name"];
            $portfolio_img_bg=$_FILES["imagebg"]["name"];
            $portfolio_img_bg_tmp=$_FILES["imagebg"]["tmp_name"];
            move_uploaded_file($portfolio_img_sm_tmp, "../img/$portfolio_img_sm");
            move_uploaded_file($portfolio_img_bg_tmp, "../img/$portfolio_img_bg");

            $sql="INSERT INTO portfolios (portfolio_name, portfolio_category, portfolio_img_sm, portfolio_img_bg)";
            $sql.="VALUES('$portfolio_name', '$portfolio_category', '$portfolio_img_sm','$portfolio_img_bg')";
            $sql_result=mysqli_query($conn, $sql);
            header("location:portfolio.php");
          }?>


          <?php 
                $sql="SELECT * FROM portfolios ORDER BY portfolio_id DESC";
                $sql_result=mysqli_query($conn, $sql);
                $counter=1;
                while($portfolios=mysqli_fetch_assoc($sql_result)){
                  $portfolio_id=$portfolios["portfolio_id"];
                  $portfolio_name=$portfolios["portfolio_name"];
                  $portfolio_category=$portfolios["portfolio_category"];
                  $portfolio_img_sm=$portfolios["portfolio_img_sm"];
                  $portfolio_img_bg=$portfolios["portfolio_img_bg"];

                ?>

          <tr>
            <td><?php echo $portfolio_id; ?></td>
            <td><?php echo $portfolio_name; ?></td>
            <td><?php echo $portfolio_category; ?></td>
            <td class="text-center"> <img src="../img/<?php echo $portfolio_img_sm;?>" alt="small"
                style="width:50px; height:50px;"></td>
            <td class="text-center"><img src="../img/<?php echo $portfolio_img_bg; ?>" alt="big"
                style="width:80px; height:80px;"></td>
            <td>
              <div class='dropdown'>
                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton'
                  data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Actions
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                  <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal<?php echo $counter ?>'
                    href='#'>Edit</a>
                  <div class='dropdown-divider'></div>
                  <a class='dropdown-item' href='portfolio.php?delete=<?php echo $portfolio_id ?>'>Delete</a>
                  <div class='dropdown-divider'></div>
                  <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                </div>
              </div>
            </td>
          </tr>
          <!-- end of portfolio table -->



          <!-- edit category modal -->
          <div id="edit_modal<?php echo $counter ?>" class="modal fade">
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
                      <label for="portfolio_name">Portfolio Name</label>
                      <input type="text" class="form-control" name="portfolio_name"
                        value="<?php echo $portfolio_name ?>">
                    </div>
                    <div class="form-group">
                      <label for="portfolio_category">Portfolio Category</label>
                      <select name="portfolio_category" class="custom-select">
                        <?php
                        $sql_cat="SELECT * FROM categories";
                        $sql_cat_result=mysqli_query($conn, $sql_cat);
                        while($cat=mysqli_fetch_assoc($sql_cat_result)){
                          $cat_name=$cat["category_name"];
                          if($cat_name==$portfolio_category){ //öenli kısım 
                            echo "<option value='{$cat_name}' selected>{$cat_name}</option>";             
                          }else{
                            echo "<option value='{$cat_name}'>{$cat_name}</option>";
                          }

                        }; ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <img src="../img/<?php echo $portfolio_img_sm; ?>" alt="small_img_edit" width="70">
                      <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group">
                      <img src="../img/<?php echo $portfolio_img_bg; ?>" alt="small_img_edit" width="90">
                      <input type="file" class="form-control" name="imagebg"> <!-- input value atamıyoruyz -->

                    </div>
                    <div class="form-group">
                      <input type="hidden" name="portfolio_id" value="<?php echo $portfolio_id ?>">
                      <input type="submit" class="btn btn-primary" name="edit_portfolio" value="Edit Portfolio">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php $counter++; } ?>
        </tbody>
      </table>

      <!-- add category modal -->
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
              <!-- enctype="multipart/form-data" yazmazsak almaz -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="portfolio_name">Product Name</label>
                  <input type="text" class="form-control" name="portfolio_name">
                </div>
                <div class="form-group">
                  <label for="portfolio_category">Portfolio Category</label>
                  <select class="custom-select" name="portfolio_category">
                    <?php 
                    $sql="SELECT * FROM categories";
                    $sql_result=mysqli_query($conn,$sql);
                    while($categories=mysqli_fetch_assoc($sql_result)){
                     ?>
                    <option value="<?php echo $categories["category_name"] ?>">
                      <?php echo $categories["category_name"] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="portfolio_image_sm">Small Image</label>
                  <input type="file" class="form-control" name="image">
                </div>

                <div class="form-group">
                  <label for="portfolio_image_bg">Big Image</label>
                  <input type="file" class="form-control" name="imagebg">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="add_portfolio" value="Add Portfolio">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- deleted portfolio php -->
      <?php 
      if(isset($_GET["delete"])){
        $deleted_portfolio=$_GET["delete"];
        $sql="DELETE FROM portfolios WHERE portfolio_id='$deleted_portfolio'";
        $sql_result=mysqli_query($conn, $sql);
        header("location:portfolio.php");

      }
      ?>


      <?php include "includes/admin_footer.php"; ?>