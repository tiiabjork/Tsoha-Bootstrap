<?php

class YleisController extends BaseController {

	public static function index(){
        View::make('yleiset/etusivu.html');
    }

    public static function kayttajan_etusivu(){
    	View:make('yleiset/kayttajan_etusivu.html');
    }

}
