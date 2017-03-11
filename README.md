# Slog (Simple Log)

**A simple PHP logging class**

## Preface

Slog is a simple PHP logging class which you can easily include in any of your projects.

## Getting started

### Clone the latest version from GIT
```
git clone https://github.com/pthreat/slog.git
```

### Add to your project via composer
```
composer require stange/slog
```

## Features

- ANSI output coloring
- Log to a file
- Log tags
- Prepend or append a log string
- Prefix your log messages with a specific date format

## Examples
#### Basic Example

```php
use \stange\logging\Slog;

$log	=	new Slog();
$log->log('Scotty, beam me up!');

```
---

#### Using specific log types types and ANSI coloring capabilities

Slog contains different methods for you to inform different types of log messages.
Also, by default, SLog will colorize your log output

```php
use \stange\logging\Slog;

$log	=	new Slog();

$log->log('test message');
$log->debug('Debug');
$log->info('Info');
$log->warning('Warning');
$log->error('Error');
$log->emergency('Emergency');
$log->success('Success');
```

Result:

![alt tag](https://raw.githubusercontent.com/pthreat/slog/master/screenshots/colors.png)

You can of course, disable output coloring

```php
use \stange\logging\Slog;

$log	=	new Slog([
                   'colors' => FALSE
]);

//You can disable colors at runtime too

//$log->useColors(FALSE);

$log->debug('Debug');
```
---

#### Log to a file

```php
use \stange\logging\Slog;

$log	=	new Slog([
                   'file'=>'out.log'
]);

$log->log('Log to a file (and to stdout)');
```

**NOTE:** ANSI colors will not be logged into the file

---

#### File only output example

In case you don't want to output to stdout, you can pass in **'echo'=>FALSE** in the constructor
or disable stdout output by using **Slog::setEcho(FALSE)**.

```php
use \stange\logging\Slog;

$log	=	new Slog([
                   'file'   => 'out.log',
                   'echo'   => FALSE

]);

$log->log("No stdout log, file only");

```
---

#### Log Tagging

###### Logging is a great thing, however sometimes the amount of logged information can be cumbersome.

** A cool feature of Slog is that you can tag your logs. **

#### Tag your logs? What do you mean?

I mean that you can use certain "tags" in your log messages for logging messages of a certain kind but not others of a different kind.

Here is a brief example of two tagged log messages:

```php
use \stange\logging\Slog;

$log	=	new Slog([
                   'tagId'=>'@@@'
]);

$log->log('tagOne@@@Hello! this is a tagged message with the tag tagOne');
$log->log('tagTwo@@@This is another tagged message with the tagTwo');

```

In the previous example, both messages will be logged and shown through stdout.

However, now, if we add a log tag to slog things will be a bit different.

Only messages which match the tag "tagOne" will be logged.
Messages containing the tag "tagTwo" will be discarded, i.e: not logged.

```php
$log	=	new Slog([
                       'tagId' => '@@@',   //Set the tag identifier to @@@
                       'tags'  => 'tagOne' //Log messages only from tagOne 
]);

$log->log('tagOne@@@Hello! this is a tagged message with the tag tagOne');

//The next message will not be logged since we specified that only messages
//containing the tag "tagOne" will be logged.

$log->log('tagTwo@@@This is another tagged message with the tagTwo');

```

You can log multiple tags if you need to, this would be a good idea when you want to increase your log verbosity

```php
$log	=	new Slog([
                       'tagId' => '@@@',              //Set the tag identifier to @@@
                       'tags'  => ['tagOne','tagTwo'] //Log messages from tagOne AND tagTwo
]);

$log->log('tagOne@@@Hello! this is a tagged message with the tag tagOne');
$log->log('tagTwo@@@This is another tagged message with the tagTwo');

```

#### Adding or removing log tags on the run

You can add or remove a tag at any given point in time through the methods:

- **Slog::removeTag($tag)** Removes a tag 
- **Slog::addTag($tag)** Specifies that messages containing a tag should be logged
- **Slog::unsetTags()** Log everything


# Loggable Trait and Loggable Interface

As an extra, I have included a simple logging trait which will enable you to use said trait
in your own classes to make said class "Loggable", this trait contains three main methods:

- **Loggable::setLog(LogInterface $log)**
- **Loggable::getLog()**
- **Loggable::log($message,$type=NULL)**

**NOTE:** The trait will also prepend the __CLASS__ name to the log, in this way, if you have multiple classes
which make use of the loggable trait, you can identify which logs come from one class and which other logs come 
from another

### Trait and Loggable interface implementation example

```php
namespace myProject{

	/**
	 * Add the loggable interface to indicate to other class methods 
	 * that this class has logging capabilities.
	 */

	use \stange\logging\slog\iface\Loggable	as	LoggableInterface;

	class MyClass implements LoggableInterface{

		//Make the class "Loggable" by using the loggable trait
		use \stange\logging\slog\traits\Loggable;

		public function doStuff(){

			$this->log('stuff@@@Doing stuff!');

		}

		public function doOtherStuff(){

			$this->log('otherStuff@@@Doing other stuff!','info');

		}

	}

	class MyOtherClass implements LoggableInterface{

		use \stange\logging\slog\traits\Loggable;

		public function doSomething(){

			$this->log('Doing something!','success');

		}

	}

}
```

### With the previous code we could easily do the following implementation

```php

	namespace myProject;

	use \stange\logging\Slog();

	$log     =  new Slog([
                              'tagId'	=>	'@@@',
										'tags'	=>	'stuff'
	]);

	$myClass      = new MyClass();
	$myOtherClass = new MyOtherClass();

	$myClass->setLog($log);
	$myOtherClass->setLog($log);

	$myClass->doStuff();
	$myClass->doingOtherStuff();
	$myOtherClass->doSomething();

```

