<?php
namespace VersatileCollections;

/**
 * Description of FloatCollection
 *
 * @author rotimi
 */
class FloatCollection extends ScalarCollection {

    protected function checkType($item) {
        
        return is_float($item);
    }

    protected function getType() {
        
        return 'float';
    }
}
