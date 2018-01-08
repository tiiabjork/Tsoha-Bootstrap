<?php

class Luokka extends BaseModel{
	
	public $atunnus, $laatija, $nimi;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validoi_tyhjyys', 'validoi_pituus', 'validoi_tupla_luokka');
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
				'nimi' => $row['nimi']
			));
		}
		return $luokat;
	}

	//Palauttaa yhden luokan sen tunnuksen perusteella.
	public static function find($ltunnus){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Luokka 
				WHERE ltunnus = :ltunnus 
				LIMIT 1');
		$query->execute(array('ltunnus' => $ltunnus));
		$row = $query->fetch();

		if($row){	
			$luokka = new Luokka(array(
			'ltunnus' => $row['ltunnus'],
			'laatija' => $row['laatija'],
			'nimi' => $row['nimi']
		));
		return $luokka;
		}	
		return null;
	}

	public function save(){
    	$query = DB::connection()->prepare('INSERT INTO Luokka (nimi) 
    		VALUES (:nimi) RETURNING ltunnus');
    	$query->execute(array('nimi' => $this->nimi));
    	$row = $query->fetch();
	}

	public function delete(){
		$query = DB::connection()->prepare('
    			DELETE FROM Askareen_luokka
    			WHERE ltunnus = :ltunnus');
    	$query->execute(array('ltunnus' => $this->ltunnus));
    	$row = $query->fetch();

		$query = DB::connection()->prepare('
    			DELETE FROM Luokka 
    			WHERE ltunnus = :ltunnus');
    	$query->execute(array('ltunnus' => $this->ltunnus));
    	$row = $query->fetch();
	}

}