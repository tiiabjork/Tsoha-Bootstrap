<?php

class KayttajaController extends BaseController {

	public static function kirjaudu(){
		View::make('etusivu/kirjautuminen.html');
	}

	public static function kasittele_kirjautuminen(){
		$params = $_POST;

		$kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

		if(!$user){
			View::make('etusivu/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' =>$params['kayttajatunnus']))
		}else{
			$_SESSION['kayttaja'] = $kayttaja->id;

			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
		}
	}

	public static function rekisteroidy(){
    	View::make('yleiset/rekisteroityminen.html');
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
			//Ei tule erroreita
			$luokka->save();
			Redirect::to('/luokat', array('message' => 'Luokka lisätty onnistuneesti!'));
		}else{
			//Askareen tiedoissa on jotain häikkää
			$luokat = Luokka::all();
			View::make('luokat/muokkaa_luokkia.html', array('errors' => $errors, 'luokat' => $luokat));
		}
	}

	public static function delete() {
	}

}
