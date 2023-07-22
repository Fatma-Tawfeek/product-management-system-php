<?php include 'inc/header.php'; ?>
<?php include 'database/database.php';


$sql = "SELECT * from `products` LEFT JOIN `categories` ON products.category_id = categories.cat_id";

$result = mysqli_query($conn, $sql);

?>

<div class="container-fluid">
 <div class="row vh-100">
    <?php include 'inc/sidebar.php'; ?>

    <div class="col mt-5">
        <!-- ADD Product button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Product
        </button>

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
               <form class="row g-3" id="add" action="handlers/products/store.php" method="post">
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
                    <label for="inputAddress" class="form-label">Color</label>
                    <input type="text" name="color" class="form-control" id="inputAddress">
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
       
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Brand</th>
                <th scope="col">Color</th>
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
                <td><?= $row['color']; ?></td>
                <td>
                  
                    <!-- Edit Product button -->
                    <a class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#editModal<?= $row["id"]; ?>"><i class="fa-solid fa-edit"></i> </a>

                    <a href="handlers/products/delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>
                </td>
                </tr>

                <!-- edit product form -->
                <div class="modal fade" id="editModal<?= $row["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- product edit form -->
                        <form class="row g-3" id="edit" action="handlers/products/update.php" method="post">

                        <input type="hidden" name="id" value="<?= $row['id'];?>">
                           
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
                                <label for="inputAddress" class="form-label">Color</label>
                                <input type="text" name="color" class="form-control" id="inputAddress" value="<?= $row['color'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress2" class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control" id="inputAddress2" value="<?= html_entity_decode($row['brand']) ?>">
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="edit" class="btn btn-primary">Edit</button>
                        </div>
                        </div>
                    </div>
                    </div>

                <?php endwhile;?>
            </tbody>
        </table>
    </div>
    </div>
 </div>


<?php include 'inc/footer.php'; ?>
