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
      $trimmattu = trim($this->nimi);

      if($this->nimi != $trimmattu){
        $errors[] = 'Poista tyhjät merkit!';
      }
      return $errors;
    }

    public function validoi_nimen_pituus(){
      $errors = array();
      if(strlen($this->nimi) < 3){
        $errors[] = 'Nimen tulee olla vähintään kolme merkkiä!';
      }
      if(strlen($this->nimi) > 120){
        $errors[] = 'Nimen tulee olla alle 120 merkkiä!';
      }
      return $errors;
    }

    public function validoi_lisatietojen_pituus(){
      $errors = array();
      if(strlen($this->lisatiedot) > 500){
        $errors[] = 'Lisätietojen tulee mahtua 500:n merkin sisään.';
      }
      if(strlen($this->nimi) > 120){
        $errors[] = 'Nimen tulee olla alle 120 merkkiä!';
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

    public function validoi_tupla_luokka(){
      $errors = array();

      //Haetaan kannasta samannimistä luokkaa
      $query = DB::connection()->prepare('
              SELECT * 
              FROM Luokka 
              WHERE nimi = :nimi
              LIMIT 1');
      $query->execute(array('nimi' => $this->nimi));
      $row = $query->fetch();

      if($row){
        $errors[] = 'Luokka on jo olemassa!';
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
