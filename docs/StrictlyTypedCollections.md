# Strictly Typed Collection

The `\VersatileCollections\StrictlyTypedCollection` is an abstract Collection class
that enforces strict typing on its descendants. 

If you want to implement a collection of only a specific type of items (e.g. only 
instances of a specific class, or only arrays, etc.), then you must extend 
`\VersatileCollections\StrictlyTypedCollection` and implement two protected 
methods:
* **`checkType($item)`:** which performs a test on the type of **$item** and returns true if **$item** is of the expected type or false otherwise
* **`getType()`:** returns a string representing the name of the expected type. For example, if you are implementing a PdoCollection class, getType should return **\PDO::class**

**\VersatileCollections\StrictlyTypedCollection::__construct(...$arr_objs)** does 
type checking by looping through each argument passed to it and checking that they 
are of the expexcted type, but you can override it and use php's native type hinting 
in your constructor's signature. 

For example if you are implementing a **PdoCollection** class which extends 
`\VersatileCollections\StrictlyTypedCollection`, then your constructor could look 
like this: `PdoCollection::__construct(\PDO ...$arr_objs)`

Here is what a full **PdoCollection** class would look like:

```php
class PdoCollection extends \VersatileCollections\StrictlyTypedCollection {

    // You can choose not to override 
    // \VersatileCollections\StrictlyTypedCollection::__construct(...$arr_objs)
    // if you want and rely on
    // \VersatileCollections\StrictlyTypedCollection::__construct(...$arr_objs)
    // for construct-time type-checking.
    public function __construct(\PDO ...$pdo_objs) {
                
        $this->collection_items = $pdo_objs;
    }

    protected function checkType($item) {
        
        return ($item instanceof \PDO);
    }
    
    protected function getType() {
        
        return \PDO::class;
    }
}

```

`\VersatileCollections\StrictlyTypedCollection` also enforces type-checking when
items are added to the collection via any of the syntaxes like:
* `$collection[] = 'item'`
* or `$collection['item1'] = 'item'` 
* or `$collection->item1 = 'item'`