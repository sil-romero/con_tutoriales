<?php  include("db.php"); ?>

<?php  include("includes/header.php"); //contiene la primera parte del html ?> 
    
<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

<?php  if (isset($_SESSION['mensaje'])) { ?>
    <div class="alert alert-<?= $_SESSION['tipo_mensaje'];?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['mensaje'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php session_unset(); } ?>

            <div class="card card-body">
                <form action="guardar_tarea.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control" placeholder="titulo de tarea" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" rows="4" class="form-control" placeholder="descripcion de tarea"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar_tarea" value="Guardar Tarea">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>FECHA DE CRACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT * FROM tareas";
                        $resultado_tarea = mysqli_query($conn, $query);
                    
                        while($row = mysqli_fetch_array($resultado_tarea)) { ?>
                        <tr>
                            <td><?php echo $row['TITULO'] ?></td>
                            <td><?php echo $row['DESCRIPCION'] ?></td>
                            <td><?php echo $row['CREATED_AT'] ?></td>
                            <td>
                                <a href="editar_tarea.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="eliminar_tarea.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                       <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php  include("includes/footer.php"); //contiene la otra parte del html ?>