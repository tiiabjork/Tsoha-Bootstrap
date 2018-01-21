<?php

class LuokkaController extends BaseController {

	
	public static function listaaKaikkiLuokatMuokkaus(){
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$luokat = Luokka::all($laatija);
		View::make('luokat/muokkaa_luokkia.html', 
			 array('luokat' => $luokat,
				   'kirjautunut_kayttaja' => $kayttaja));
	}

	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	public static function store(){
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$params = $_POST;
		$attribuutit = array(
			'laatija' => $laatija,
			'nimi' => $params['nimi']
		);

		$luokka = new Luokka($attribuutit);
		$errors = $luokka->errors();

		if(count($errors) == 0){
			$luokka->save();
			Redirect::to('/luokat', array('message' => 'Luokka lisätty onnistuneesti!'));
		}else{
			$luokat = Luokka::all($laatija);
			View::make('luokat/muokkaa_luokkia.html', 
				 array('errors' => $errors, 
				 	   'luokat' => $luokat));
		}
	}

	public static function muutaTietoja($ltunnus) {
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$luokka = Luokka::find($ltunnus);
		View::make('luokat/muokkaa_luokkaa.html', 
					array('luokka' => $luokka));
	}


	public static function update($ltunnus) {
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$params = $_POST;
		

		$attribuutit = array(
			'ltunnus' => $ltunnus,
			'nimi' => $params['nimi'],
			'laatija' => $laatija
		);

		$luokka = new Luokka($attribuutit);
		$errors = $luokka->errors();

		if(count($errors) > 0){
			View::make('luokat/muokkaa_luokkaa.html', 
					    array('errors' => $errors, 
					    	  'luokka' => $luokka));
		}else{
			$luokka->update();
			Redirect::to('/luokat', array('message' => 'Luokan nimi päivitetty onnistuneesti!'));
		}		
	}

	public static function delete($ltunnus) {
    	$luokka = new Luokka(array('ltunnus' => $ltunnus));
    	$luokka->delete();
    	Redirect::to('/luokat', array('message' => 'Luokka on poistettu onnistuneesti!'));
	}
}
