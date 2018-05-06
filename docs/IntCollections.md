# Int Collection

`\VersatileCollections\IntCollection` is a Collection class that only accepts
items that are integers.

Example Usage:

```php
    
    $collection = new \VersatileCollections\IntCollection(
        1, 2, 3, 4, 5, 6, 7
    );

    // OR

    $collection = new \VersatileCollections\IntCollection();
    $collection[] = 4;
    $collection[] = 5;
    $collection[] = 7;
    $collection[] = 9;
```

A good use-case for this type of collection would be in applications that require
a list of strictly integer numbers for some calculation.
