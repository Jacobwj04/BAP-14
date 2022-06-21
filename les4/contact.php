<?php
require 'function.php';
$connection = dbConnect();

$voornaam = '';
$achternaam = '';
$email = '';
$bericht = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $bericht = $_POST['bericht'];
    $tijdstip = date('Y-m-d H-i-s');

    if (isEmpty($voornaam)) {
        $errors['voornaam'] = 'vul uw voornaam in';
    }
    if (isEmpty($achternaam)) {
        $errors['achternaam'] = 'vul uw achternaam in';
    }
    if (!isvalidEmail($email)) {
        $errors['email'] = 'vul uw geldige email in';
    }
    if (!hasMinLength($bericht, 5)) {
        $errors['bericht'] = 'vul minimaal 5 tekens in';
    }

    //print_r($errors);

    if (count($errors) == 0) {
        $sql = "INSERT INTO `berichten` (`voornaam`, `achternaam`, `email`, `bericht`, `tijdstip`) 
                VALUES (:voornaam, :achternaam, :email, :bericht, :tijdstip);";

        $statement = $connection->prepare($sql);
        $params = [
            'voornaam' => $voornaam,
            'achternaam' => $achternaam,
            'email' => $email,
            'bericht' => $bericht,
            'tijdstip' => $tijdstip
        ];
        $statement->execute($params);
        header('location: bedankt.html');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="nl">

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
            <h1>Contact</h1>
        </section>
        <section>
            <form class="section__form" action="contact.php" method="POST" novalidate>
                <section class="form__inputs">
                    <div class="form__div">
                        <label for="voornaam">Voornaam</label>
                        <input type="text" value="<?php echo $voornaam; ?>" id="voornaam" name="voornaam" placeholder="Vul uw voornaam in" required>

                        <?php if (!empty($errors['voornaam'])) : ?>
                            <p class="form__error"><?php echo $errors['voornaam'] ?></p>
                        <?php endif ?>
                    </div>
                    <div class="form__div">
                        <label for="achternaam">Achternaam</label>
                        <input type="text" value="<?php echo $achternaam; ?>" id="achternaam" name="achternaam" placeholder="Vul uw achternaam in" required>

                        <?php if (!empty($errors['achternaam'])) : ?>
                            <p class="form__error"><?php echo $errors['achternaam'] ?></p>
                        <?php endif ?>
                    </div>
                    <div class="form__div">
                        <label for="email">Email</label>
                        <input type="email" value="<?php echo $email; ?>" id="email" name="email" placeholder="Vul uw e-mailaddress in" required>

                        <?php if (!empty($errors['email'])) : ?>
                            <p class="form__error"><?php echo $errors['email'] ?></p>
                        <?php endif ?>
                    </div>
                    <div class="form__div">
                        <label for="bericht">Bericht</label>
                        <textarea class="form__bericht" name="bericht" type="text" id="bericht" placeholder="Vul uw vraag of bericht in" required><?php echo $bericht; ?></textarea>

                        <?php if (!empty($errors['bericht'])) : ?>
                            <p class="form__error"><?php echo $errors['bericht'] ?></p>
                        <?php endif ?>
                    </div>
                </section>
                <div class="form__submit">
                    <button class="form__button" type="submit">Opsturen</button>
                </div>
            </form>
        </section>
        <section class="price">

        </section>
        <section class="text">
            <a class="section__text" href="contact.php">Neem contact op</a>
            <a class="section__text" href="index.php">Terug naar pagina</a>
        </section>
    </article>
</body>

</html>