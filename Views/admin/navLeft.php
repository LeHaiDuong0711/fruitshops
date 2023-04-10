<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"> <img class="bg-transparent"" src=" ../Contents/img/logobandoan.jpg" alt="">
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text text-dark active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Projects</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-chart-line me-2"></i>Analytics</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-paperclip me-2"></i>Reports</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-shopping-cart me-2"></i>Store Mng</a>
        <a href="admin.php?use=listType" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-gift me-2"></i>Products</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-comment-dots me-2"></i>Chat</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Outlet</a>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="admin.php?act=auth&use=logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
        <?php else : ?>
            <a href="admin.php?act=auth&use=login" class="list-group-item list-group-item-action bg-transparent text-primary fw-bold"><i class="fas fa-user me-2"></i>Login</a>
        <?php endif ?>
    </div>
</div>