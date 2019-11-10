<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of ArraysCollection
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
 * @author aadegbam
 */
class ArraysCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;
    
    public function __construct(array ...$arrays) {
        
        $this->versatile_collections_items = $arrays;
    }

    public function checkType($item): bool {
        
        return is_array($item);
    }

    public function getType() {
        
        return 'array';
    }
}
