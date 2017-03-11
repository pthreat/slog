<?php

namespace myProject{

    /**
     * Add the loggable interface to indicate to other class methods 
     * that this class has logging capabilities.
     */

    use \stange\logging\slog\iface\Loggable    as    LoggableInterface;

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
