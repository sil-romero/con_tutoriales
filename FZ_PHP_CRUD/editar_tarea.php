<?php 
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM tareas WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
           $row = mysqli_fetch_array($result);
           $titulo = $row['TITULO'];
           $descripcion = $row['DESCRIPCION'];
        }

        /* $_SESSION['mensaje'] = 'TAREA ELIMINADA';
        $_SESSION['tipo_mensaje'] = 'danger';

        header("location: index.php"); */
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];

        $query = "UPDATE tareas set TITULO = '$titulo', DESCRIPCION = '$descripcion' WHERE id = $id";
        mysqli_query($conn, $query);

        $_SESSION['mensaje'] = 'TAREA ACTUALIZADA';
        $_SESSION['tipo_mensaje'] = 'warning';
        header("location: index.php");

    }

?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar_tarea.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="titulo" value="<?php echo $titulo; ?>"
                        class="form-control" placeholder="Actualiza el Título">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Actualiza la descripcion">
                        <?php echo $descripcion; ?></textarea>
                    </div>
                    <button class="btn btn-success" name="update">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>