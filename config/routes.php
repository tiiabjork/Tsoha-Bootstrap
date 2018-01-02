<?php

  $routes->get('/', function() {
    AskareController::index();
  });

  $routes->get('/etusivu', function(){
    AskareController::index();
  });

  $routes->get('/etusivu/kirjautuminen', function() {
    AskareController::kirjaudu();
  });

  $routes->get('/etusivu/rekisteroityminen', function() {
    AskareController::rekisteroidy();
  });

  $routes->get('/askareet', function() {
    AskareController::listaaKaikkiAskareet();
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
    AskareController::find($atunnus);
  });

  $routes->get('/muokkaa', function() {
    AskareController::listaaKaikkiAskareetMuokkaus();
  });

  $routes->get('/luokat', function() {
    AskareController::listaaKaikkiLuokatMuokkaus();
  });

  $routes->get('/askareet/uusi', function() {
    AskareController::uusi();
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


