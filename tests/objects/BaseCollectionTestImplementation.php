<?php
/**
 * Description of BaseCollectionImplementation
 *
 * @author aadegbam
 */
class BaseCollectionTestImplementation extends \VersatileCollections\BaseCollection {
    
    public function validateMethodNamePublic($name, $method_name_was_passed_to, $class_in_which_method_was_called=null) {
        
        return parent::validateMethodName($name, $method_name_was_passed_to, $class_in_which_method_was_called);
    }
    
    public static function getArrayOfMethodsForAllInstances() {
        
        return static::$methods_for_all_instances;
    }
    
    public function getArrayOfMethodsForThisInstance() {
        
        return $this->methods_for_this_instance;
    }
    
    public static function getArrayOfStaticMethods() {
        
        return static::$static_methods;
    }
}
