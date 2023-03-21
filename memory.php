<?php
include('card.php');

$nbCard = 12;

 function createCard($nbCard)
{
    for ($i = 0; $i < $nbCard; $i+=2){ // i+=2, i = i +2
        $card[$i] = new Card($i, './images.php/back.png',  './images.php/img' . $i . '.png', false);
        $card[$i+1] = new Card($i+1, './images.php/back.png', './images.php/img' . $i . '.png', false);
    }
    return $card;
}

function verifState($card,$i){

    if(isset($_GET['jouer'])){
        if($_GET['jouer'] == $card[$i]->getId_card()){
            $card[$i]->setState(true);
        }
       
    }

}


 function boardCard($nbCard)
{
    

        $card = createCard($nbCard);
        
        for ($i = 0; $i < $nbCard; $i++) {
            verifState($card,$i);
            if ($card[$i]->getState() == false ){
        ?>
                <form><button type="submit" name="jouer" value="<?= $i ?>">
                        <img src= <?= $card[$i]->getImg_face_down() ?> alt="" height="200px" width="133px">
                    </button>
                <?php
            } else {
                ?><img src= <?= $card[$i]->getImg_face_up() ?> height="200px" width="133px">
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
    <div class="card">
    <?php boardCard($nbCard); ?>
    </div>
    <form action="" method="get">
        <button type="submit" name="submit">play</button>
    </form>
    <style>.card{display: flex; flex-wrap: wrap;}</style>

</body>
</html>