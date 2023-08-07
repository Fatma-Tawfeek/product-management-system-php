<?php include '../inc/header.php'; ?>
<?php include '../database/connection.php';?>
<?php 

$sql = "SELECT `products`.`name`, `product_order`.`quantity`,`product_order`.`total`, `orders`.`status`, `orders`.`address`, `orders`.`payment_method`,`orders`.`date`, `orders`.`id`
FROM `products`
INNER JOIN `product_order`
ON `products`.`id` = `product_order`.`product_id` 
INNER JOIN `orders`
ON `product_order`.`order_id` = `orders`.`id`";

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
                <th scope="col">Order_ID</th>
                <th scope="col">Date</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Address</th>
                <th scope="col">Paymet Method</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                   
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td>
                        <?php
                         if($row['payment_method'] == 0){
                            echo '<p>Visa or Mastecard</p>';
                         } else {
                            echo '<p>Cash on delivery</p>';
                         }
                         ?>
                         </td>
                    <td>
                        <?php
                         if($row['status'] == '0' ){
                            echo '<span class="badge bg-warning text-dark">Pending</span>';
                         } elseif($row['status'] == '1' ) {
                            echo '<span class="badge bg-success">Delivered</span>';
                         } else {
                            echo '<span class="badge bg-danger">Cancelled</span>';
                         }
                         ?>
                    </td>
                </tr>      
              
                <?php endwhile;?>      
            </tbody>
        </table>
    </div>
    </div>
 </div>


<?php include '../inc/footer.php'; ?>
