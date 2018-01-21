<?php

class Askare extends BaseModel{
	
	public $atunnus, $laatija, $nimi, $kiireellisyys, $lisatiedot, $status, $askareenLuokat;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validoi_tyhjyys', 'validoi_nimen_pituus', 'validoi_kiireellisyys', 'validoi_lisatiedon_pituus');
	}

	public function kiireellisyys(){
		return $this->kiireellisyys;
	}

	public function status(){
		return $this->status;
	}

	//Palauttaa KAIKKI askareet.
	public static function all($laatija){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Askare
				WHERE laatija = :laatija
				ORDER BY Askare.kiireellisyys DESC');
		$query->execute(array('laatija' => $laatija));
		$rows = $query->fetchAll();
		$askareet = array();

		foreach($rows as $row){
			$askareet[] = new Askare(array(
				'atunnus' => $row['atunnus'],
				'laatija' => $row['laatija'],
				'nimi' => $row['nimi'],
				'kiireellisyys' => $row['kiireellisyys'],
				'lisatiedot' => $row['lisatiedot'],
				'status' => $row['status'],
				'askareenLuokat' => Askareen_luokka::findValitutLuokat($row['atunnus'])
			));
		}
		return $askareet;
	}


	//Palauttaa yhden askareen sen id:n perusteella.
	public static function find($atunnus, $laatija){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Askare 
				WHERE atunnus = :atunnus
				AND laatija = :laatija
				LIMIT 1');
		$query->execute(array('atunnus' => $atunnus,
							  'laatija' => $laatija));
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
			return $askare;
		}
		return null;
	}


	//TOIMII - Tallentaa käyttäjän lisäämän tietokohteen
	public function save(){
    	$query = DB::connection()->prepare('
    			INSERT INTO Askare (laatija, nimi, kiireellisyys, lisatiedot, status) 
    			VALUES (:laatija, :nimi, :kiireellisyys, :lisatiedot, 0) RETURNING atunnus');
    	$query->execute(array(
    			'laatija' => $this->laatija,
    			'nimi' => $this->nimi, 
    			'kiireellisyys' => $this->kiireellisyys,
    			'lisatiedot' => $this->lisatiedot));
    	$row = $query->fetch();
    	$this->atunnus = $row['atunnus'];
	}

	public function update(){
		$query = DB::connection()->prepare('
    			UPDATE Askare 
    			SET nimi = :nimi, 
    				kiireellisyys = :kiireellisyys, 
    				lisatiedot = :lisatiedot, 
    				status = :status
    			WHERE atunnus = :atunnus
    			RETURNING atunnus');
    	$query->execute(array(
    			'atunnus' => $this->atunnus,
    			'nimi' => $this->nimi, 
    			'kiireellisyys' => $this->kiireellisyys,
    			'lisatiedot' => $this->lisatiedot,
    			'status' => $this->status));
	}

	public function delete(){
		$query = DB::connection()->prepare('
    			DELETE FROM Askareen_luokka 
    			WHERE atunnus = :atunnus');
    	$query->execute(array('atunnus' => $this->atunnus));
    	$row = $query->fetch();

		$query = DB::connection()->prepare('
    			DELETE FROM Askare 
    			WHERE atunnus = :atunnus');
    	$query->execute(array('atunnus' => $this->atunnus));
    	$row = $query->fetch();
	}

}