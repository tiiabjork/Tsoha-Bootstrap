<?php

class LuokkaController extends BaseController {

	
	public static function listaaKaikkiLuokatMuokkaus(){
		$luokat = Luokka::all();
		View::make('luokat/muokkaa_luokkia.html', array('luokat' => $luokat));
	}

	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	public static function store(){
		$params = $_POST;
		$attribuutit = array(
			'nimi' => $params['nimi']
		);

		$luokka = new Luokka($attribuutit);
		$errors = $luokka->errors();

		if(count($errors) == 0){
			$luokka->save();
			Redirect::to('/luokat', array('message' => 'Luokka lisätty onnistuneesti!'));
		}else{
			$luokat = Luokka::all();
			View::make('luokat/muokkaa_luokkia.html', array('errors' => $errors, 'luokat' => $luokat));
		}
	}

	public static function delete($ltunnus) {
    	$luokka = new Luokka(array('ltunnus' => $ltunnus));
    	$luokka->delete();
    	Redirect::to('/luokat', array('message' => 'Luokka on poistettu onnistuneesti!'));
	}

}
