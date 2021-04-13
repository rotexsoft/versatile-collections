<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

use Exception;
use Throwable;
use VersatileCollections\Exceptions\BadMethodCallException;

/**
 * Description of ObjectsCollection
 *  
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this class:
 *  
 *      - accessing-or-extracting-keys-or-items
 *      - adding-items
 *      - adding-methods-at-runtime
 *      - checking-keys-presence
 *      - checking-items-presence
 *      - creating-new-collections
 *      - deleting-items
 *      - finding-or-searching-for-items
 *      - getting-collection-meta-data
 *      - iteration
 *      - mathematical-operations
 *      - modifying-keys
 *      - modifying-items
 *      - ordering-or-sorting-items
 *      - other-operations
 *
 * @author Rotimi Ade
 */
class ObjectsCollection implements StrictlyTypedCollectionInterface
{
    
    use StrictlyTypedCollectionInterfaceImplementationTrait {
        StrictlyTypedCollectionInterfaceImplementationTrait::__construct as strictlyTypedCollectionTrait__construct;
    }

    /**
     * @param object[] ...$objects
     */
    public function __construct(object ...$objects) {
        
        $this->versatile_collections_items = $objects;
    }

    /**
     *
     * Call a method on each object in the collection.
     *
     * The return value of each call (if any) is stored in an array keyed
     * on the object's key in the collection and this array is returned.
     *
     *
     * @used-for: other-operations
     *
     * @title: Tries to call the specified method with the specified arguments and return its return value if it was registered via either `addMethod` or `addMethodForAllInstances` or tries to call the specified method with the specified arguments on each item in the collection and returns an array of return values keyed by each item's key in the collection. An exception of type **\VersatileCollections\Exceptions\InvalidCollectionOperationException** is thrown if the method could not be called.
     *
     * @return array|mixed
     * @throws Exception
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function __call(string $method_name, array $arguments=[]) {

        try {
            return static::parent__call($method_name, $arguments);
            
        } catch (BadMethodCallException $ex) {

            // method was not available using 
            //  static::parent__call($method_name, $arguments);
            
            $results = [];

            foreach ( $this as $key_in_collection => $object ) {

                try {

                    if( \count($arguments) <= 0 ) {

                        $arguments = [];
                    }

                    $results[$key_in_collection] =
                        \call_user_func_array([$object, $method_name], $arguments);

                } catch (Throwable $err) {

                    $class = \get_class($this);
                    $function = __FUNCTION__;
                    $msg = "Error [{$class}::{$function}(...)]:Trying to call a"
                        . " method named `$method_name` on a collection item of type "
                        . "`". \get_class($object)."` having `{$key_in_collection}`"
                        . " as its key in the collection"
                        . PHP_EOL . " `\$arguments`: " . var_to_string($arguments)
                        . PHP_EOL . " `Original Exception Message`: " . $err->getMessage();

                    throw new Exceptions\InvalidCollectionOperationException($msg, (int)$err->getCode(), $err);
                    
                }
            } // foreach ( $this as $key_in_collection => $object )

            return $results;
            
        } catch (Exception $exc) {
            
            // an existing and callable method called via
            //     static::parent__call($method_name, $arguments);
            // definitely threw an exception, rethrow the exception
            
            throw $exc;
        }
    }
    
    public function checkType($item): bool {
        
        return \is_object($item);
    }
    
    /**
     * @return string|array
     */
    public function getType() {
        
        return 'object';
    }
}
