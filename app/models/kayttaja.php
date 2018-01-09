<?php

class Kayttaja extends BaseModel{
	
	public $id, $kayttajatunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($kayttajatunnus, $salasana){
		$query = DB::connection()->prepare('
				SELECT * 
				FROM Kayttaja 
				WHERE kayttajatunnus = :kayttajatunnus 
				AND salasana = :salasana
				LIMIT 1');
		$query->execute(array(
				'kayttajatunnus' => $kayttajatunnus, 
				'salasana' => $salasana));
		$row = $query->fetch();
		if($row){
			$kayttaja = new Kayttaja(array(
				'kayttajatunnus' => $kayttajatunnus,
				'salasana' => $salasana
			));
			return $kayttaja;
		}else{
			return null;
		}
	}

	//Palauttaa KAIKKI käyttäjät.
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja');
		$query->execute();
		$rows = $query->fetchAll();
		$kayttajat = array();

		foreach($rows as $row){
			$kayttajat[] = new Kayttaja(array(
				'id' => $row['id'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana']
			));
		}
		return $kayttajat;
	}

	//Palauttaa yhden käyttäjän id:n perusteella.
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id);
		$row = $query->fetch();

		if($row){	
			$kayttaja = new Kayttaja(array(
			'id' => $row['id'],
			'kayttajatunnus' => $row['kayttajatunnus'],
			'salasana' => $row['salasana']
		));
		return $kayttaja;
		}
		return null;
	}



}