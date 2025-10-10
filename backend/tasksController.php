<<?php
$action = $_POST['action'];


if($action == "create"){

    

    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];

    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';

    $query = "INSERT INTO taken (titel, beschrijving,  afdeling) 
    VALUES (:titel, :beschrijving, :afdeling)";

    $statement = $conn->prepare($query);

    $statement->execute([
        ":titel" => $titel,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
    ]);
}

if($action == "update"){

    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    $id = $_POST['id'];


    require_once 'conn.php';

    $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status WHERE id = :id";

    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel" => $titel,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
        ":status" => $status,
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