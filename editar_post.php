<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 

$show_success = false;
$post = null;

// 1. Obtener los datos actuales del post
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE idpost = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        header("Location: index.php");
        exit();
    }
}

// 2. Procesar la actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idpost'];
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];

    $sql = "UPDATE posts SET title = :title, description = :description WHERE idpost = :id";
    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute(['title' => $titulo, 'description' => $descripcion, 'id' => $id])) {
        $show_success = true;
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card post-card p-4">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-pen-to-square fa-3x text-primary mb-3"></i>
                    <h2 class="fw-bold">EDITAR PUBLICACIÓN</h2>
                    <p class="text-muted">Modifica los detalles de tu post de alto rendimiento.</p>
                </div>
                
                <form method="POST">
                    <!-- Campo oculto para el ID -->
                    <input type="hidden" name="idpost" value="<?php echo $post['idpost']; ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Título</label>
                        <input type="text" name="title" class="form-control p-3 border-0 bg-light" 
                               value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase">Contenido</label>
                        <textarea name="description" class="form-control p-3 border-0 bg-light" rows="6" required><?php echo htmlspecialchars($post['description']); ?></textarea>
                    </div>

                    <div class="row g-2">
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary w-100 py-3 shadow">GUARDAR CAMBIOS</button>
                        </div>
                        <div class="col-4">
                            <a href="index.php" class="btn btn-outline-secondary w-100 py-3">CANCELAR</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($show_success): ?>
<script>
    Swal.fire({
        title: '¡Actualizado!',
        text: 'La publicación se ha modificado con éxito.',
        icon: 'success',
        confirmButtonColor: '#e63946'
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>