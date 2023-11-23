<?php

class Logout_Model
{
	public function get_data(): array
	{
		$retData['eredmény'] = "OK";
		$retData['uzenet'] = "Sikeres kijelentkezés!";
		$_SESSION['userid'] = 0;
		$_SESSION['userlastname'] = "";
		$_SESSION['userfirstname'] = "";
		$_SESSION['userlevel'] = "1__";
		Menu::setMenu();
		return $retData;
	}
}
