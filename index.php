<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<header class="hero">
    <div class="container">
        <h1>POWER. ACCURACY. <span>SPEED.</span></h1>
        <p class="lead">Administración robusta de contenidos en el servidor.</p>
    </div>
</header>

<div class="container">
    <div class="row g-4">
        <?php
        $sql = "SELECT p.idpost, p.title, p.description, p.fecha, u.name as autor 
                FROM posts p 
                JOIN `user` u ON p.user_id = u.iduser 
                ORDER BY p.fecha DESC";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Imagen aleatoria de tecnología/autos para cada post
            $img_id = $row['idpost'] + 100;
            $photo_url = "https://picsum.photos/seed/$img_id/600/400";
        ?>
        <div class="col-md-4">
            <div class="card post-card h-100">
                <img src="<?php echo $photo_url; ?>" class="card-img-top" alt="post image">
                <div class="card-body p-4">
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">
                        <i class="fa-regular fa-calendar me-1"></i> <?php echo $row['fecha']; ?>
                    </small>
                    <h4 class="card-title mt-2 fw-bold"><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p class="card-text text-secondary"><?php echo htmlspecialchars(substr($row['description'], 0, 90)) . '...'; ?></p>
                </div>
                <div class="card-footer bg-white border-0 p-4 pt-0 d-flex justify-content-between align-items-center">
                    <span class="small fw-semibold text-dark">
                        <i class="fa-solid fa-circle-user me-1 text-danger"></i> <?php echo $row['autor']; ?>
                    </span>
                    <button onclick="confirmarEliminar(<?php echo $row['idpost']; ?>)" class="btn btn-link text-danger p-0">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
function confirmarEliminar(id) {
    Swal.fire({
        title: '¿Eliminar publicación?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e63946',
        cancelButtonColor: '#1d3557',
        confirmButtonText: 'Sí, borrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'eliminar_post.php?id=' + id;
        }
    })
}
</script>

<?php include 'includes/footer.php'; ?>