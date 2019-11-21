<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of SpecificObjectsCollection
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
 */
final class SpecificObjectsCollection extends ObjectsCollection {
    
    private $class_name = null;

    protected function __construct(object ...$objects) {
        
        if( is_null($this->class_name) ) {
            
            // we don't have a specific class, allow all objects
            $this->versatile_collections_items = $objects;
            
        } else {
            
            // we have a specific class, allow only instances of that class
            // use the strictly typed constructor instead to enforce the
            // strict typing
            static::strictlyTypedCollectionTrait__construct(...$objects);
        }
    }

    /**
     * Create a new collection that only stores instances of the specified fully qualified class name or
     * a new collection that stores any kind of object if no fully qualified class name was specified
     * (essentially works like ObjectsCollection in the latter case).
     *
     * @param string|null $class_name fully qualified name of the class whose instances alone would be stored in the collection.
     *                                Set it to null to make the collection work exactly like an instance of ObjectsCollection
     * @param array $items an array of objects to be stored in the new collection
     * @param bool $preserve_keys
     * 
     * @return \VersatileCollections\StrictlyTypedCollectionInterface
     * 
     * @used-for: creating-new-collections
     * 
     * @title: Create a new collection that only stores instances of the specified fully qualified class name or a new collection that stores any kind of object if no fully qualified class name was specified (Essentially works like ObjectsCollection in the latter case).
     * 
     */
    public static function makeNewForSpecifiedClassName(?string $class_name=null, array $items =[], bool $preserve_keys=true): \VersatileCollections\StrictlyTypedCollectionInterface {
        
        $new_collection = static::makeNew(); // make an empty collection first

        if( $class_name !== null ) {

            if (class_exists($class_name)) {

                $new_collection->class_name = $class_name;

                foreach ($items as $key => $val) {

                    if ($preserve_keys) {

                        $new_collection[$key] = $val;

                    } else {

                        $new_collection[] = $val;
                    }
                }

            } else {

                $class = static::class;
                $function = __FUNCTION__;
                $msg = "Error in [{$class}::{$function}(...)]: Trying to create a"
                    . " new collection that stores only objects of the specified type "
                    . "`". $class_name ."` but the specified class not found by `class_exists('$class_name')`.";

                throw new Exceptions\SpecifiedClassNotFoundException($msg);

            } // if (class_exists($class_name))
        } // if( $class_name !== null )
        
        return $new_collection;
    }
    
    /**
     * 
     * @return bool true if $item is of the expected type, else false
     * 
     */
    public function checkType($item): bool {
        
        return is_null($this->class_name) 
                ? parent::checkType($item)
                : ($item instanceof $this->class_name);
    }
    
    /**
     * 
     * @return string|array a string or array of strings of type name(s) for items acceptable in a collection
     * 
     */
    public function getType() {
        
        return is_null($this->class_name)
                ? parent::getType()
                : $this->class_name;
    }
}
