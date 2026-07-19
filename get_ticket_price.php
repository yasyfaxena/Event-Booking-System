<?php
include 'config.php';

$id_event = $_GET['id_event'];
$ticket_type = $_GET['ticket_type'];
$price = 0;

if ($stmt = $conn->prepare("SELECT hargaGold, hargaMedal, hargaSilver FROM dftrEvent WHERE idEvent = ?")) {
    $stmt->bind_param("i", $id_event);
    $stmt->execute();
    $stmt->bind_result($hargaGold, $hargaMedal, $hargaSilver);
    $stmt->fetch();

    switch ($ticket_type) {
        case 'gold':
            $price = $hargaGold;
            break;
        case 'Medal':
            $price = $hargaMedal;
            break;
        case 'Silver':
            $price = $hargaSilver;
            break;
    }

    $stmt->close();
}

$conn->close();
echo json_encode(['price' => $price]);

?>