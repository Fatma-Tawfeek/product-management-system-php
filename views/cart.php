<?php include '../inc/header.php'; ?>
<?php include '../database/connection.php';?>
<?php 

$sql = "SELECT DISTINCT * FROM `product_cart` 
LEFT JOIN `products` ON product_cart.product_id = products.id
LEFT JOIN `carts` ON product_cart.cart_id = carts.id";
$result = mysqli_query($conn, $sql);

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
       
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <?php if($_SESSION['auth'][0] == $row['user_id']): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['cart_price'] ?></td>
                    <td><?= $row['cart_quantity'] ?></td>
                    <td>
                    <a href="../handlers/cart/delete.php?id=<?= $row["product_id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>
                    </td>
                </tr>      
                <?php endif;?>
                <?php endwhile;?>      
            </tbody>
        </table>
        <!-- Make button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Checkout
        </button>
    </div>
    </div>
 </div>


<?php include '../inc/footer.php'; ?>
