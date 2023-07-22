<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <i class="fa-solid fa-store fa-xl me-2"></i>
      <span class="fs-4">PMS</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/index.php" class="nav-link link-dark <?= ($activePage == "index") ? 'active':''; ?>" aria-current="page">
        <i class="fa-solid fa-box me-2"></i>
          Products
        </a>
      </li>
      <li>
        <a href="/categories.php" class="nav-link link-dark <?= ($activePage == 'categories') ? 'active':''; ?>">
        <i class="fa-solid fa-table-list me-2"></i>
          Categories
        </a>
      </li>
      <li>
        <a href="/users.php" class="nav-link link-dark <?= ($activePage == 'users') ? 'active':''; ?>">
        <i class="fa-solid fa-users me-2"></i>
          Users
        </a>
      </li>
      <li>
        <a href="/cart.php" class="nav-link link-dark <?= ($activePage == 'cart') ? 'active':''; ?>">
        <i class="fa-solid fa-cart-shopping me-2"></i>
          My Cart
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-dark">
         <i class="fa-solid fa-truck-fast me-2"></i>
          orders
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
  </div>