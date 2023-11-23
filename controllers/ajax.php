<?php

class Ajax_Controller {
	public $baseName = 'ajax';

	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName . "_main");
	}
}
