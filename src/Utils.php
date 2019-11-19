<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of Utils
 *
 * @author rotimi
 */
class Utils {

    public static function gettype($var): string {
        
        return is_object($var) ? get_class($var) : gettype($var);
    }

    public static function getClosureFromCallable(callable $callable): \Closure {

        return ($callable instanceof \Closure)? $callable : \Closure::fromCallable($callable);
    }

    public static function bindObjectAndScopeToClosure(\Closure $closure, $newthis): \Closure {

        try {
            
            $new_closure = \Closure::bind($closure, $newthis);
            
            return $new_closure;
            
        } catch (\Exception $ex) {
            
            $function = __FUNCTION__;
            $class = static::class;
            $msg = "Error [{$class}::{$function}(...)]: Could not bind \$newthis to the supplied closure"
                . PHP_EOL . PHP_EOL . static::getThrowableAsStr($ex);

            // The bind failed
            throw new \InvalidArgumentException($msg);
        }
    }
    
    public static function getThrowableAsStr(\Throwable $e): string {
        
        $eol = PHP_EOL;
        $message = "Exception Code: {$e->getCode()}"
        . PHP_EOL . "Exception Class: " . get_class($e)
        . PHP_EOL . "File: {$e->getFile()}"
        . PHP_EOL . "Line: {$e->getLine()}"
        . PHP_EOL . "Message: {$e->getMessage()}" . PHP_EOL
        . PHP_EOL . "Trace: {$eol}{$e->getTraceAsString()}{$eol}{$eol}";

        $previous_exception = $e->getPrevious();

        while( $previous_exception instanceof \Throwable ) {

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
    
    public static function canReallyBind(callable $callback): bool {
        
        return PHP_MAJOR_VERSION >= 7 || (PHP_MAJOR_VERSION === 5 && $callback instanceof \Closure);
    }
    
    public static function array_key_first(array $array) {

        if( function_exists('array_key_first') ) {
            
            return \array_key_first($array);
        }
        
        // polyfill
        if( $array === [] ) { return null; }

        foreach($array as $key => $_) { return $key; }
    }

    public static function array_key_last(array $array) {

        if( function_exists('array_key_last') ) {

            return \array_key_last($array);
        }
        
        // polyfill
        if( $array === [] ) { return null; }

        return static::array_key_first(array_slice($array, -1, null, true));
    }
}
