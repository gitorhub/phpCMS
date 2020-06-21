<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

  <?php include "includes/admin_sidebar.php"; ?>


  <div id="content-wrapper">
    <div class="container-fluid">
      <h1>Welcome to Admin Page</h1>
      <hr>

      <?php 
  if (isset($_POST["add_category"])){
    $category_name=$_POST["category_name"];


    if(empty($category_name)||$category_name==""){
      echo '<div class="alert alert-danger" role="alert">
      This field cannot be empty!
    </div>';
    }else{
      $sql_query="INSERT INTO categories(category_name) VALUE ('$category_name')";
      $sql_result_category=mysqli_query($conn, $sql_query);
      echo '<div class="alert alert-success" role="alert">
      Category is added saccesfully!
    </div>';

    }
  }

?>

      <table class="table table-bordered">
        <thead class="text-white bg-warning">
          <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Add - Edit - Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          // edit categorinin php kısmı
          if (isset($_POST["edit_category"])){
            $edited_cat_name=$_POST["category_namex"];
            $edited_cat_id=$_POST["category_id"];
            echo $edited_cat_id;
            $sql_edit="UPDATE categories SET category_name='$edited_cat_name' WHERE category_id='$edited_cat_id'";
            $sql_edit_result=mysqli_query($conn,$sql_edit);
            header("location:categories.php");

          }          
          ?>

          <?php 
          $sql="SELECT * FROM categories ORDER BY category_id DESC";
          // TERS ŞEKİLDE DİZ DEMEK

          $sql_result=mysqli_query($conn, $sql);
          $counter=1; //modal isismlerini artırmak için
          while($categories=mysqli_fetch_assoc($sql_result)) {
          $category_id=$categories["category_id"];
          $category_name=$categories["category_name"];
                echo "<tr>
          <td>{$category_id}</td>
          <td>$category_name</td>
          <td>
            <div class='dropdown'>
              <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton'
                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Actions
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$counter' href='#'>Edit</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' href='categories.php?delete={$category_id}'>Delete</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
              </div>
            </div>
          </td>
        </tr>";
        

          ?>

          <!-- edit modal -->
          <div id="edit_modal<?php echo $counter; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="categories.php" method="post">
                    <div class="form-group">
                      <input value="<?php if(isset($category_name)) {echo $category_name;}?>" type="text"
                        class="form-control" name="category_namex">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="category_id"
                        value="<?php  if(isset($category_id)) echo $category_id;?>">
                      <input type="submit" class="btn btn-primary" name="edit_category" value="Edit Category">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php $counter++;  } ?>

        </tbody>
      </table>


      <!-- Dont forget to put semicolon here -->
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
              <form action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="category_name">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="add_category" value="Add Category">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- delete category -->
      <?php 
      if (isset($_GET["delete"])){
        $del_cat_id=$_GET["delete"];
        $sql="DELETE FROM categories WHERE category_id=$del_cat_id";
        $sql_result=mysqli_query($conn, $sql);
        //buraya header koyalım ki sonucu görelim istedik
        header("location:categories.php");
      }
      ?>





      <?php include "includes/admin_footer.php"; ?>