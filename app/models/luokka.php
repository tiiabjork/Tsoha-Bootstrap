<?php

class Luokka extends BaseModel{
	
	public $ltunnus, $laatija, $nimi;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validoi_tyhjyys', 'validoi_nimen_pituus', 'validoi_tupla_luokka');
	}


	//Palauttaa KAIKKI luokat.
	public static function all($laatija){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Luokka
				WHERE laatija = :laatija');
		$query->execute(array('laatija' => $laatija));
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
    	$query = DB::connection()->prepare('INSERT INTO Luokka (laatija, nimi) 
    		VALUES (:laatija, :nimi) RETURNING ltunnus');
    	$query->execute(array(
    			'nimi' => $this->nimi,
    			'laatija' => $this->laatija));
    	$row = $query->fetch();
	}

	public function update(){
		$query = DB::connection()->prepare('
    			UPDATE Luokka 
    			SET nimi = :nimi
    			WHERE ltunnus = :ltunnus
    			AND laatija = :laatija');
    	$query->execute(array(
    			'ltunnus' => $this->ltunnus,
    			'laatija' => $this->laatija,
    			'nimi' => $this->nimi));
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