<?php
namespace VersatileCollections;

function var_to_string($var) {
    
    return (new \SebastianBergmann\Exporter\Exporter())->export($var);
}

