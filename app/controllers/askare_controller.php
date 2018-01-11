<?php

class AskareController extends BaseController {


	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	public static function store(){
		$params = $_POST;
		$attribuutit = array(
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
		$askare = Askare::find($atunnus);
		$askareenLuokat = Askareen_luokka::findValitutLuokat($atunnus);
		View::make('askareet/nayta_askare.html', 
					array('askare' => $askare,
						  'askareenLuokat' => $askareenLuokat));
	}

	
	public static function muutaTietoja($atunnus) {
		$askare = Askare::find($atunnus);
		$kiireellisyys = $askare->kiireellisyys();
		$status = $askare->status();
		$valitutLuokat = Askareen_luokka::findValitutLuokat($atunnus);
		$eiValitutLuokat = Askareen_luokka::findEiValitutLuokat($atunnus);
		View::make('askareet/muokkaa_askaretta.html', 
					array('askare' => $askare, 
						  'kiireellisyys' => $kiireellisyys,
						  'status' => $status,
						  'valitutLuokat' => $valitutLuokat,
						  'eiValitutLuokat' => $eiValitutLuokat));
	}

	public static function update($atunnus) {
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
			'uudetLuokat' => array()
		);

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
						      'kaikkiLuokat' => Luokka::all()));
		}else{
			$askare->update();
			Askareen_luokka::save($atunnus, $attribuutit['uudetLuokat']);
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
		$askareet = Askare::all();
		$kirjautunut_kayttaja = self::get_user_logged_in();
		View::make('askareet/muokkaa_askareita.html', 
					array('askareet' => $askareet,
						  'kirjautunut_kayttaja' => $kirjautunut_kayttaja));
	}


}


