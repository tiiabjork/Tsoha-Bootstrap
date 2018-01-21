<?php

class AskareController extends BaseController {


	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	public static function store(){
		$kayttaja = self::get_user_logged_in();
		$params = $_POST;
		$attribuutit = array(
			'laatija' => $kayttaja->id,
			'nimi' => $params['nimi'],
			'kiireellisyys' => $params['kiireellisyys'],
			'lisatiedot' => $params['lisatiedot']
		);

		$askare = new Askare($attribuutit);
		$errors = $askare->errors();

		if(count($errors) == 0){
			$askare->save();
			Redirect::to('/askareet/' . $askare->atunnus, 
					array('message' => 'Askare on lisätty muistilistaasi!'));
		}else{
			View::make('askareet/lisaa_askare.html', array('errors' => $errors, 'attribuutit' => $attribuutit));
		}		
	}

	public static function find($atunnus) {
		$kayttaja = self::get_user_logged_in();
		$askare = Askare::find($atunnus, $kayttaja->id);
		$askareenLuokat = Askareen_luokka::findValitutLuokat($atunnus);
		View::make('askareet/nayta_askare.html', 
					array('askare' => $askare,
						  'askareenLuokat' => $askareenLuokat));
	}

	
	public static function muutaTietoja($atunnus) {
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$askare = Askare::find($atunnus, $laatija);
		$kiireellisyys = $askare->kiireellisyys();
		$status = $askare->status();
		$valitutLuokat = Askareen_luokka::findValitutLuokat($atunnus);
		$eiValitutLuokat = Askareen_luokka::findEiValitutLuokat($atunnus, $laatija);
		View::make('askareet/muokkaa_askaretta.html', 
					array('askare' => $askare, 
						  'kiireellisyys' => $kiireellisyys,
						  'status' => $status,
						  'valitutLuokat' => $valitutLuokat,
						  'eiValitutLuokat' => $eiValitutLuokat));
	}

	public static function update($atunnus) {
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$params = $_POST;
		$status = 1;
		//Jos checkbox on rastimatta, on arvo tyhjä.
		if(empty($params['status'])){
			$status = 0;
		}

		$attribuutit = array(
			'atunnus' => $atunnus,
			'nimi' => $params['nimi'],
			'kiireellisyys' => $params['kiireellisyys'],
			'lisatiedot' => $params['lisatiedot'],
			'status' => $status,
			'uudetLuokat' => array(),
			'poistetutLuokat' => array()
		);

		// Käydään läpi luokat, jotka poistettiin askareen listasta
		if(empty($params['poistetutLuokat'])){
			$poistetutLuokat = null;
		}else{
			$poistetutLuokat = $params['poistetutLuokat'];
			
			foreach($poistetutLuokat as $luokka){
			$attribuutit['poistetutLuokat'][] = $luokka;
		    }
		}

		// Käydään läpi luokat, jotka valittiin uutena askareelle
		if(empty($params['uudetLuokat'])){
			$uudetLuokat = null;
		}else{
			$uudetLuokat = $params['uudetLuokat'];
			
			foreach($uudetLuokat as $luokka){
			$attribuutit['uudetLuokat'][] = $luokka;
		    }
		}

		$askare = new Askare($attribuutit);
		$errors = $askare->errors();

		if(count($errors) > 0){
			View::make('askareet/muokkaa_askaretta.html', 
					    array('errors' => $errors, 
					    	  'askare' => $askare, 
						      'kiireellisyys' => $attribuutit['kiireellisyys'],
						      'status' => $attribuutit['status'],
						      'valitutLuokat' => Askareen_luokka::findValitutLuokat($atunnus),
						      'eiValitutLuokat' => Askareen_luokka::findEiValitutLuokat($atunnus, $laatija),
						      'kaikkiLuokat' => Luokka::all($laatija)));
		}else{
			$askare->update();
			Askareen_luokka::save($atunnus, $attribuutit['uudetLuokat']);
			Askareen_luokka::delete($atunnus, $attribuutit['poistetutLuokat']);
			Redirect::to('/askareet/' . $atunnus, 
					array('message' => 'Askare on päivitetty onnistuneesti!'));
		}		
	}

	public static function delete($atunnus) {
    	$askare = new Askare(array('atunnus' => $atunnus));
    	$askare->delete();
    	Redirect::to('/askareet', array('message' => 'Askare on poistettu onnistuneesti!'));
	}

	public static function listaaKaikkiAskareetMuokkaus(){
		$kayttaja = self::get_user_logged_in();
		$laatija = $kayttaja->id;
		$askareet = Askare::all($laatija);
		View::make('askareet/muokkaa_askareita.html', 
					array('askareet' => $askareet,
						  'kirjautunut_kayttaja' => $kayttaja));
	}


}


