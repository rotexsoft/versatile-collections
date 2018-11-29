# Generic Collection

This type of Collection can contain items of differing types. You can store integers,
objects, callables, etc. all in each instance of `\VersatileCollections\GenericCollection`.

Use this type of collection if you don't need strict-typing.

Example Usage:

```php
    
    $collection = new \VersatileCollections\GenericCollection(
        1, // integer
        2.5, // float
        function() { return 'boo'; }, // callable
        new StdClass(), // object 
        tmpfile(), // resource
        'Hello World!' // string 
    );

    // OR

    $collection = new \VersatileCollections\GenericCollection();
    $collection[] = 1;
    $collection[] = 2.5;
    $collection[] = function() { return 'boo'; };
    $collection[] = new StdClass();
    $collection[] = tmpfile();
    $collection[] = 'Hello World!';
```
