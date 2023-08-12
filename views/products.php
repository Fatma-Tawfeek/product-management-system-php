<?php include '../inc/header.php'; ?>
<?php include_once '../database/connection.php';

$sql = "SELECT * from `products` LEFT JOIN `categories` ON products.category_id = categories.cat_id";

$result = mysqli_query($conn, $sql);

?>
  
<div class="container-fluid"> 
 <div class="row vh-100">
    <?php include '../inc/sidebar.php'; ?>
    <?php 
    if (!isset($_SESSION['auth'])){
    header("Location: login.php");
    exit;
    }
    ?>
    
    <div class="col mt-5">
    <?php if($_SESSION['auth'][2] == 1): ?>
        <!-- ADD Product button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Product
        </button>
        <?php endif; ?>
      
        <!-- add product form -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- product add form -->
               <form class="row g-3" id="add" action="../handlers/products/store.php" method="post">
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Category</label>
                    <select id="inputState" class="form-select" name="cat_id">
                    <option selected>Choose...</option>
                    <?php
                    $sql_cat = "SELECT * from `categories`";
                    $result_cat = mysqli_query($conn, $sql_cat);
                     while($row_cat = mysqli_fetch_assoc($result_cat)): 
                     ?>
                    <option value="<?= $row_cat['cat_id']?>"><?=$row_cat['cat_name']?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="inputAddress">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" id="inputAddress2">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="add" class="btn btn-primary">Add</button>
            </div>
            </div>
        </div>
        </div>
   
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-center mt-5">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);                            
                ?>
            </div>
        <?php endif; ?>

        <?php 
                if(isset($_SESSION['errors'])):
                  foreach($_SESSION['errors'] as $error): ?>
                      <div class="alert alert-danger text-center mt-5">
                        <?= $error; ?>
                      </div>
                  <?php                  
                endforeach;             
               unset($_SESSION['errors']);
              endif;   
                ?>
       
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Brand</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['cat_name']; ?></td>
                <td><?= $row['price']; ?> EGP</td>
                <td><?= html_entity_decode($row['brand']); ?></td>
                <td><?= $row['quantity']; ?></td>
                <td>
                  
                    <!-- Edit Product button -->
                    <?php if($_SESSION['auth'][2] == 1): ?>
                    <a class="btn btn-info" href="edit-product.php?id=<?= $row["id"]; ?>"><i class="fa-solid fa-edit"></i> </a>

                    <a href="../handlers/products/delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>

                    <button class="btn btn-primary" form="cart" type="submit"><i class="fa-solid fa-cart-shopping"></i> Add to cart </button>

                    <?php else: ?>
                        <button class="btn btn-primary" form="cart" type="submit"><i class="fa-solid fa-cart-shopping"></i> Add to cart </button>
                    <?php endif ?>

                
                    <!-- add to cart form -->

                    <form action="../handlers/cart/store.php" method="post" id="cart">

                    <input type="number" name="qt" placeholder="Quantity" class="rounded mt-2" min="1">

                    <input type="hidden" name="product_id" value="<?= $row['id'];?>">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['auth'][0];?>">
                    <input type="hidden" name="price" value="<?= $row['price'];?>">
                    <input type="hidden" name="quantity" value="<?= $row['quantity'];?>">

                    </form>
                </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>
    </div>
 </div>


<?php include '../inc/footer.php'; ?>
