<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function muistilista(){
      View::make('suunnitelmat/muistilista.html');
    }

    public static function muokkaussivu(){
      View::make('suunnitelmat/muokkaussivu.html');
    }

    public static function kirjautuminen(){
      View::make('suunnitelmat/kirjautuminen.html');
    }

    public static function luokat(){
      View::make('suunnitelmat/luokat.html');
    }
  }
