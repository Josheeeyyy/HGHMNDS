<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<link rel="stylesheet" href="css/navbar.css?v=<?= time(); ?>">

<!-- Smooth scrolling behavior -->
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container position-relative w-100">

        <!-- Logo on the left -->
        <a class="navbar-brand" href="index.php">
            <img src="images/hghmnds.jpg" alt="Logo">
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Centered nav links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-center d-flex align-items-center" style="gap: 0.5rem;">
                <li class="nav-item"><a class="nav-link px-2" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="index.php#shirts-section">SHIRTS</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="index.php#bottoms-section">BOTTOMS</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="index.php#accessories-section">ACCESSORIES</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="feedback.php">FEEDBACK</a></li>
            </ul>
        </div>

        <!-- Login/Register or Logout - aligned right -->
        <div class="navbar-buttons d-flex align-items-center">
            <?php if (empty($_SESSION['user_email'])): ?>
                <button class="btn btn-white-noborder me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-white-noborder" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
            <?php else: ?>
                <span class="navbar-text me-3">
                    <?= htmlspecialchars($_SESSION['user_email']) ?>
                </span>
                <a href="logout.php" class="btn btn-outline-dark">Logout</a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<?php include 'includes/user.php'; ?>
