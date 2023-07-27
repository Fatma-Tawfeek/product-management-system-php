<?php include '../inc/header.php'; ?>
<?php include '../database/connection.php';


$sql = "SELECT * from `users`";

$result = mysqli_query($conn, $sql);

?>

<div class="container-fluid">
 <div class="row vh-100">
    <?php include '../inc/sidebar.php'; ?>

    <div class="col mt-5">
        <!-- ADD Product button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add User
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
               <form class="row g-3" id="add" action="../handlers/users/store.php" method="post">
                <div class="col-12">
                    <label for="inputname4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputname4">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Phone</label>
                    <input type="number" name="phone" class="form-control" id="inputAddress2">
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Role</label>
                    <select id="inputState" class="form-select" name="role">
                    <option selected>Choose...</option>
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="inputAddress" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputAddress">
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
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <td scope="col">Role</td>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td><?php 
                if ($row['role'] == 1){
                    echo "Admin";
                } else {
                    echo "User";
                }                  
                 ?></td>
                <td>
                  
                    <!-- Edit Product button -->
                    <a class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#editModal<?= $row["id"]; ?>"><i class="fa-solid fa-edit"></i> </a>

                    <a href="../handlers/users/delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>

                                    <!-- edit product form -->
                <div class="modal fade" id="editModal<?= $row["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- product edit form -->
                        <form class="row g-3" id="edit" action="../handlers/users/update.php" method="post">

                        <input name="id" type="hidden" value="<?= $row['id'];?>">
                           
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="inputEmail4" value="<?= $row['name'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="inputAddress2" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputAddress2" value="<?= $row['email'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" id="inputPassword4" value="<?= $row['phone'] ?>" >
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Role</label>
                                <select id="inputState" class="form-select" name="role">
                                <option selected>Choose...</option>
                                <option value="0" <?= $row['role'] == 0 ? 'selected' : ''; ?>>User</option>
                                <option value="1" <?= $row['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputAddress" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="inputAddress">
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
                </td>
                </tr>



                <?php endwhile;?>
            </tbody>
        </table>
    </div>
    </div>
 </div>


<?php include '../inc/footer.php'; ?>
