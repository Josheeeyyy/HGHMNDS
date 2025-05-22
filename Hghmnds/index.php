<?php
session_start();
include 'includes/auth.php';
include 'includes/db.php'; // Ensure $pdo is initialized
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>HGHMNDS.</title>
    <link rel="icon" type="image/x-icon" href="assets/clothes.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/navbar.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="css/index.css?v=<?= time(); ?>">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

<!-- Session Alerts -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success text-center mb-0">
        <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center mb-0">
        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<main class="flex-shrink-0">
    <?php include 'includes/navbar.php'; ?>

    <!-- Carousel -->
    <div id="homepageCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="images/ad1.jpg" class="d-block w-100" alt="Ad 1"></div>
            <div class="carousel-item"><img src="images/ad2.jpg" class="d-block w-100" alt="Ad 2"></div>
            <div class="carousel-item"><img src="images/ad3.jpg" class="d-block w-100" alt="Ad 3"></div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"><i class="bi bi-chevron-left"></i></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"><i class="bi bi-chevron-right"></i></span>
        </button>
    </div>

    <!-- Static New Drops Section -->
    <div class="container my-5 featured-products">
        <h3 class="mb-4">New Drops</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            $shoes = [
                ['img' => 'images/backpack.jpg', 'hover_img' => 'images/backpackhover.jpg', 'title' => 'NOVABLAST 5 LITE-SHOW', 'desc' => 'Men Shoes', 'price' => '$150'],
                ['img' => 'images/longsleeve.jpg', 'hover_img' => 'images/longsleevehover.jpg', 'title' => 'NOVABLAST 5 LITE-SHOW', 'desc' => 'Women Shoes', 'price' => '$130'],
                ['img' => 'images/short.jpg', 'hover_img' => 'images/shorthover.jpg', 'title' => 'GEL-CUMULUS 27 LITE-SHOW', 'desc' => 'Men Shoes', 'price' => '$110'],
                ['img' => 'images/hoodie.jpg', 'hover_img' => 'images/hoodiehover.jpg', 'title' => 'GEL-CUMULUS 27 LITE-SHOW', 'desc' => 'Women Shoes', 'price' => '$120'],
            ];
            foreach ($shoes as $shoe): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-img-wrapper position-relative">
                            <img src="<?= htmlspecialchars($shoe['img']); ?>" class="card-img main-img" alt="<?= htmlspecialchars($shoe['title']); ?>">
                            <img src="<?= htmlspecialchars($shoe['hover_img']); ?>" class="card-img hover-img position-absolute top-0 start-0 w-100 h-100" style="display:none;" alt="<?= htmlspecialchars($shoe['title']); ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($shoe['title']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($shoe['desc']); ?></p>
                            <p class="card-text fw-bold mt-auto"><?= htmlspecialchars($shoe['price']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Shirts Section -->
    <div id="shirts-section" class="container my-5">
        <h3 class="mb-4 text-center">SHIRTS</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            try {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category = 'Shirt' ORDER BY created_at DESC");
                $stmt->execute();
                foreach ($stmt as $shirt): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?= htmlspecialchars($shirt['main_image']); ?>" class="card-img main-img" alt="<?= htmlspecialchars($shirt['name']); ?>">
                                <img src="<?= htmlspecialchars($shirt['hover_image']); ?>" class="card-img hover-img position-absolute top-0 start-0 w-100 h-100" style="display:none;" alt="<?= htmlspecialchars($shirt['name']); ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($shirt['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($shirt['description']); ?></p>
                                <p class="card-text fw-bold mt-auto">$<?= number_format($shirt['price'], 2); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error fetching shirts: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Bottoms Section -->
    <div id="bottoms-section" class="container my-5">
        <h3 class="mb-4 text-center">BOTTOMS</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            try {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category = 'Bottoms' ORDER BY created_at DESC");
                $stmt->execute();
                foreach ($stmt as $bottom): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?= htmlspecialchars($bottom['main_image']); ?>" class="card-img main-img" alt="<?= htmlspecialchars($bottom['name']); ?>">
                                <img src="<?= htmlspecialchars($bottom['hover_image']); ?>" class="card-img hover-img position-absolute top-0 start-0 w-100 h-100" style="display:none;" alt="<?= htmlspecialchars($bottom['name']); ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($bottom['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($bottom['description']); ?></p>
                                <p class="card-text fw-bold mt-auto">$<?= number_format($bottom['price'], 2); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error fetching bottoms: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Accessories Section -->
    <div id="accessories-section" class="container my-5">
        <h3 class="mb-4 text-center">ACCESSORIES</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            try {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category = 'Accessories' ORDER BY created_at DESC");
                $stmt->execute();
                foreach ($stmt as $accessory): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?= htmlspecialchars($accessory['main_image']); ?>" class="card-img main-img" alt="<?= htmlspecialchars($accessory['name']); ?>">
                                <img src="<?= htmlspecialchars($accessory['hover_image']); ?>" class="card-img hover-img position-absolute top-0 start-0 w-100 h-100" style="display:none;" alt="<?= htmlspecialchars($accessory['name']); ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($accessory['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($accessory['description']); ?></p>
                                <p class="card-text fw-bold mt-auto">$<?= number_format($accessory['price'], 2); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error fetching accessories: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php if (file_exists('includes/user.php')) include 'includes/user.php'; ?>
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Image hover logic
for (const wrapper of document.querySelectorAll('.card-img-wrapper')) {
    const mainImg = wrapper.querySelector('.main-img');
    const hoverImg = wrapper.querySelector('.hover-img');
    wrapper.addEventListener('mouseenter', () => {
        mainImg.style.display = 'none';
        hoverImg.style.display = 'block';
    });
    wrapper.addEventListener('mouseleave', () => {
        mainImg.style.display = 'block';
        hoverImg.style.display = 'none';
    });
}
</script>
</body>
</html>
