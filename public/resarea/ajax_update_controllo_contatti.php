<?php
require_once 'config/dbnew.php'; // qui includi la connessione ($open_connection)

if(isset($_POST['id']) && isset($_POST['controllo'])){
    $id = (int)$_POST['id'];
    $controllo = ($_POST['controllo'] == 1) ? 1 : 0;

    $query = "UPDATE contatti SET controllo = :controllo WHERE id = :id";
    $stmt = $open_connection->connection->prepare($query);
    $ok = $stmt->execute([':controllo'=>$controllo, ':id'=>$id]);

    echo json_encode(["success"=>$ok, "controllo"=>$controllo]);
}
