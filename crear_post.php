<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 

$show_success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];
    $user_id = 1; 

    $sql = "INSERT INTO posts (title, description, fecha, user_id) VALUES (:title, :description, CURRENT_DATE, :user_id)";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(['title'=>$titulo, 'description'=>$descripcion, 'user_id'=>$user_id])) {
        $show_success = true;
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card post-card p-4">
                <h2 class="fw-bold mb-4 text-center">NUEVA PUBLICACIÓN</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">TÍTULO</label>
                        <input type="text" name="title" class="form-control p-3 border-0 bg-light" placeholder="Título impactante..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">CONTENIDO</label>
                        <textarea name="description" class="form-control p-3 border-0 bg-light" rows="5" placeholder="Escribe aquí..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 shadow">PUBLICAR CONTENIDO</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($show_success): ?>
<script>
    Swal.fire({
        title: '¡Éxito!',
        text: 'La publicación se ha subido correctamente.',
        icon: 'success',
        confirmButtonColor: '#e63946'
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>