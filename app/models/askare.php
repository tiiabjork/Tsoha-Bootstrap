<?php

class Askare extends BaseModel{
	
	public $atunnus, $laatija, $kuvaus, $kiireellisyys, $luokat, $lisatiedot;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	//hakee KAIKKI askareet, all()
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Askare');
		$query->execute();
		$rows = $query->fetchAll();
		$askareet = array();

		foreach($rows as $row){
			$askareet[] = new Askare(array(
				'atunnus' => $row['atunnus'],
				'laatija' => $row['laatija'],
				'kuvaus' => $row['kuvaus'],
				'kiireellisyys' => $row['kiireellisyys'],
				'luokat' => $row['luokat'],
				'lisatiedot' => $row['lisatiedot']
			));
		}
		return $askareet;
	}


	//Etsii yhden askareen, find()
	public static function find($atunnus){
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE atunnus = :atunnus LIMIT 1');
		$query->execute(array('atunnus' => $atunnus));
		$row = $query->fetch();

		if($row){
			$askare = new Askare(array(
			'atunnus' => $row['atunnus'],
			'laatija' => $row['laatija'],
			'kuvaus' => $row['kuvaus'],
			'kiireellisyys' => $row['kiireellisyys'],
			'luokat' => $row['luokat'],
			'lisatiedot' => $row['lisatiedot']
		));
			return $askare;
		}

		
		return null;
	}


	//Tallentaa käyttäjän lisäämän tietokohteen
	public static function save(){

	}

}