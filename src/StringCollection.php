<?php
namespace VersatileCollections;

/**
 * Description of StringCollection
 *
 * @author rotimi
 */
class StringCollection  extends ScalarCollection {

    public function checkType($item) {
        
        return is_string($item);
    }

    public function getType() {
        
        return 'string';
    }
}
