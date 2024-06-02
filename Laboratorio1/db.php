<?php 
function getDB(){ //Este es la coneccion a bd//
    $db = new PDO('mysql:host=localhost;dbname=db_sistempagos;charset=utf8', 'root', '');
    return $db;
}
function getPagos(){
    $db = getDB();
    $sentencia = $db->prepare("SELECT * FROM pagos");
    $sentencia->execute();
    $pagos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $pagos;
}

function addPago($deudor, $cuota, $cuota_capital, $fecha_pago){
    $db = getDB();
    $sentencia = $db->prepare("INSERT INTO pagos(deudor, cuota, cuota_capital, fecha_pago) VALUES(?, ?, ?, ?)");
    $sentencia->execute([$deudor, $cuota, $cuota_capital, $fecha_pago]);

    return $db->lastInsertId();
}

function deletePago($id){
    $db = getDB();

    $sentencia = $db->prepare("DELETE FROM pagos WHERE id = ?");
    $sentencia->execute([$id]);
}
?>