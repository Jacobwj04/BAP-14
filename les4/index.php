<?php
require 'function.php';
$connection = dbConnect();

$result = $connection->query('SELECT * FROM `producten` ORDER BY `id` ASC');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Make it rain BAP</title>
</head>
<body>
<article class="article-card5">
            <ul class="article-card5">
            <?php foreach($result as $row): ?>
                <li>
                    <section class="header1">
                    <h2><?php echo $row['product']; ?></h2>
                    </section>
                    <section class="section__img">
                        <img style="img1" src="img/<?php echo $row['foto']; ?>">
                    </section>
                    <section class="section__p">
                        <p><?php echo $row['beschrijving'] ?></p>
                        <p>€<?php echo $row['prijs'] ?></p>
                    </section>
                    <a class="section__a" href="details.php?id=<?php echo $row['id'] ?>">Meer info</a>
                </li>
                <?php endforeach; ?>
            </ul>
            <ul>
            <?php foreach($result as $row): ?>
                <li>
                    <h2><?php echo $row['product']; ?></h2>
                    <img style="background-image" src="img/<?php echo $row['foto']; ?>">
                </li> 
                <?php endforeach; ?>
            </ul>
    </article>
</body>
</html>