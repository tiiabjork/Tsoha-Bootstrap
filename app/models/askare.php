<?php

class Askare extends BaseModel{
	
	public $atunnus, $laatija, $nimi, $kiireellisyys, $lisatiedot, $status;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	//Palauttaa KAIKKI askareet.
	public static function all(){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Askare
				ORDER BY Askare.kiireellisyys DESC');
		$query->execute();
		$rows = $query->fetchAll();
		$askareet = array();

		foreach($rows as $row){
			$askareet[] = new Askare(array(
				'atunnus' => $row['atunnus'],
				'laatija' => $row['laatija'],
				'nimi' => $row['nimi'],
				'kiireellisyys' => $row['kiireellisyys'],
				'lisatiedot' => $row['lisatiedot'],
				'status' => $row['status']
			));
		}
		return $askareet;
	}


	//Palauttaa yhden askareen sen id:n perusteella.
	public static function find($atunnus){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Askare 
				WHERE atunnus = :atunnus 
				LIMIT 1');
		$query->execute(array('atunnus' => $atunnus));
		$row = $query->fetch();

		if($row){	
			$askare = new Askare(array(
			'atunnus' => $row['atunnus'],
			'laatija' => $row['laatija'],
			'nimi' => $row['nimi'],
			'kiireellisyys' => $row['kiireellisyys'],
			'lisatiedot' => $row['lisatiedot'],
			'status' => $row['status']
		));
			// Luokkiin tarkoitus tuoda listaus askareen luokista. luokat' => Askareen_luokka::findLuokat($atunnus) (?)
			return $askare;
		}
		return null;
	}


	//TOIMII - Tallentaa käyttäjän lisäämän tietokohteen
	public function save(){

    $query = DB::connection()->prepare('INSERT INTO Askare (nimi, kiireellisyys, lisatiedot, status) 
    	VALUES (:nimi, :kiireellisyys, :lisatiedot, 0) RETURNING atunnus');
    $query->execute(array('nimi' => $this->nimi, 
    					'kiireellisyys' => $this->kiireellisyys,
    					'lisatiedot' => $this->lisatiedot));
    $row = $query->fetch();
    $this->atunnus = $row['atunnus'];
	}

}