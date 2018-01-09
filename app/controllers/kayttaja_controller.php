<?php

class KayttajaController extends BaseController {

	public static function kirjaudu(){
		View::make('yleiset/kirjautuminen.html');
	}

	public static function kasittele_kirjautuminen(){
		$params = $_POST;

		$kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

		if(!$kayttaja){
			View::make('yleiset/kirjautuminen.html', 
				array('error' => 'Väärä käyttäjätunnus tai salasana!','kayttajatunnus' =>$params['kayttajatunnus']));
		}else{
			$_SESSION['user'] = $kayttaja->id();

			Redirect::to('/askareet', array(
						'message' => 'Tervetuloa takaisin ' . $kayttaja->kayttajatunnus . '!'));
		}
	}

	public static function rekisteroidy(){
    	View::make('yleiset/rekisteroityminen.html');
    }


}
