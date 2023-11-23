<?php

class Logout_Controller
{
	public string $baseName = 'logout';

	public function main(array $vars)
	{
		$logoutModel = new Logout_Model;
		$retData = $logoutModel->get_data();
		$view = new View_Loader($this->baseName . '_main');
		foreach ($retData as $name => $value)
			$view->assign($name, $value);
	}
}
