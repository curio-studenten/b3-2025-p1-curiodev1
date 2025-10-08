<<?php
$action = $_POST['action'];


if($action == "create"){

    

    $titel = $_POST['titel'];
    if(is_numeric($titel))
    {
         echo "<script>
                    alert('Vul bij de titel tekst in, geen getal!');
                    window.history.back();
                </script>";
    exit;

    }
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
    
}

if($action == "delete"){
    
}

<?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM taken WHERE status != 'done' ";
        $statement = $conn->prepare($query);
        $statement->execute();
        $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

        
        ?>


header("Location: ../tasks/index.php");


?>