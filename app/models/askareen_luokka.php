<?php

class Askareen_luokka extends BaseModel{
	
	public $atunnus, $ltunnus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	//hakee kaikkien askareiden kaikki luokat, all()
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Askareen_luokka');
		$query->execute();
		$rows = $query->fetchAll();
		$askareiden_luokat = array();

		foreach($rows as $row){
			$askareiden_luokat[] = new Askareen_luokka(array(
				'atunnus' => $row['atunnus'],
				'ltunnus' => $row['ltunnus']
			));
		}
		return $askareiden_luokat;
	}


	//Etsii yhden askareen kaikki luokat, find(atunnus). Palauttaa listan luokista.
	public static function findLuokat($atunnus){
		$kaikkiYhdistelmat = Askareen_luokka::all();
		$kaikkiLuokat = Luokka::all();
		$palautettavatLuokat = array();
		$i = 0;
		$j = 0;

		foreach($kaikkiYhdistelmat as $var){
			if ($atunnus == $var['atunnus']) {
				$palautettavatLuokat[] = Luokka::find($atunnus);
				$j++;
			}	
			$i++;	
		}
		return $palautettavatLuokat;
	}

	//Etsii yhden luokan kaikki askareet, find(ltunnus). Palauttaa listan askareista.
	public static function findAskareet($ltunnus){
		$kaikkiYhdistelmat = Askareen_luokka::all();
		$kaikkiAskareet = Askare::all();
		$palautettavatAskareet = array();
		$i = 0;
		$j = 0;

		foreach($kaikkiYhdistelmat as $yhdistelma){
			if ($this->ltunnus == $ltunnus) {
				$palautettavatLuokat[] = Askare::find($this->atunnus);
				$j++;
			}	
			$i++;	
		}
		return $palautettavatAskareet;
	}

	//Tallentaa käyttäjän lisäämän tietokohteen
	public static function save(){

	}

}