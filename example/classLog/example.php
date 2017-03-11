<?php

	namespace myProject;

	require __DIR__.'/../../src/iface/Log.php';
	require __DIR__.'/../../src/Slog.php';
	require __DIR__.'/../../src/traits/Loggable.php';
	require __DIR__.'/../../src/iface/Loggable.php';

	require "MyClasses.php";

	use \stange\logging\Slog;

	$log     =  new Slog([
									'tagId'	=>	'@@@',
									'tags'	=>	'stuff'
	]);

	$myClass      = new MyClass();
	$myOtherClass = new MyOtherClass();

	$myClass->setLog($log);
	$myOtherClass->setLog($log);

	$myClass->doStuff();
	$myClass->doOtherStuff();
	$myOtherClass->doSomething();
