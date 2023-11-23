<?php

class Chart_Controller
{
	public $baseName = 'chart';

	public function main(array $vars)
	{
		$sumTanosvenyModel = new Sumtanosveny_Model;
		$retData = $sumTanosvenyModel->get_data($vars);

		$view = new View_Loader($this->baseName . "_main");
		foreach ($retData as $name => $value)
			$view->assign($name, $value);
	}
}
