<?php
require 'function.php';
$connection = dbConnect();



if( !isset($_GET['id']) ){
    echo "Dat id is niet gezet";
    exit;
}

$id = $_GET['id'];
$check_int = filter_var($id, FILTER_VALIDATE_INT);
if($check_int == false){
    echo "Dit is geen getal!!";
    exit;
}

$statement = $connection->prepare('SELECT * FROM `producten` WHERE id=?');
$params = [$id];
$statement->execute($params);
$place = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
        <article class="article-detail">
            <section class="header">
                <h1><?php echo $place['product'] ?></h1>
            </section>
            <section class="img-section">
                <img class="img" src="img/<?php echo $place['foto']?>" alt="">
            </section>
            <section class="price">
            <?php echo $place['prijs']?>
            </section>
            <section class="text">
            <?php echo $place['beschrijving']?>
            <a href="index.php">Terug naar pagina</a>
            </section>
        </article>
</body>
</html>
