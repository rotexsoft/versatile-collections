<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

use Closure;
use Exception;
use InvalidArgumentException;
use Throwable;

/**
 * Description of Utils
 *
 * @author rotimi
 */
class Utils {

    public static function gettype($var): string {
        
        return \is_object($var) ? \get_class($var) : \gettype($var);
    }

    public static function getClosureFromCallable(callable $callable): Closure {

        return ($callable instanceof Closure)? $callable : Closure::fromCallable($callable);
    }

    public static function bindObjectAndScopeToClosure(Closure $closure, $newthis): Closure {

        try {
            return Closure::bind($closure, $newthis);
        } catch (Exception $ex) {
            
            $function = __FUNCTION__;
            $class = static::class;
            $msg = "Error [{$class}::{$function}(...)]: Could not bind \$newthis to the supplied closure"
                . PHP_EOL . PHP_EOL . static::getThrowableAsStr($ex);

            // The bind failed
            throw new InvalidArgumentException($msg, (int)$ex->getCode(), $ex);
        }
    }

    /** @noinspection DuplicatedCode */
    public static function getThrowableAsStr(Throwable $e, string $eol=PHP_EOL): string {

        $previous_throwable = $e;
        $message = '';

        do {
            $message .= "Exception / Error Code: {$previous_throwable->getCode()}"
                . $eol . "Exception / Error Class: " . \get_class($previous_throwable)
                . $eol . "File: {$previous_throwable->getFile()}"
                . $eol . "Line: {$previous_throwable->getLine()}"
                . $eol . "Message: {$previous_throwable->getMessage()}" . $eol
                . $eol . "Trace: {$eol}{$previous_throwable->getTraceAsString()}{$eol}{$eol}";
                
            $previous_throwable = $previous_throwable->getPrevious();
        } while( $previous_throwable instanceof Throwable );
        
        return $message;
    }
    
    public static function canReallyBind(callable $callback): bool {
        
        return PHP_MAJOR_VERSION >= 7 || (PHP_MAJOR_VERSION === 5 && $callback instanceof Closure);
    }


    /**
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function array_key_first(array $array) {

        if( \function_exists('array_key_first') ) {

            /** @noinspection PhpFullyQualifiedNameUsageInspection */
            return \array_key_first($array);
        }

        // polyfill
        $firstKey = null; // default for $array === []

        foreach($array as $key => $value) {
            // an array with at least 1 item
            $firstKey = $key;
            break;
        }

        return $firstKey;
    }

    /**
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function array_key_last(array $array) {

        if( \function_exists('array_key_last') ) {

            /** @noinspection PhpFullyQualifiedNameUsageInspection */
            return \array_key_last($array);
        }

        // polyfill
        if( $array === [] ) { return null; }

        return static::array_key_first(\array_slice($array, -1, null, true));
    }
}
