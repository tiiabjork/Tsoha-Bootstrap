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
		$attribuutit = array(
			'nimi' => $params['luokka']
		);

		$luokka = new Luokka($attribuutit);
		$errors = $luokka->errors();

		if(count($errors) == 0){
			//Ei tule erroreita
			$luokka->save();
			Redirect::to('/luokat');
		}else{
			//Askareen tiedoissa on jotain häikkää
			$luokat = Luokka::all();
			View::make('luokat/muokkaa_luokkia.html', array('errors' => $errors, 'luokat' => $luokat));
		}
	}

}
