<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/muistilista', function() {
    HelloWorldController::muistilista();
  });
  $routes->get('/muistilista/1', function() {
    HelloWorldController::muokkaussivu();
  });

  $routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
  });

  $routes->get('/luokat', function() {
    HelloWorldController::luokat();
  });