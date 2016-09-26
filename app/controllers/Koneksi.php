<?php 

class Koneksi {
	public $db;
	public function koneksi()
	{
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$dbname = 'crud';
		
		$db = mysql_connect($host,$user,$pass,$dbname);
		return $this->db;
	}
}