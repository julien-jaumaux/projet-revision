<?php
session_start();
class Card
{

    public $id_card;
    public $img_face_down;
    public $img_face_up;
    public $state;



    public function __construct($id_card, $img_face_down, $img_face_up, $state)
    {
        $this->id_card = $id_card;
        $this->img_face_down = $img_face_down;
        $this->img_face_up = $img_face_up;
        $this->state = $state;
    }

    //------------getter------------//

    public function getId_card()
    {
        return $this->id_card;
    }

    public function getImg_face_down()
    {
        return $this->img_face_down;
    }

    public function getImg_face_up()
    {
        return $this->img_face_up;
    }

    public function getState()
    {
        return $this->state;
    }

    //------------setter-----------//

    public function setId_card($id_card)
    {
        $this->id_card = $id_card;
    }

    public function setImg_face_down($img_face_down)
    {
        $this->img_face_down = $img_face_down;
    }

    public function setImg_face_up($img_face_up)
    {
        $this->img_face_up = $img_face_up;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    //---------------fonction--------------//




}

    ?>