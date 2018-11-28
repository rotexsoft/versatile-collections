<?php
namespace VersatileCollections;

/**
 * Description of CallablesCollection
 *
 * @author aadegbam
 */
class CallablesCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;
    
    public function __construct(callable ...$callables) {
        
        $this->versatile_collections_items = $callables;
    }

    public function checkType($item) {
        
        return is_callable($item);
    }

    public function getType() {
        
        return 'callable';
    }
}
