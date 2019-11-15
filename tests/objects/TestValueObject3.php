<?php

/**
 * Description of TestValueObject3
 *
 * @author Rotimi Ade
 */
class TestValueObject3 {
    
    protected $volume = '';
    private $edition = '';

    public function __construct($volume='', $edition='') {
        $this->volume = $volume;
        $this->edition = $edition;
    }
}
