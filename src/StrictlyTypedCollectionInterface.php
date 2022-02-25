<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 *
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this interface:
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
interface StrictlyTypedCollectionInterface extends CollectionInterface {

    /**
     *
     * @param mixed $item
     * @return bool true if $item is of the expected type, else false
     */
    public function checkType($item): bool;
    
    /**
     *  
     * @return \VersatileCollections\StringsCollection a collection of strings of type name(s) for items acceptable in a collection
     *  
     */
    public function getType(): StringsCollection;
}
