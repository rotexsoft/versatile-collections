# Arrays Collection

`\VersatileCollections\ArraysCollection` is a Collection class that only accepts
items that are arrays (i.e. when `is_array` is called on each item, it should return true).

Example Usage:

```php

    $collection = \VersatileCollections\ArraysCollection::makeNew();
    $collection[] = ['id' => 17, 'age' => 50, 'name' => "Johnny Cash"];
    $collection[] = ['id' => 27, 'age' => 23, 'name' => "Suzzy Something"];
    $collection[] = ['id' => 37, 'age' => 43, 'name' => "Jack Bauer"];
    $collection[] = ['id' => 47, 'age' => 55, 'name' => "Jane Fonda"];

    // extract a collection of ages keyed by corresponding names
    var_dump($collection->column('age', 'name')->toArray());
        // === [ 'Johnny Cash'=>50, 'Suzzy Something'=>23, 'Jack Bauer'=>43, 'Jane Fonda'=>55 ]
```

A good use-case for this type of collection would be for wrapping records
returned by **`PDOStatement::fetchAll()`**, in order to be able to take advantage 
of whichever ArraysCollection features (like filtering, mapping, reduction,
shuffling, sorting, etc.) you may want to use to manipulate the records.
