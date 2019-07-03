<?php
namespace VersatileCollections;

/**
 * Description of Utils
 *
 * @author rotimi
 */
class Utils {

    public static function getClosureFromCallable(callable $callable) {

        if( $callable instanceof \Closure) {
            
            return $callable;
        }
        
        if(method_exists(\Closure::class, 'fromCallable')) {
            return \Closure::fromCallable($callable);
        }

        return function () use ($callable) {
            return call_user_func_array($callable, func_get_args());
        };
    }

    public static function bindObjectAndScopeToClosure(\Closure $closure, $newthis, $newscope = "static") {

        try {
            
            $new_closure = \Closure::bind($closure, $newthis, $newscope);
            
            return $new_closure;
            
        } catch (\Exception $ex) {
            
            $function = __FUNCTION__;
            $class = static::class;
            $msg = "Error [{$class}::{$function}(...)]: Could not bind \$newthis to the supplied closure"
                . PHP_EOL . PHP_EOL . static::getExceptionAsStr($ex);

            // The bind failed
            throw new \InvalidArgumentException($msg);
        }
    }
    
    public static function getExceptionAsStr(\Exception $e) {
        
        $eol = PHP_EOL;
        $message = "Exception Code: {$e->getCode()}"
        . PHP_EOL . "Exception Class: " . get_class($e)
        . PHP_EOL . "File: {$e->getFile()}"
        . PHP_EOL . "Line: {$e->getLine()}"
        . PHP_EOL . "Message: {$e->getMessage()}" . PHP_EOL
        . PHP_EOL . "Trace: {$eol}{$e->getTraceAsString()}{$eol}{$eol}";

        $previous_exception = $e->getPrevious();

        while( $previous_exception instanceof \Exception ) {

            $message .= "Exception Code: {$previous_exception->getCode()}"
                . PHP_EOL . "Exception Class: " . get_class($previous_exception)
                . PHP_EOL . "File: {$previous_exception->getFile()}"
                . PHP_EOL . "Line: {$previous_exception->getLine()}"
                . PHP_EOL . "Message: {$previous_exception->getMessage()}" . PHP_EOL
                . PHP_EOL . "Trace: {$eol}{$previous_exception->getTraceAsString()}{$eol}{$eol}";
                
            $previous_exception = $previous_exception->getPrevious();
        } 
        
        return $message;
    }
}
