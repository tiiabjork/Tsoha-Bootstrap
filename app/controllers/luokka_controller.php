<?php

class LuokkaController extends BaseController {

	
	//Toimii osittain, muokkaus ja poistaminen ei vielä toiminnassa.
	public static function listaaKaikkiLuokatMuokkaus(){
		$luokat = Luokka::all();
		View::make('luokat/muokkaa_luokkia.html', array('luokat' => $luokat));
	}

	//TOIMII - Avaa lomakkeen, jolla voi tallentaa uuden askareen.
	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	//TOIMII - Poimii lomakkeelle tallennetut tiedot tallennettavaksi tietokantaan.
	public static function store(){
		$params = $_POST;
		$luokka = new Luokka(array(
			'kuvaus' => $params['luokka']
		));

		$luokka->save();

		Redirect::to('/luokat');
	}
	

}


