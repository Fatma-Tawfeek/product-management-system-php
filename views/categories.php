<?php include '../inc/header.php'; ?>
<?php include '../database/connection.php';


$sql = "SELECT * from `categories`";

$result = mysqli_query($conn, $sql);

?>

<div class="container-fluid">
 <div class="row vh-100">
    <?php include '../inc/sidebar.php'; ?>

    <div class="col mt-5">
    <?php if($_SESSION['auth'][2] == 1): ?>
        <!-- ADD Category button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Category
        </button>
        <?php endif; ?>

        <!-- add Category form -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Category add form -->
               <form class="row g-3" id="add" action="../handlers/categories/store.php" method="post">
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputEmail4">
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
                <?php if($_SESSION['auth'][2] == 1): ?>
                <th scope="col">Actions</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                <td><?= $row['cat_id']; ?></td>
                <td><?= $row['cat_name']; ?></td>
                <?php if($_SESSION['auth'][2] == 1): ?>
                <td>
                  
                    <!-- Edit Category button -->
                    <a class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#editModal<?= $row["cat_id"]; ?>"><i class="fa-solid fa-edit"></i> </a>

                    <a href="../handlers/categories/delete.php?id=<?= $row["cat_id"]; ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> </a>
                </td>
                <?php endif; ?>
                </tr>

                <!-- edit Category form -->
                <div class="modal fade" id="editModal<?= $row["cat_id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Category edit form -->
                        <form class="row g-3" id="edit" action="../handlers/categories/update.php" method="post">

                        <input type="hidden" name="id" value="<?= $row['cat_id'];?>">
                           
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="inputEmail4" value="<?= $row['cat_name'] ?>">
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


<?php include '../inc/footer.php'; ?>
