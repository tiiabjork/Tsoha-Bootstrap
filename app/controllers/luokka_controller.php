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
		$askare = new Askare(array(
			'nimi' => $params['nimi'],
			'kiireellisyys' => $params['kiireellisyys'],
			'lisatiedot' => $params['lisatiedot']
		));

		$askare->save();

		Redirect::to('/askareet/' . $askare->atunnus, array('message' => 'Askare on lisätty muistilistaasi!'));
	}
	

}


