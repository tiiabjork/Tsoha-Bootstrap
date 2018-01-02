<?php

  class HelloWorldController extends BaseController{

    
    // Täältä löytyy kaikki suunnitelmat.

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function muokkaa_askareita(){
      View::make('suunnitelmat/muokkaa_askareita.html');
    }

    public static function askareen_muokkaussivu(){
      View::make('suunnitelmat/askareen_muokkaussivu.html');
    }

    public static function kirjautuminen(){
      View::make('suunnitelmat/kirjautuminen.html');
    }

    public static function luokat(){
      View::make('suunnitelmat/luokat.html');
    }

    public static function rekisteroityminen(){
      View::make('suunnitelmat/rekisteroityminen.html');
    }

    public static function nayta_askareet(){
      View::make('suunnitelmat/nayta_askareet.html');
    }

    public static function etusivu(){
      View::make('suunnitelmat/etusivu.html');
    }
  }
