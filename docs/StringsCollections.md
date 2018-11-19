# String Collection

`\VersatileCollections\StringsCollection` is a Collection class that only accepts
items that are strings.

Example Usage:

```php
    
    $collection = new \VersatileCollections\StringsCollection(
        '1', '2', '3', '4', '5', '6', '7'
    );

    // OR

    $collection = new \VersatileCollections\StringsCollection();
    $collection[] = '4';
    $collection[] = '5';
    $collection[] = '7';
    $collection[] = '9';
```

A good use-case for this type of collection would be in applications that require
a list of strings.
