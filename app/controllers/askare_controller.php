<?php

class AskareController extends BaseController {



    public static function index(){
        View::make('yleiset/etusivu.html');
    }

    public static function kirjaudu(){
    	View::make('yleiset/kirjautuminen.html');
    }

    public static function rekisteroidy(){
    	View::make('yleiset/rekisteroityminen.html');
    }

	public static function listaaAskareet($laatija){
		$askareet = Askare::findAll($laatija);
		View::make('askareet/askarelistaus.html', array('askareet' => $askareet));
	}

	public static function lisaaAskare(){

	}
}


