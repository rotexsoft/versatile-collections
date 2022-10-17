# Non-Array Iterables Collection

`\VersatileCollections\NonArrayIterablesCollection` is a Collection class that only accepts
items that are objects for which [\is_iterable](https://www.php.net/manual/en/function.is-iterable) returns true.

>NOTE: this collection will not accept items that are arrays (because an array is not an object, even though it is an iterable).

Example Usage:

```php
    
    $collection = new \VersatileCollections\NonArrayIterablesCollection(
                    new \ArrayObject(),
                    new \SplDoublyLinkedList(),
                    new \SplStack(),
                    new \SplQueue(),
                    new \SplMaxHeap(),
                    new \SplMinHeap(),
                    new \SplPriorityQueue(),
                    new \SplFixedArray(),
                    new \SplObjectStorage()
                );

    // OR
    
    $collection = \VersatileCollections\NonArrayIterablesCollection::makeNew([
                    new \ArrayObject(),
                    new \SplDoublyLinkedList(),
                    new \SplStack(),
                    new \SplQueue(),
                    new \SplMaxHeap(),
                    new \SplMinHeap(),
                    new \SplPriorityQueue(),
                    new \SplFixedArray(),
                    new \SplObjectStorage()
                ]);

    // OR

    $collection = new \VersatileCollections\NonArrayIterablesCollection();
    $collection[] = new ArrayObject();
    $collection[] = new SplDoublyLinkedList();
    $collection[] = new SplStack();
    $collection[] = new SplQueue();
    $collection[] = new SplMaxHeap();
    $collection[] = new SplMinHeap();
    $collection[] = new SplPriorityQueue();
    $collection[] = new SplFixedArray();
    $collection[] = new SplObjectStorage();
```

Use this type of collection if you want to only store objects (except php [arrays](https://www.php.net/manual/en/language.types.array.php)) that are iterable.

You can even extend it and add other features in your extended class. 
