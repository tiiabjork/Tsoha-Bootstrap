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

	public static function listaaKaikkiAskareet(){
		$askareet = Askare::all();
		View::make('askareet/askarelistaus.html', array('askareet' => $askareet));
	}

	public static function find($atunnus) {
		$askare = Askare::find($atunnus);
		View::make('askareet/nayta_askare.html', array('askare' => $askare));
	}
	
	public static function muutaTietoja($atunnus) {
		$askare = Askare::find($atunnus);
		View::make('askareet/muokkaa_askaretta.html', array('askare' => $askare));

	}


	public static function listaaKaikkiAskareetMuokkaus(){
		$askareet = Askare::all();
		View::make('askareet/muokkaa_askareita.html', array('askareet' => $askareet));
	}

	public static function listaaKaikkiLuokatMuokkaus(){
		$luokat = Luokka::all();
		View::make('luokat/muokkaa_luokkia.html', array('luokat' => $luokat));
	}

	public static function lisaaAskare(){

	}

	public static function etsiAskare(){
		$askare = Askare::find(1);	
		View::make('askareet/muokkaa_askaretta.html', array('askare' => $askare));
	}
}


