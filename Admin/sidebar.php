<aside class="sidebar" aria-label="Sidebar navigation">
  <div class="brand" aria-label="Brand">
    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
    <h1>UTYCC Admin Panel</h1>
  </div>
  <nav id="nav">
    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php') ? 'active' : '' ?>" href="admin_dashboard.php">Students</a>
    <a class="nav-link" href="#">Courses</a>
    <a class="nav-link" href="#">Registrations</a>
    <a class="nav-link" href="#">Reports</a>
    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'settings.php') ? 'active' : '' ?>" href="settings.php">Settings</a>
  </nav>
</aside>
