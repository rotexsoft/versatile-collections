# Resources Collection

`\VersatileCollections\ResourcesCollection` is a Collection class that only accepts
items that are [resources](http://php.net/manual/en/language.types.resource.php).

Example Usage:

```php
    
    $collection = new \VersatileCollections\ResourcesCollection(
        tmpfile(), 
        tmpfile(), 
        tmpfile(), 
        tmpfile()
    );

    // OR
    
    $collection = \VersatileCollections\ResourcesCollection::makeNew([
        tmpfile(), 
        tmpfile(), 
        tmpfile(), 
        tmpfile()
    ]);

    // OR

    $collection = new \VersatileCollections\ResourcesCollection();
    $collection[] = tmpfile();
    $collection[] = tmpfile();
    $collection[] = tmpfile();
    $collection[] = tmpfile();
```

A good use-case for this type of collection would be in socket programming, if
you want to store a bunch of sockets (resource type) opened via 
[fsockopen](http://php.net/manual/en/function.fsockopen.php) in 
a collection for later use in a script or application.
