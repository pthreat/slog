<?php

	require __DIR__.'/../src/iface/Log.php';
	require __DIR__.'/../src/Slog.php';
	require __DIR__.'/../src/traits/Loggable.php';
	require __DIR__.'/../src/iface/Loggable.php';

	try{

		$log	=	new stange\logging\Slog([
														'tagId'	=>	'@@@',
														'tags'	=>	['v','vv']
		]);

		$log->log('v@@@This is a verbose message');
		$log->log('vv@@@This is a more verbose message');

		//The following message with the "vvv" tag will not be shown, since it's not on the tag list
		$log->log('vvv@@@This is a more "morer" (joking) verbose message');

		//Add the vvv tag
		$log->addTag('vvv');

		$log->log('vvv@@@This is a more "morer" (joking) verbose message now it is shown, because we added the "vvvv" tag');

		//Log everything, please note that the TAG parsing still remains!
		$log->unsetTags();

		$log->log('v@@@The tag parsing still remains, so if you want to log everything minus the tags, you can do it');
		$log->setTagId(NULL);
		$log->log('v@@@Or you can show tags and everything, your choice');

		$log->log('test message');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		//Set date
		$log->useDate(TRUE,'Y-m-d H:i:s');
		$log->log('Add date to every message');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		//Colorize off
		$log->useColors(FALSE);
		$log->useDate(TRUE,'Y-m-d ');
		$log->log('No colors');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		//Prepend a string

		$log->setPrepend('added string! ');
		$log->log('Prepend string');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		$log->setAppend(' ! append string ');
		$log->log('Append string');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		$log->setPrepend(NULL);
		$log->setAppend(NULL);

		$log->setFile('test.log');
		$log->log('write to file');
		$log->debug('Debug');
		$log->info('Info');
		$log->warning('Warning');
		$log->error('Error');
		$log->emergency('Emergency');
		$log->success('Success');

		$log->log('Set No echo, the next message is only inside the file');
		$log->setEcho(FALSE);
		$log->log('This will only be seen inside of the log file! :D');

	}catch(\Exception $e){

		echo $e->getMessage();

	}
