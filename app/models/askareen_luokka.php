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

	//Etsii yhden askareen kaikki luokat, findLuokat(atunnus). Palauttaa listan luokista.
	public static function findValitutLuokat($atunnus){
		$query = DB::connection()->prepare('
				SELECT Luokka.ltunnus, laatija, nimi 
				FROM Luokka, Askareen_luokka 
				WHERE Luokka.ltunnus = Askareen_luokka.ltunnus
					AND atunnus = :atunnus
				');
		//seuraavan rivin array antaa yläpuolella olevalle :atunnukselle jotain
		$query->execute(array('atunnus' => $atunnus));
		$rows = $query->fetchAll();
		$valitutLuokat = array();

		foreach($rows as $row){
			$valitutLuokat[] = new Luokka(array(
				'ltunnus' => $row['ltunnus'],
				'laatija' => $row['laatija'],
				'nimi' => $row['nimi']
			));
		}
		return $valitutLuokat;
	}

	public static function findEiValitutLuokat($atunnus){
		$query = DB::connection()->prepare('
				SELECT Luokka.ltunnus, laatija, nimi 
				FROM Luokka, Askareen_luokka 
				WHERE Luokka.ltunnus NOT IN 
					(SELECT ltunnus FROM Askareen_luokka WHERE atunnus = :atunnus)
					AND Luokka.ltunnus = Askareen_luokka.ltunnus
				');
		$query->execute(array('atunnus' => $atunnus));
		$rows = $query->fetchAll();
		$eiValitutLuokat = array();

		foreach($rows as $row){
			$eiValitutLuokat[] = new Luokka(array(
				'ltunnus' => $row['ltunnus'],
				'laatija' => $row['laatija'],
				'nimi' => $row['nimi']
			));
		}
		return $eiValitutLuokat;
	}

	//Etsii yhden luokan kaikki askareet, findAskareet(ltunnus). Palauttaa listan askareista.
	public static function findAskareet($ltunnus){
		$query = DB::connection()->prepare('
				SELECT atunnus 
				FROM Askareen_luokka 
				WHERE ltunnus = :ltunnus
				');
		$query->execute();
		$rows = $query->fetchAll();
		$luokan_askareet = array();

		foreach($rows as $row){
			$luokan_askareet[] = new Askareen_luokka(array(
				'atunnus' => $row['atunnus']
			));
		}
		return $luokan_askareet;
	}

	//Tallentaa käyttäjän lisäämän tietokohteen
	public static function save(){

	}

}