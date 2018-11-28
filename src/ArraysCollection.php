<?php
namespace VersatileCollections;

/**
 * Description of ArraysCollection 
 *
 * @author aadegbam
 */
class ArraysCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;
    
    public function __construct(array ...$arrays) {
        
        $this->versatile_collections_items = $arrays;
    }

    public function checkType($item) {
        
        return is_array($item);
    }

    public function getType() {
        
        return 'array';
    }
}
