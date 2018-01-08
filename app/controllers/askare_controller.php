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
	public static function listaaKaikkiAskareet(){
		$askareet = Askare::all();
		View::make('askareet/askarelistaus.html', 
					array('askareet' => $askareet));
	}

	//TOIMII - Avaa lomakkeen, jolla voi tallentaa uuden askareen.
	public static function create(){
		View::make('askareet/lisaa_askare.html');
	}

	//TOIMII - Poimii lomakkeelle tallennetut tiedot tallennettavaksi tietokantaan.
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
			//Ei tule erroreita
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
	
	//Ei vielä toiminnasssa.
	public static function muutaTietoja($atunnus) {
		$askare = Askare::find($atunnus);
		$kiireellisyys = $askare->kiireellisyys();
		$valitutLuokat = Askareen_luokka::findValitutLuokat($atunnus);
		$kaikkiLuokat = Luokka::all();
		View::make('askareet/muokkaa_askaretta.html', 
					array('askare' => $askare, 
						  'kiireellisyys' => $kiireellisyys,
						  'valitutLuokat' => $valitutLuokat,
						  'kaikkiLuokat' => $kaikkiLuokat));

	}

	// Ei vielä varmaa tuleeko toiminnallisuudeksi lopulta.
	public static function listaaKaikkiAskareetMuokkaus(){
		$askareet = Askare::all();
		View::make('askareet/muokkaa_askareita.html', 
					array('askareet' => $askareet));
	}


}


