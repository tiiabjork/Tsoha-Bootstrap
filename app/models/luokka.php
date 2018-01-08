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

public function save(){
	//men ole varma pitääkö mitään edes returnaa!
    $query = DB::connection()->prepare('INSERT INTO Luokka (kuvaus) 
    	VALUES (:kuvaus) RETURNING ltunnus');
    $query->execute(array('kuvaus' => $this->kuvaus));
    $row = $query->fetch();
    //$this->ltunnus = $row['ltunnus'];
	}


}