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
class SpecificObjectsCollection extends ObjectsCollection {
    
    protected $class_name = null;
    
    public function setClassName(string $class_name): void {
        
        $this->class_name = $class_name;
    }

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
    
    public static function makeNewForSpecifiedClassName(string $class_name, array $items =[], bool $preserve_keys=true): \VersatileCollections\CollectionInterface {
        
        $new_collection = static::makeNew(); // make an empty collection first
        
        if( class_exists($class_name) ) {
            
            $new_collection->setClassName($class_name);
            
            foreach($items as $key => $val) {
                
                if( $preserve_keys ) {
                    
                    $new_collection[$key] = $val;
                    
                } else {
                    
                    $new_collection[] = $val;
                }
            }
            
        } else {
            
            // TODO: Throw exception that specified class cannot be found
        }
        
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
