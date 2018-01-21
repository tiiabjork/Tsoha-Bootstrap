<?php

class Askareen_luokka extends BaseModel{
	
	public $atunnus, $ltunnus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

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

	public static function findValitutLuokat($atunnus){
		$query = DB::connection()->prepare('
				SELECT Luokka.ltunnus, laatija, nimi 
				FROM Luokka, Askareen_luokka 
				WHERE Luokka.ltunnus = Askareen_luokka.ltunnus
					AND atunnus = :atunnus
				');
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

	public static function findEiValitutLuokat($atunnus, $laatija){
		$query = DB::connection()->prepare('
				SELECT Luokka.ltunnus, laatija, nimi
				FROM Luokka
				LEFT JOIN (
					SELECT ltunnus
					FROM Askareen_luokka
					WHERE atunnus = :atunnus) AS a
				ON Luokka.ltunnus = a.ltunnus
				WHERE a.ltunnus IS NULL
					AND laatija = :laatija
				');
		$query->execute(array(
				'atunnus' => $atunnus,
				'laatija' => $laatija));
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
	//TARVITSEEKO???
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

	public static function save($atunnus, $uudetLuokat){
		foreach($uudetLuokat as $ltunnus){
			//Tarkastetaan ensin, löytyykö yhdistelmä jo taulusta
			$query = DB::connection()->prepare('
				SELECT *
				FROM Askareen_luokka
				WHERE atunnus = :atunnus AND ltunnus = :ltunnus
				LIMIT 1');
			$query->execute(array('atunnus' => $atunnus, 'ltunnus' => $ltunnus));
			$row = $query->fetch();

			if(!$row) {
    			$query = DB::connection()->prepare('
    					INSERT INTO Askareen_luokka (atunnus, ltunnus) 
    					VALUES (:atunnus, :ltunnus)');
    			$query->execute(array('atunnus' => $atunnus, 
    								  'ltunnus' => $ltunnus));
    		}
		}
	}

	public static function delete($atunnus, $poistetutLuokat){
		foreach($poistetutLuokat as $ltunnus){
			$query = DB::connection()->prepare('
    			DELETE FROM Askareen_luokka 
    			WHERE atunnus = :atunnus
    			AND ltunnus = :ltunnus');
    		$query->execute(array('atunnus' => $atunnus,
    							  'ltunnus' => $ltunnus));
    	}
		
	}


}