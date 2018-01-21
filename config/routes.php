<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

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

  $routes->get('/askareet', 'check_logged_in', function() {
    AskareController::listaaKaikkiAskareetMuokkaus();
  });

  $routes->post('/askareet/', 'check_logged_in', function() {
    AskareController::store();
  });

  $routes->get('/askareet/uusi', 'check_logged_in', function() {
    AskareController::create();
  });

  $routes->get('/askareet/:atunnus', 'check_logged_in', function($atunnus) {
    AskareController::find($atunnus);
  });

  $routes->get('/askareet/:atunnus/muokkaa', 'check_logged_in', function($atunnus) {
    AskareController::muutaTietoja($atunnus);
  });

  $routes->post('/askareet/:atunnus', 'check_logged_in', function($atunnus) {
    AskareController::update($atunnus);
  });

  $routes->post('/askareet/:atunnus/poista', 'check_logged_in', function($atunnus) {
    AskareController::delete($atunnus);
  });

  $routes->get('/luokat', 'check_logged_in', function() {
    LuokkaController::listaaKaikkiLuokatMuokkaus();
  });

  $routes->post('/luokat/', 'check_logged_in', function() {
    LuokkaController::store();
  });

  $routes->get('/luokat/:ltunnus', 'check_logged_in', function($ltunnus) {
    LuokkaController::muutaTietoja($ltunnus);
  });

  $routes->post('/luokat/:ltunnus', 'check_logged_in', function($ltunnus) {
    LuokkaController::update($ltunnus);
  });

  $routes->post('/luokat/:ltunnus', 'check_logged_in', function($ltunnus) {
    LuokkaController::delete($ltunnus);
  });

  $routes->post('/kirjaudu_ulos', 'check_logged_in', function(){
    KayttajaController::kirjaudu_ulos();
  });

