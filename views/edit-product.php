<?php 

require_once '../database/connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM `products` WHERE `id` = '$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

?>

<?php include '../inc/header.php'; ?>

<div class="container-fluid">
 <div class="row vh-100">

    <?php include '../inc/sidebar.php'; ?>

    <div class="col mt-5">
    <div class="card text-black">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit Product</p>

                <?php 
                if(isset($_SESSION['errors'])):
                  foreach($_SESSION['errors'] as $error): ?>
                      <div class="alert alert-danger text-center">
                        <?= $error; ?>
                      </div>
                  <?php                  
                endforeach;             
               unset($_SESSION['errors']);
              endif;   
                ?>                
                
                <form class="row g-3" id="edit" action="../handlers/products/update.php?id=<?= $id ?>" method="post">                           
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="inputEmail4" value="<?= $row['name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="inputPassword4" value="<?= $row['price'] ?>" >
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Category</label>
                        <select id="inputState" class="form-select" name="cat_id">
                        <?php
                        $sql_cat = "SELECT * from `categories`";
                        $result_cat = mysqli_query($conn, $sql_cat);
                        while($row_cat = mysqli_fetch_assoc($result_cat)): 
                        ?>
                        <option value="<?= $row_cat['cat_id']?>" <?= $row['category_id'] == $row_cat['cat_id'] ? 'selected' : ''; ?>><?=$row_cat['cat_name']?></option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="inputAddress" value="<?= $row['quantity'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control" id="inputAddress2" value="<?= html_entity_decode($row['brand']) ?>">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Edit" class="btn btn-primary">
                    </div>
                </form>
 
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?php include '../inc/footer.php'; ?>