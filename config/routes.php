<?php

  $routes->get('/', function() {
    YleisController::index();
  });

  $routes->get('/etusivu', function(){
    YleisController::index();
  });

  $routes->get('/etusivu/kirjaudu', function() {
    KayttajaController::kirjaudu();
  });

  $routes->post('/etusivu/kirjaudu', function() {
    KayttajaController::kasittele_kirjautuminen();
  });

  $routes->get('/etusivu/rekisteroidy', function() {
    KayttajaController::rekisteroidy();
  });

  $routes->get('/askareet', function() {
    AskareController::listaaKaikkiAskareetMuokkaus();
  });

  $routes->post('/askareet/', function() {
    AskareController::store();
  });

  $routes->get('/askareet/uusi', function() {
    AskareController::create();
  });

  $routes->get('/askareet/:atunnus', function($atunnus) {
    AskareController::find($atunnus);
  });

  $routes->get('/askareet/:atunnus/muokkaa', function($atunnus) {
    AskareController::muutaTietoja($atunnus);
  });

  $routes->post('/askareet/:atunnus', function($atunnus) {
    AskareController::update($atunnus);
  });

  $routes->post('/askareet/:atunnus/poista', function($atunnus) {
    AskareController::delete($atunnus);
  });

  $routes->get('/luokat', function() {
    LuokkaController::listaaKaikkiLuokatMuokkaus();
  });

  $routes->post('/luokat/', function() {
    LuokkaController::store();
  });

  $routes->post('/luokat/:ltunnus', function($ltunnus) {
    LuokkaController::delete($ltunnus);
  });












  //suunnitelmat!

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/suunnitelma/etusivu', function() {
    HelloWorldController::etusivu();
  });
  
  $routes->get('/suunnitelma/muokkaa_askareita', function() {
    HelloWorldController::muokkaa_askareita();
  });
  $routes->get('/suunnitelma/muokkaa_askareita/1', function() {
    HelloWorldController::askareen_muokkaussivu();
  });

  $routes->get('/suunnitelma/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
  });

  $routes->get('/suunnitelma/rekisteroityminen', function() {
    HelloWorldController::rekisteroityminen();
  });

  $routes->get('/suunnitelma/luokat', function() {
    HelloWorldController::luokat();
  });

  $routes->get('/suunnitelma/nayta_askareet', function() {
    HelloWorldController::nayta_askareet();
  });


