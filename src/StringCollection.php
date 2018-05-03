<?php
namespace VersatileCollections;

/**
 * Description of StringCollection
 *
 * @author rotimi
 */
class StringCollection  extends ScalarCollection {

    protected function checkType($item) {
        
        return is_string($item);
    }

    protected function getType() {
        
        return 'string';
    }
}
