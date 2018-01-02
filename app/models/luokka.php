<?php

class Luokka extends BaseModel{
	
	public $atunnus, $laatija, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}


	//Palauttaa KAIKKI luokat.
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Luokka');
		$query->execute();
		$rows = $query->fetchAll();
		$luokat = array();

		foreach($rows as $row){
			$luokat[] = new Luokka(array(
				'ltunnus' => $row['ltunnus'],
				'laatija' => $row['laatija'],
				'kuvaus' => $row['kuvaus']
			));
		}
		return $luokat;
	}

	//Palauttaa yhden luokan sen tunnuksen perusteella.
	public static function find($ltunnus){
		$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE ltunnus = :ltunnus LIMIT 1');
		$query->execute(array('ltunnus' => $ltunnus));
		$row = $query->fetch();

		if($row){	
			$luokka = new Luokka(array(
			'ltunnus' => $row['ltunnus'],
			'laatija' => $row['laatija'],
			'kuvaus' => $row['kuvaus']
		));
		return $luokka;
		}	
		return null;
	}



}