<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $id = $_SESSION['user'];
        $kayttaja = Kayttaja::find($id);
        return $kayttaja;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
        Redirect::to('/etusivu/kirjaudu', array('message' => 'Kirjaudu endin sisään!'));
      }
    }

  }
