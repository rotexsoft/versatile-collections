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
class Utils
{
    public static function gettype(mixed $var): string 
    {    
        return \get_debug_type($var);
    }

    public static function getClosureFromCallable(callable $callable): Closure 
    {
        return ($callable instanceof Closure)? $callable : Closure::fromCallable($callable);
    }
    
    public static function bindObjectAndScopeToClosure(Closure $closure, object $newthis): Closure 
    {
        try {
            $new_closure = Closure::bind($closure, $newthis);

            if($new_closure === null) {

                throw new Exception(''); // jump to catch block below
            }
            
            return $new_closure;
            
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
    public static function getThrowableAsStr(Throwable $e, string $eol=PHP_EOL): string 
    {
        $previous_throwable = $e; 
        $message = '';

        do {
            $message .= "Exception / Error Code: {$previous_throwable->getCode()}"
                . $eol . "Exception / Error Class: " . $previous_throwable::class
                . $eol . "File: {$previous_throwable->getFile()}"
                . $eol . "Line: {$previous_throwable->getLine()}"
                . $eol . "Message: {$previous_throwable->getMessage()}" . $eol
                . $eol . "Trace: {$eol}{$previous_throwable->getTraceAsString()}{$eol}{$eol}";
                
            $previous_throwable = $previous_throwable->getPrevious();
        } while( $previous_throwable instanceof Throwable );
        
        return $message;
    }
}
