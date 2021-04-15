# Specific Objects Collection

`\VersatileCollections\SpecificObjectsCollection` is a sub-class of `\VersatileCollections\ObjectsCollection`
 that either:
  * only accepts items that are instances of a specified class (if the class name is provided as the first parameter to **SpecificObjectsCollection::makeNewForSpecifiedClassName**) and the specified class' sub-classes
  * or stores any kind of object (i.e. works exactly like **ObjectsCollection** if no class name or null is provided as the first parameter to **SpecificObjectsCollection::makeNewForSpecifiedClassName**) 

> NOTE: **SpecificObjectsCollection** is a final class and was never intended to be extensible. It has a **protected** constructor by design so that its instances cannot be created via the use of the **new** keyword, 
instead its instances can only be created by calling either 
>   * **SpecificObjectsCollection::makeNewForSpecifiedClassName(?string $class_name=null, iterable $items =[], bool $preserve_keys=true)** 
>   * or **SpecificObjectsCollection::makeNew(iterable $items=[], bool $preserve_keys=true)**
> 
> This is also by design.

Instances of this class have the same features as [Objects Collections](ObjectsCollections.md).

Example Usage:

```php
use \VersatileCollections\SpecificObjectsCollection;

/////////////////////////////////////////////
// Store only instances of ArrayIterator 
// and its sub-class RecursiveArrayIterator
////////////////////////////////////////////
$item1 = new \ArrayIterator(); // parent class instance
$item2 = new \ArrayIterator(); // parent class instance
$item3 = new \RecursiveArrayIterator(); // child class instance
$item4 = new \RecursiveArrayIterator(); // child class instance

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName(
    \ArrayIterator::class, 
    ['item1'=>$item1, 'item2'=>$item2, 'item3'=>$item3, 'item4'=>$item4]
);

// $collection = SpecificObjectsCollection::makeNewForSpecifiedClassName(
//    \ArrayIterator::class, 
//    ['item1'=>$item1, 'item2'=>$item2, 'item3'=>(new \DateTime('2000-01-01'))]
// ); // This will throw a VersatileCollections\Exceptions\InvalidItemException 
      // becuse of the last item (DateTime instance) with the key `item3`

// OR

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName(
    \ArrayIterator::class
);
$collection['item1'] = $item1;
$collection['item2'] = $item2;
// Line below will throw a VersatileCollections\Exceptions\InvalidItemException
// $collection['item3'] = new \DateTime('2000-01-01');

// OR

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName(
    \ArrayIterator::class
);
$collection->item1 = $item1;
$collection->item2 = $item2;
// Line below will throw a VersatileCollections\Exceptions\InvalidItemException
// $collection->item3 = new \DateTime('2000-01-01');

//////////////////////////////////////////////////////////////////////
// Store instances of any class. Works exactly like ObjectsCollection
//////////////////////////////////////////////////////////////////////
$collection = SpecificObjectsCollection::makeNew([
    'item1'=>new stdClass(), 
    'item2'=>new \DateTime('2000-01-01'), 
    'item3'=>new \PDO('sqlite::memory:'), 
    'item4'=>new \ArrayObject()
]);

// OR

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName(
    null,    
    [
        'item1'=>new stdClass(), 
        'item2'=>new \DateTime('2000-01-01'), 
        'item3'=>new \PDO('sqlite::memory:'), 
        'item4'=>new \ArrayObject()
    ]
);

// OR

$collection = SpecificObjectsCollection::makeNew();
$collection['item1'] = new stdClass();
$collection['item2'] = new \DateTime('2000-01-01');
$collection['item3'] = new \PDO('sqlite::memory:');
$collection['item4'] = new \ArrayObject();

// OR

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName();
$collection['item1'] = new stdClass();
$collection['item2'] = new \DateTime('2000-01-01');
$collection['item3'] = new \PDO('sqlite::memory:');
$collection['item4'] = new \ArrayObject();

// OR

$collection = SpecificObjectsCollection::makeNew();
$collection->item1 = new stdClass();
$collection->item2 = new \DateTime('2000-01-01');
$collection->item3 = new \PDO('sqlite::memory:');
$collection->item4 = new \ArrayObject();

// OR

$collection = SpecificObjectsCollection::makeNewForSpecifiedClassName();
$collection->item1 = new stdClass();
$collection->item2 = new \DateTime('2000-01-01');
$collection->item3 = new \PDO('sqlite::memory:');
$collection->item4 = new \ArrayObject();
```

Use this type of collection if you want to only store objects that are 
instances of a specific class or its sub-classes. 
