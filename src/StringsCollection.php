<?php
namespace VersatileCollections;

/**
 * Description of StringsCollection
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
