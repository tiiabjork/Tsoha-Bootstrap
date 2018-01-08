<?php

class HelloWorld extends BaseModel{

public static function sandbox(){
  $askare = new Askare(array(
    'nimi' => 'd',
    'kiireellisyys' => ''
  ));

  $errors = $askare->errors();

  Kint::dump($errors);
  }
}