<?php

class Askare extends BaseModel{
	
	public $atunnus, $laatija, $kuvaus, $kiireellisyys, $luokat;

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
				'luokat' => $row['luokat']
			));
		}
		return $askareet;
	}

	//Etsii yhden, find()

		//Hakee kaikki yhden ihmisen askareet
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
			'luokat' => $row['luokat']
		));
			return $askare;
		}

		
		return null;
	}

		//Hakee kaikki yhden ihmisen askareet
	public static function findAll($id){
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE laatija = :id');
		$query->execute(array('laatija' => $id));
		$rows = $query->fetchAll();
		$askareet = array();

		foreach($rows as $row){
			$askareet[] = new Askare(array(
				'atunnus' => $row['atunnus'],
				'laatija' => $row['laatija'],
				'kuvaus' => $row['kuvaus'],
				'kiireellisyys' => $row['kiireellisyys'],
				'onkoLuokkia' => $row['onkoLuokkia']
			));
		}
		return $askareet;
	}

}