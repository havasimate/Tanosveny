<?php

class Admission_Model
{
	public function get_data($vars): array
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sqlSelect = "select id, csaladi_nev, utonev, bejelentkezes, jogosultsag from felhasznalok where bejelentkezes=:bejelentkezes and jelszo=:jelszo";
			$stmt = $connection->prepare($sqlSelect);
			$stmt->execute(array(
				':bejelentkezes' => $vars['login'],
				':jelszo' => sha1($vars['password'])
			));
			$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			switch (count($felhasznalo)) {
				case 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Helytelen felhasználói név-jelszó pár!";
					break;
				case 1:
					$retData['eredmeny'] = "OK";
					$retData['uzenet'] = "Sikeres bejelentkezés!";
					$_SESSION['userid'] = $felhasznalo[0]['id'];
					$_SESSION['username'] = $felhasznalo[0]['bejelentkezes'];
					$_SESSION['userlastname'] = $felhasznalo[0]['csaladi_nev'];
					$_SESSION['userfirstname'] = $felhasznalo[0]['utonev'];
					$_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
					Menu::setMenu();
					break;
				default:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Hiba!";
			}
		} catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
		}
		return $retData;
	}
}
