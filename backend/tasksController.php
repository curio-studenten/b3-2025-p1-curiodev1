<<?php
$action = $_POST['action'];


if($action == "create"){

    

    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $deadline = $_POST['deadline'];

    $errors = [];

    if ($titel === '' || $beschrijving === '' || $afdeling === '') {
        $errors[] = "Vul alle velden in (titel, beschrijving en afdeling).";
    }

    $allowed = ['personeel','horeca','techniek','inkoop','klantenservice','groen'];
    if (!in_array($afdeling, $allowed)) {
        $errors[] = "Ongeldige afdeling gekozen.";
    }

    if (!empty($errors)) {
        var_dump($errors);
        die();
    }
    require_once 'conn.php';

    $query = "INSERT INTO taken (titel, beschrijving,  afdeling, deadline) 
    VALUES (:titel, :beschrijving, :afdeling, :deadline)";

    $statement = $conn->prepare($query);

    $statement->execute([
        ":titel" => $titel,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
        ":deadline" => $deadline,
    ]);
}

if($action == "update"){

    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];
    $id = $_POST['id'];


    require_once 'conn.php';

    $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline WHERE id = :id";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel" => $titel,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
        ":status" => $status,
        ":deadline" => $deadline,
        ":id" => $id

    ]);
}

if($action == "delete"){

    $id = $_POST['id'];
    require_once 'conn.php';
    
    $query = "DELETE FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id

    ]);
}

header("Location: ../tasks/index.php");

exit;
?>