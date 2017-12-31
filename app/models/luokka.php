<?php

class Luokka extends BaseModel{
	
	public $atunnus, $laatija, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}


	//hakee KAIKKI luokat, all()
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


	//Etsii yhden, find()

		

    //Hakee kaikki yhden ihmisen askareet
	public static function findAll($id){
		$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE laatija = :id');
		$query->execute(array('laatija' => $id));
		$rows = $query->fetchAll();
		$luokat = array();

		foreach($rows as $row){
			$luokat[] = new Luokka(array(
				'atunnus' => $row['atunnus'],
				'laatija' => $row['laatija'],
				'kuvaus' => $row['kuvaus']
			));
		}
		return $luokat;
	}

}