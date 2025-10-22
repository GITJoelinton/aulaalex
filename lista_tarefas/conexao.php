<?php

class Conexao {

	private $host = 'localhost';
	private $dbname = 'if0_40124646_joelinto';
	private $user = 'if0_40124646';
	private $pass = 'joel1240';

	public function conectar() {
		try {

			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"				
			);

			return $conexao;


		} catch (PDOException $e) {
			echo '<p>'.$e->getMessege().'</p>';
		}
	}
}

?>