# Object Collection

`\VersatileCollections\ObjectsCollection` is a Collection class that only accepts
items that are objects (i.e. that are instances of any valid PHP class).

Example Usage:

```php
    
    $collection = new \VersatileCollections\ObjectsCollection(
        new stdClass(), 
        new \DateTime('2000-01-01'), 
        new \PDO('sqlite::memory:'), 
        new \ArrayObject()
    );

    // OR

    $collection = new \VersatileCollections\ObjectsCollection();
    $collection[] = new stdClass();
    $collection[] = new \DateTime('2000-01-01');
    $collection[] = new \PDO('sqlite::memory:');
    $collection[] = new \ArrayObject();
```

This class also has a neat feature that allows you to call a method on each 
object in the collection by invoking the method directly on the collection object.

A good use case for this feature would be a collection of Database Record objects
that each contain a save method. The save method can be called on the collection
object which will in turn call the save method on each record. This way you don't 
have to manually loop through items in the collection in order to call the same 
method on each of them (this feature may not be useful if each method call 
requires different paramater / argument values for each object, you may still 
need to manually loop through the collection in such a situation). 
 
The results of calling the method on each item is returned as an array whose keys 
are the corresponding keys for the objects in the collection. 

If the called method does not return any value the returned array will contain a 
return value of NULL for such calls.

If the called method does not exist in one or more of the objects in the collection,
an exception is thrown.

Example Usage:

```php
    $collection = new \VersatileCollections\ObjectsCollection(
        new \DateTime('2000-01-01'),  
        new \DateTime('2005-01-01'), 
        new \DateTime('2010-01-01'),  
        new \DateTime('2015-01-01')
    );

    var_dump($collection);
```

```
object(VersatileCollections\ObjectsCollection)#3 (1) {
  ["collection_items":protected]=>
  array(4) {
    [0]=>
    object(DateTime)#2 (3) {
      ["date"]=>
      string(26) "2000-01-01 00:00:00.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(14) "America/Denver"
    }
    [1]=>
    object(DateTime)#4 (3) {
      ["date"]=>
      string(26) "2005-01-01 00:00:00.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(14) "America/Denver"
    }
    [2]=>
    object(DateTime)#5 (3) {
      ["date"]=>
      string(26) "2010-01-01 00:00:00.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(14) "America/Denver"
    }
    [3]=>
    object(DateTime)#6 (3) {
      ["date"]=>
      string(26) "2015-01-01 00:00:00.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(14) "America/Denver"
    }
  }
}
```

```php
    // Call the DateTime::format ( string $format ) method on
    // on each of the DateTime objects in the collection and 
    // the return values for each call will be returned in an
    // array whose keys match the corresponding keys it the 
    // collection.
    $years = $collection->format('Y');

    var_dump($years);
```

```
array(4) {
  [0]=>
  string(4) "2000"
  [1]=>
  string(4) "2005"
  [2]=>
  string(4) "2010"
  [3]=>
  string(4) "2015"
}
```

Use this type of collection if you want to only store objects. 

You can even extend it and add other features in your extended class. 
