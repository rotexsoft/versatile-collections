<?php
namespace VersatileCollections;

function var_to_string($var) {
    
    return (new \SebastianBergmann\Exporter\Exporter())->export($var);
}

/**
 * 
 * A potentially more cryptographically secure way  (as opposed to array_rand) 
 * of getting a random key from an array.
 * If the system contains sources of randomness like: 
 * On Windows, » CryptGenRandom() will always be used.
 * On Linux, the » getrandom(2) syscall will be used if available.
 * On other platforms, /dev/urandom will be used.
 * If none of the aforementioned sources are available, then array_rand will be used.
 *
 * @param array $array array from which a random key is to be extracted
 * 
 * @return string|int a random key from the specified array
 * 
 * @throws \LengthException
 * 
 */
function random_array_key(array $array) {
    
    if( count($array) <= 0 ) {

        $function = __FUNCTION__;
        $class = __NAMESPACE__;
        $msg = "Error [{$class}::{$function}(...)]: You cannot request a random key from an empty array.";
        throw new \LengthException($msg);
    }
    
    $error_occurred = false;
    $keys = array_keys($array);
    $random_key = null;

    try {
        
        // random_int is more cryptographically secure than 
        // array_rand
        $min = 0;
        $max = count($keys) - 1;
        $random_index = random_int( $min, $max );
        $random_key = $keys[$random_index];
        
    } catch ( \TypeError $e) {
        
        // This is okay, so long as `Error` is caught before `Exception`.
        $error_occurred = true;
        
    } catch ( \Error $e) {
        
        // This is required, if you do not need to do anything just rethrow.
        $error_occurred = true;
        
    } catch ( \Exception $e) {
        
        // This is optional and maybe omitted if you do not want to handle errors
        // during generation.
        $error_occurred = true;
        
    }
    
    if( $error_occurred === true ) {

        // fallback to array_rand since an error / exception occured
        // while trying to use random_int
        $random_key = array_rand($array);
    }
    
    return $random_key;
}

/**
 * 
 * A potentially more cryptographically secure way  (as opposed to array_rand) 
 * of getting unique random keys from an array.
 * 
 * If the system contains sources of randomness like: 
 * On Windows, » CryptGenRandom() will always be used.
 * On Linux, the » getrandom(2) syscall will be used if available.
 * On other platforms, /dev/urandom will be used.
 * If none of the aforementioned sources are available, then array_rand will be used.
 * 
 * @param array $array array from which a random keys are to be extracted
 * @param int $number_of_random_keys number of unique random keys to return
 * 
 * @return array an array of random keys
 * @throws \LengthException
 * @throws \InvalidArgumentException
 */
function random_array_keys(array $array, $number_of_random_keys = 1) {

    if( count($array) <= 0 ) {

        $function = __FUNCTION__;
        $class = __NAMESPACE__;
        $msg = "Error [{$class}::{$function}(...)]: You cannot request random keys from an empty array.";
        throw new \LengthException($msg);
    }

    if( !is_int($number_of_random_keys) ) {

        $function = __FUNCTION__;
        $class = __NAMESPACE__;
        $type = gettype($number_of_random_keys);
        $msg = "Error [{$class}::{$function}(...)]:"
        . " You must specify a valid integer as the number of random keys."
        . " You supplied a(n) `{$type}` with a value of: ". var_to_string($number_of_random_keys);
        throw new \InvalidArgumentException($msg); 
    }

    if( 
        is_int($number_of_random_keys) 
        && ( $number_of_random_keys > count($array) )
    ) {
        $function = __FUNCTION__;
        $class = __NAMESPACE__;
        $num_items = count($array);
        $msg = "Error [{$class}::{$function}(...)]:"
        . " You requested {$number_of_random_keys} key(s), but there are only {$num_items} keys available.";
        throw new \InvalidArgumentException($msg); 
    }

    $random_keys = [];
    
    for( $i=0; $i < $number_of_random_keys; $i++) {
        
        $current_random_key = null;
        
        do { // loop to ensure uniqueness of selected random keys
        
            $current_random_key = random_array_key($array);
            
        } while( in_array($current_random_key, $random_keys, true) );
        
        $random_keys[] = $current_random_key;
    }
    
    return $random_keys; 
}
