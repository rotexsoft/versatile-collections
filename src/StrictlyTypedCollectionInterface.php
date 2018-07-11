<?php
namespace VersatileCollections;

/**
 *
 * @author Rotimi Ade
 */
interface StrictlyTypedCollectionInterface extends CollectionInterface {

    /**
     * 
     * @return bool true if $item is of the expected type, else false
     * 
     */
    public function checkType($item);
    
    /**
     * 
     * @return string|array a string or array of strings of type name(s) for items acceptable in a collection
     * 
     */
    public function getType();
}
