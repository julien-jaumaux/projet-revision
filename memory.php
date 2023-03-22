<?php
include('card.php');

$nbCard = 12;
if (!isset($_SESSION['temp'])) {
    $_SESSION['temp'] = [];
}
if (!isset($_SESSION['discover'])) {
    $_SESSION['discover'] = [];
}





function randomblock($card)
{

    if (empty($_SESSION['rdm'])) {
        $_SESSION['rdm'] = $card;
        shuffle($_SESSION['rdm']);
    }
    return $_SESSION['rdm'];
}


function createCard($nbCard)
{
    for ($i = 0; $i < $nbCard; $i += 2) { // i+=2, i = i +2
        $card[$i] = new Card($i, './images.php/back.png',  './images.php/img' . $i . '.png', false);
        $card[$i + 1] = new Card($i + 1, './images.php/back.png', './images.php/img' . $i . '.png', false);
    }
    return $card;
}

function resetgame()
{
    if (!empty($_GET['reset'])) {
        if ($_GET['reset'] == 'reset') {
            session_destroy();
            session_unset();
            header("location:memory.php");
        }
    }
}
resetgame();


function verifState($card, $i)
{

    if (isset($_GET['jouer'])) {
        if ($_GET['jouer'] == $card[$i]->getId_card()) {
            $card[$i]->setState(true);
            //var_dump($i); 
            if (count($_SESSION['temp']) <= 2) {
                array_push($_SESSION['temp'], $card[$i]);
                if (count($_SESSION['temp']) === 2) {
                    if ($_SESSION['temp'][0]->getImg_face_up() == $_SESSION['temp'][1]->getImg_face_up()) {
                        array_push($_SESSION['discover'], $_SESSION['temp']);
                        $_SESSION['temp'] = [];
                        //var_dump($_SESSION['discover']); 
                    } else {
                        $_SESSION['temp'][0]->setState(false);
                        $_SESSION['temp'][1]->setState(false);
                        $_SESSION['temp'] = [];
                        header("location:memory.php");
                    }
                }
            } else {
                $_SESSION['temp'] = [];
            }   //var_dump($_SESSION['temp']);

        }
    }
}

function nbCard()
{
    if (isset($_GET['card'])) {
    }
}

function endgame()
{
    if (count($_SESSION['discover']) * 2 === count($_SESSION['rdm'])) {
        echo "<h1>fin de la partie</h1>";
    }
}



function boardCard($nbCard)
{

    $card = createCard($nbCard);
    $rdm = randomblock($card);

    for ($i = 0; $i < $nbCard; $i++) {
        verifState($rdm, $i);
        if ($rdm[$i]->getState() == false) {
?>
            <form><button type="submit" name="jouer" value="<?= $rdm[$i]->getId_card() ?>">
                    <img src=<?= $rdm[$i]->getImg_face_down() ?> alt="" height="200px" width="133px">
                </button>
            <?php
        } else {
            ?><img src=<?= $rdm[$i]->getImg_face_up() ?> height="200px" width="133px">
            <?php
        }
            ?>
            </form>
    <?php
    }
}


    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
    </head>

    <body>


        <?php if (!isset($_SESSION['niveau'])) { ?>
            <form method="POST">
                <label for="pet-select">Nombre de carte:</label>
                <select name="card" id="nbcard">
                    <option value="">--choix du nombre de carte--</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                </select>
                <input type="submit">
            </form>
            <?php
            if (isset($_POST['card'])) {
                $_SESSION['niveau'] = $_POST['card'];
                header("Location: ./memory.php");
            }
        } else { ?>
            <div class="card">
                <?php boardCard($_SESSION['niveau']); ?>
            </div>
            <form action="" method="get">
                <button type="submit" name="reset" value="reset">reset</button>

            </form>
        <?php
            endgame();
        }
        ?>
    </body>
    <style>
        .card {
            display: flex;
            flex-wrap: wrap;
        }
    </style>

    </html>