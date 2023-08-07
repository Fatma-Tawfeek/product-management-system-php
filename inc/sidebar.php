<?php 
$activePage = basename($_SERVER['PHP_SELF'], ".php");

?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <i class="fa-solid fa-store fa-xl me-2"></i>
      <span class="fs-4">PMS</span>
    </a>
    <hr>
    <?php if($_SESSION['auth'] ?? ''): ?>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/views/products.php" class="nav-link link-dark <?= ($activePage == "products") ? 'active':''; ?>" aria-current="page">
        <i class="fa-solid fa-box me-2"></i>
          Products
        </a>
      </li>
      <li>
        <a href="/views/categories.php" class="nav-link link-dark <?= ($activePage == 'categories') ? 'active':''; ?>">
        <i class="fa-solid fa-table-list me-2"></i>
          Categories
        </a>
      </li>
      <?php if($_SESSION['auth'][2] == 1): ?>
      <li>
        <a href="/views/users.php" class="nav-link link-dark <?= ($activePage == 'users') ? 'active':''; ?>">
        <i class="fa-solid fa-users me-2"></i>
          Users
        </a>
      </li>
      <?php endif; ?>
      <li>
        <a href="/views/cart.php" class="nav-link link-dark <?= ($activePage == 'cart') ? 'active':''; ?>">
        <i class="fa-solid fa-cart-shopping me-2"></i>
          Cart
        </a>
      </li>
      <?php if($_SESSION['auth'][2] == 1): ?>
      <li>
        <a href="/views/orders.php" class="nav-link link-dark <?= ($activePage == 'orders') ? 'active':''; ?>">
         <i class="fa-solid fa-truck-fast me-2"></i>
          orders
        </a>
      </li>
      <?php endif; ?>
    </ul>
    <hr>
    <?php endif; ?>
    <?php if($_SESSION['auth'] ?? ''): ?>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?= $_SESSION['auth'][1]; ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
        <li><a class="dropdown-item" href="../handlers/auth/logout.php">Sign out</a></li>
      </ul>
    </div>
    <?php else: ?>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary" onclick="location.href='../views/login.php'" >Login</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='../views/register.php'" >Register</button>
      </div>
    <?php endif; ?>
  </div>