# Callables Collection

`\VersatileCollections\CallablesCollection` is a Collection class that only accepts
items that are callables (i.e. when `is_callable` is called on each item, it should return true).

Example Usage:

```php

    $collection = new \VersatileCollections\CallablesCollection(
        function() { return 'boo'; },
        'strtolower',
        [\DateTime::class, 'getLastErrors'],
        [\DateTime::class, 'createFromFormat']
    );

    // OR

    $collection = \VersatileCollections\CallablesCollection::makeNew([
        function() { return 'boo'; },
        'strtolower',
        [\DateTime::class, 'getLastErrors'],
        [\DateTime::class, 'createFromFormat']
    ]);

    // OR

    $collection = new \VersatileCollections\CallablesCollection();

    // lines below should produce no exception since we are injecting callables
    $collection->item1 = function() {
        return 'boo';
    };
    $collection->item2 = 'strtolower';
    $collection->item3 = [\DateTime::class, 'getLastErrors'];
    $collection->item4 = [\DateTime::class, 'createFromFormat'];
```

A couple good use-cases for this type of collection would be for implementing a 
dependency-injection container class that should only contain callables or
an object containing callables that can be used as view-helpers in an M-V-C
framework.
