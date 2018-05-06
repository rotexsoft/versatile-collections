# Scalar Collection

`\VersatileCollections\ScalarCollection` is a Collection class that only accepts
items that are scalars (i.e. [booleans](http://php.net/manual/en/language.types.boolean.php), 
[floats](http://php.net/manual/en/language.types.float.php), 
[integers](http://php.net/manual/en/language.types.integer.php) 
or [strings](http://php.net/manual/en/language.types.string.php) ).
It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all 
be present in an instance of this type of collection.

Example Usage:

```php
    
    $collection = new \VersatileCollections\ScalarCollection(
        1, // integer
        2.5, // float
        true, // boolean
        false, // boolean
        'Hello World!' // string 
    );

    // OR

    $collection = new \VersatileCollections\ScalarCollection();
    $collection[] = 1;
    $collection[] = 2.5;
    $collection[] = true;
    $collection[] = false;
    $collection[] = 'Hello World!';
```


## Other methods applicable to this Collection class and its descendants:
* **`unique($strict_comparison=false)`:** returns an array of unique values in the collection