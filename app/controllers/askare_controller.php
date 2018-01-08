<?php

class AskareController extends BaseController {

	// Täältä löytyy varsinaisen ohjelman koodit.

    public static function index(){
        View::make('yleiset/etusivu.html');
    }

    //Ei vielä toiminnassa.
    public static function kirjaudu(){
    	View::make('yleiset/kirjautuminen.html');
    }

    //Ei vielä toiminnassa.
    public static function rekisteroidy(){
    	View::make('yleiset/rekisteroityminen.html');
    }

    //TOIMII - Listaa kaikki askareet.
	//public static function listaaKaikkiAskareet(){
	//	$askareet = Askare::all();
	//	View::make('askareet/askarelistaus.html', 
	//				array('askareet' => $askareet));
	//}

	//TOIMII - Avaa lomakkeen, jolla voi tallentaa uuden askareen.
	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	//Poimii lomakkeelle tallennetut tiedot tallennettavaksi tietokantaan.
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
			//Syöte ok -> tallentaa tietokantaan
			$askare->save();
			Redirect::to('/askareet/' . $askare->atunnus, 
					array('message' => 'Askare on lisätty muistilistaasi!'));
		}else{
			//Askareen tiedoissa on jotain häikkää
			View::make('askareet/lisaa_askare.html', array('errors' => $errors, 'attribuutit' => $attribuutit));
		}		
	}


	//TOIMII - Etsii tietyn askareen.
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
		$kaikkiLuokat = Luokka::all();
		View::make('askareet/muokkaa_askaretta.html', 
					array('askare' => $askare, 
						  'kiireellisyys' => $kiireellisyys,
						  'status' => $status,
						  'valitutLuokat' => $valitutLuokat,
						  'kaikkiLuokat' => $kaikkiLuokat));
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
			'status' => $status
		);

		$askare = new Askare($attribuutit);
		$errors = $askare->errors();

		if(count($errors) > 0){
			View::make('askareet/muokkaa_askaretta.html', array('errors' => $errors, 'attribuutit' => $attribuutit));
		}else{
			$askare->update();
			Redirect::to('/askareet/' . $atunnus, 
					array('message' => 'Askare on päivitetty onnistuneesti!'));
		}		
	}

	public static function delete($atunnus) {
    	$askare = new Askare(array('atunnus' => $atunnus));
    	$askare->destroy();
    	Redirect::to('/askareet', array('message' => 'Askare on poistettu onnistuneesti!'));
	}

	public static function listaaKaikkiAskareetMuokkaus(){
		$askareet = Askare::all();
		View::make('askareet/muokkaa_askareita.html', 
					array('askareet' => $askareet));
	}


}


