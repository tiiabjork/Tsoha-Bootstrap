<?php

class Askare extends BaseModel{
	
	public $atunnus, $laatija, $kuvaus, $kiireellisyys, $onkoLuokkia;

	public function __construct($attributes){
		prent::__construct($attributes);
		this->onkoLuokkia = FALSE;
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
		return 'ehyyye';
		return $askareet;
	}

	//hakee KAIKKI askareet
	public static function all($){
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
				'onkoLuokkia' => $row['onkoLuokkia']
			));
		}
		return $askareet;
	}

}