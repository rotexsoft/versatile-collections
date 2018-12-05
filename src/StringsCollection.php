<?php
namespace VersatileCollections;

/**
 * Description of StringsCollection
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
 * @author rotimi
 */
class StringsCollection extends ScalarsCollection {

    public function checkType($item) {
        
        return is_string($item);
    }

    public function getType() {
        
        return 'string';
    }
}
