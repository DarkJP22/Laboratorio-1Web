<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio#1 José Alemán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Pagos</h1>
    <?php
    require_once 'db.php';

    function listarPagos()
    {
        $pagos = getPagos();
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deudor</th>
                    <th>Cuota</th>
                    <th>Cuota Capital</th>
                    <th>Fecha de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagos as $pago) : ?>
                    <tr>
                        <td><?= $pago->id ?></td>
                        <td><?= $pago->deudor ?></td>
                        <td><?= $pago->cuota ?></td>
                        <td><?= $pago->cuota_capital ?></td>
                        <td><?= $pago->fecha_pago ?></td>
                        <td>
                            <a class="btn btn-danger" href="index.php?delete=<?= $pago->id ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php
    }

    listarPagos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deudor = $_POST['deudor'];
        $cuota = $_POST['cuota'];
        $cuota_capital = $_POST['cuota_capital'];
        $fecha_pago = $_POST['fecha_pago'];

        addPago($deudor, $cuota, $cuota_capital, $fecha_pago);

        header('Location: index.php');
    }
    if (isset($_GET['delete'])) {
        deletePago($_GET['delete']);
        header('Location: index.php');
    }
    ?>
    <form action="index.php" method="post">
        <div>
            <label for="deudor" class="form-label">Deudor</label>
            <input type="text" name="deudor" id="deudor" class="form-control">
        </div>
        <div>
            <label for="cuota" class="form-label">Cuota</label>
            <input type="number" name="cuota" id="cuota" class="form-control">
        </div>
        <div>
            <label for="cuota_capital" class="form-label">Cuota Capital</label>
            <input type="number" step="0.01" name="cuota_capital" id="cuota_capital" class="form-control">
        </div>
        <div>
            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Agregar</button>
    </form>
</div>

</body>
</html>