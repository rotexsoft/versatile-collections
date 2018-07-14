# Float Collection

`\VersatileCollections\FloatsCollection` is a Collection class that only accepts
items that are floats (i.e. floating point numbers).

Example Usage:

```php
    
    $collection = new \VersatileCollections\FloatsCollection(
        1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0
    );

    // OR

    $collection = new \VersatileCollections\FloatsCollection();
    $collection[] = 4.0;
    $collection[] = 5.0;
    $collection[] = 7.7;
    $collection[] = 9.9;
```

A good use-case for this type of collection would be in applications that require
a list of strictly floating point numbers for some calculation.
