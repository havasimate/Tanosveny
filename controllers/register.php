<?php

class Register_Controller
{
	public string $baseName = 'admission';

	public function main(array $vars)
	{
		$registerlModel = new Register_Model;
		$retData = $registerlModel->get_data($vars);
		if ($retData['eredmeny'] == "ERROR")
			$this->baseName = "login";
		$view = new View_Loader($this->baseName . '_main');
		foreach ($retData as $name => $value)
			$view->assign($name, $value);
	}
}
