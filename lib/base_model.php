<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function validoi_tyhjyys(){
      $errors = array();
      if($this->nimi == '' || $this->nimi == null){
        $errors[] = 'Nimi ei saa olla tyhjä!';
      }
      return $errors;
    }

    public function validoi_pituus(){
      $errors = array();
      if(strlen($this->nimi) < 3){
        $errors[] = 'Syötteen tulee olla vähintään kolme merkkiä!';
      }
      return $errors;
    }

    public function validoi_kiireellisyys(){
      $errors = array();
      if($this->kiireellisyys == '' || $this->kiireellisyys == null){
        $errors[] = 'Kiireellisyydelle on valittava jokin määre!';
      }
      return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $validointiMetodinErrori = $this->{$validator}();
        $errors = array_merge($errors, $validointiMetodinErrori);
      }

      return $errors;
    }

  }
