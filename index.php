<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<div class="hero-section text-center shadow">
    <div class="container">
        <h1 class="display-4 fw-bold">Bienvenido a <span style="color:#e94560;">TechPosts</span></h1>
        <p class="lead mt-3">La comunidad donde compartimos conocimientos de Redes, Docker y Desarrollo.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Últimas Publicaciones</h2>
        </div>
    </div>

    <div class="row g-4">
        <?php
        // Consulta SQL para obtener los posts (Uniendo con la tabla user para saber quién lo publicó)
        $sql = "SELECT p.idpost, p.title, p.description, p.fecha, u.name as autor 
                FROM posts p 
                JOIN \"user\" u ON p.user_id = u.iduser 
                ORDER BY p.fecha DESC";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <!-- Tarjeta de Post -->
                <div class="col-md-6 col-lg-4">
                    <div class="card post-card h-100 shadow-sm p-3">
                        <div class="card-body">
                            <span class="badge bg-secondary mb-2"><?php echo htmlspecialchars($row['fecha']); ?></span>
                            <h4 class="card-title fw-bold"><?php echo htmlspecialchars($row['title']); ?></h4>
                            <p class="card-text text-muted"><?php echo htmlspecialchars(substr($row['description'], 0, 100)) . '...'; ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <small class="text-primary fw-bold">👤 <?php echo htmlspecialchars($row['autor']); ?></small>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">Leer más</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-info shadow-sm">No hay posts publicados aún. ¡Sé el primero en publicar!</div></div>';
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>