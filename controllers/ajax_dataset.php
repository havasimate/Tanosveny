<?php

class Ajax_Dataset_Controller
{
	public $baseName = 'ajax_dataset';

	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName . "_main");
	}
}
