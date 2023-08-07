<?php include '../inc/header.php'; ?>
<?php include '../database/connection.php';?>
<?php 

$user_id = $_SESSION['auth'][0];

$sql = "SELECT `products`.`id`, `products`.`name`, `product_cart`.`quantity`, `product_cart`.`total`
FROM `products`
INNER JOIN (SELECT * FROM `product_cart` WHERE `cart_id` = (SELECT `id` FROM `carts` WHERE `user_id` = $user_id AND `status` = '0')) AS product_cart
ON `products`.`id` = `product_cart`.`product_id` ";

$data = mysqli_query($conn, $sql);

?>

<div class="container-fluid">
 <div class="row vh-100">
    <?php include '../inc/sidebar.php'; ?>

    <div class="col mt-5">
   
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
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($data)): ?>
                    
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['total'] ?></td>        
                    <td>
                    <a href="../handlers/cart/delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>
                    </td>
                </tr>                      
                <?php endwhile;?>     
                <td>total price:
                    <?php
                    $query = "SELECT SUM(`product_cart`.`total`) AS total
                    FROM `products`
                    INNER JOIN (SELECT * FROM `product_cart` WHERE `cart_id` = (SELECT `id` FROM `carts` WHERE `user_id` = $user_id AND `status` = '0')) AS product_cart
                    ON `products`.`id` = `product_cart`.`product_id` 
                    GROUP BY `products`.`id`";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total'] ?? '';
                    ?>
                    EGP
                </td>
            </tbody>
        </table>
        <!-- Make button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">
        Checkout
        </button>

        <!-- checkout form -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- checkout form -->
                <form class="row g-3" id="edit" action="../handlers/orders/store.php" method="post">

                <input type="hidden" name="user_id" value="<?= $user_id;?>">

                <?php
                $sql = "SELECT `products`.`id`, `products`.`name`, `products`.`price`, `product_cart`.`quantity`, `product_cart`.`total`
                FROM `products`
                INNER JOIN (SELECT * FROM `product_cart` WHERE `cart_id` = (SELECT `id` FROM `carts` WHERE `user_id` = $user_id AND `status` = '0')) AS product_cart
                ON `products`.`id` = `product_cart`.`product_id` ";
                
                $data = mysqli_query($conn, $sql);
                
                $products = mysqli_fetch_all($data);
                ?>

                <input type="hidden" name="products" value="<?php echo htmlspecialchars(serialize($products));?>">
                    
                    <div class="col-12">
                        <label for="input1" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="input1" required>
                    </div>

                    <div class="col-md-12">
                        <label for="inputState" class="form-label">Payment Method</label>
                        <select id="inputState" class="form-select" name="payment_method" required>
                        <option value="">Choose...</option>
                        <option value="0">Visa or Mastecard</option>
                        <option value="1">Cash on delivery</option>
                        </select>
                    </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="edit" class="btn btn-primary">DONE</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                    
                </div>
                </div>
            </div>
         </div>
    </div>
    </div>
 </div>


<?php include '../inc/footer.php'; ?>
