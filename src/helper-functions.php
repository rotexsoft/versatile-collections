<?php /** @noinspection DuplicatedCode */ /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections {

    use Error;
    use Exception;
    use InvalidArgumentException;
    use LengthException;
    use ReflectionClass;
    use ReflectionException;
    use RuntimeException;
    use stdClass;
    use TypeError;

    /**
     * A robust way of retrieving the value of a specified property in
     * an instance of a class.
     *
     * Works with \stdClass objects created from arrays with numeric key(s)
     * (the value of the propertie(s) with numeric key(s) in such \stdClass
     * objects will be retrieved by this function).
     * 
     * @param bool $access_private_or_protected true if value associated with private or protected property should be returned.
     *                                          If false is specified and you try to access a private or protected property, a
     *                                          \RuntimeException will be thrown.
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ReflectionException
     *
     * @noinspection DuplicatedCode
     */
    function get_object_property_value(object $obj, string|int $property, mixed $default_val=null, bool $access_private_or_protected=false): mixed
    {
        $property = ''.$property;
        $return_val = $default_val;

        if( object_has_property($obj, $property) ) {

            if( $obj instanceof stdClass ) {

                // will work for stdClass instances that were created 
                // by casting an array with numeric and / or string keys to an object.
                // e.g. ( (object)[ 777=>'Some Value', 'a_string_property'=>'Another Value'] )
                $obj_as_array = ((array)$obj);
                $return_val = $obj_as_array[$property];

            } else if(
                \property_exists ($obj, $property) // is either public, protected or private
                && !\array_key_exists($property, \get_object_vars($obj)) // definitely a protected or a private property
            ) {
                if( $access_private_or_protected ) {

                    // use some reflection gymnastics to retrieve the value
                    $reflection_class = new ReflectionClass($obj::class);
                    $property = $reflection_class->getProperty($property);
                    $property->setAccessible(true);
                    $return_val = $property->getValue($obj); //$property->setAccessible(false);

                } else {

                    // throw exception letting user know that they are
                    // trying to access a private or protected value
                    $function = __FUNCTION__;
                    $ns = __NAMESPACE__;
                    $obj_type = $obj::class;
                    $msg = "Error [{$ns}::{$function}(...)]:"
                    . " Trying to access a protected or private property named `{$property}` on the instance of `$obj_type` below:" . PHP_EOL . var_to_string($obj)
                    . PHP_EOL . "To access a protected or private property named `{$property}` call `{$ns}::{$function}()` with `true` as the fourth argument.";
                    throw new RuntimeException($msg);
                }

            } else {

                $return_val = $obj->{$property};
            }
        }

        return $return_val;
    }

    /**
     * A more robust way than property_exists of checking if an instance of a class
     * has a specified property.
     * 
     * @throws InvalidArgumentException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    function object_has_property(object $obj, string|int $property): bool
    {
        $property = ''.$property;

        return (
                    \property_exists($obj, $property) // check if property is public, protected or private
                    ||
                    (
                        \method_exists($obj, '__isset')
                        && \method_exists($obj, '__get')
                        && $obj->__isset($property)
                    ) // check if property is accessible via magic method
                    ||
                    (
                        \array_key_exists( $property, ((array)$obj) )
                    ) // works for arrays with numeric keys that were
                      // cast into an object. E.g $item === ((object)[777=>'boo'])
                      // Also detects properties that are not defined in the class
                      // (i.e. they were not explicitly defined as public, private
                      // or protected) but were assigned during run-time, like 
                      // properties assigned to instances of \stdClass (which 
                      // could also be assigned to instances of any php class)
               );
    }

    /**
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
     * @return string|int|null a random key from the specified array
     *  
     * @throws LengthException
     */
    function random_array_key(array $array): string|int|null
    {
        if( \count($array) <= 0 ) {

            $function = __FUNCTION__;
            $ns = __NAMESPACE__;
            $msg = "Error [{$ns}::{$function}(...)]: You cannot request a random key from an empty array.";
            throw new LengthException($msg);
        }

        $error_occurred = false;
        $keys = \array_keys($array);
        $random_key = null;

        try {
            // random_int is more cryptographically secure than array_rand
            $min = 0;
            $max = \count($keys) - 1;
            $random_index = \random_int( $min, $max );
            $random_key = $keys[$random_index];

        } catch ( TypeError) {

            // random_int: If invalid parameters are given, a TypeError will be thrown.
            // This is okay, so long as `Error` is caught before `Exception`.
            // Probably will never occur since $min and $max above will always be ints.
            $error_occurred = true;

        } catch ( Error) {

            // random_int: If max is less than min, an Error will be thrown.
            // This is required, if you do not need to do anything just rethrow.
            // Probably will never occur since $min and $max above will always have $min < $max.
            $error_occurred = true;

        } catch ( Exception) {

            // random_int: If an appropriate source of randomness cannot be found, an Exception will be thrown.
            // This is optional and maybe omitted if you do not want to handle errors
            // during generation.
            // Hard to consistently test this since it's an internal 
            // random number generator specific logic error.
            $error_occurred = true;
        }

        if( $error_occurred ) {

            // fallback to array_rand since an error / exception occurred
            // while trying to use random_int
            $random_key = \array_rand($array, 1);
        }

        return $random_key;
    }

    /**
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
     * @throws LengthException
     * @throws InvalidArgumentException
     */
    function random_array_keys(array $array, int $number_of_random_keys = 1): array
    {
        if( \count($array) <= 0 ) {

            $function = __FUNCTION__;
            $ns = __NAMESPACE__;
            $msg = "Error [{$ns}::{$function}(...)]: You cannot request random keys from an empty array.";
            throw new LengthException($msg);
        }

        if(  $number_of_random_keys > \count($array) ) {

            $function = __FUNCTION__;
            $ns = __NAMESPACE__;
            $num_items = \count($array);
            $msg = "Error [{$ns}::{$function}(...)]:"
            . " You requested {$number_of_random_keys} key(s), but there are only {$num_items} keys available.";
            throw new InvalidArgumentException($msg);
        }

        $random_keys = [];

        for( $i=0; $i < $number_of_random_keys; $i++) {

            $current_random_key = null;

            do { // loop to ensure uniqueness of selected random keys
                $current_random_key = random_array_key($array);

            } while( \in_array($current_random_key, $random_keys, true) );

            $random_keys[] = $current_random_key;
        }

        return $random_keys; 
    }

    /**
     * Generate a (screen/user)-friendly string representation of a variable.
     *  
     * @return string a (screen / user)-friendly string representation of a variable
     * 
     * @psalm-suppress ForbiddenCode
     */
    function var_to_string(mixed $var): string 
    {
        ob_start(); // Start capturing the output

        var_dump($var);

        // Get the captured output, close the buffer & return the captured output
        $output = ob_get_clean();

        return ($output === false) ? '' : $output;
    }

    /**
     * Generate a (screen/user)-friendly string representation of a variable and print it out to the screen.
     */
    function dump_var(mixed $var): void 
    {
        $line_breaker = (PHP_SAPI === 'cli') ? PHP_EOL : '<br>';
        echo var_to_string($var). $line_breaker . $line_breaker;
    }
} // namespace VersatileCollections
