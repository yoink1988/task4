<?php

function __autoload($classname)
{
	if(file_exists(ROOT.'/lib/'.$classname.'.php'))
	{
		include_once ROOT.'/lib/'.$classname.'.php';
	}
}

