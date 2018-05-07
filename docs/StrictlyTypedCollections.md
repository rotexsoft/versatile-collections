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
in your constructor's signature (like **`__construct(\PDO ...$pdo_objs)`** in the `class` **PdoCollection** example below. 
This is actually more performant than relying on **`StrictlyTypedCollection::__construct(...$arr_objs)`** 
if you would be loading a large amount of items into your collection). 

For example if you are implementing a **PdoCollection** class which extends 
`\VersatileCollections\StrictlyTypedCollection`, then your constructor could look 
like this: `PdoCollection::__construct(\PDO ...$arr_objs)`

Here is what a full **PdoCollection** class would look like:

```php
class PdoCollection extends \VersatileCollections\StrictlyTypedCollection {

    // You can choose not to override 
    // \VersatileCollections\StrictlyTypedCollection::__construct(...$arr_objs)
    // if you want to rely on
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

Below are the strictly-typed Collection classes implemented in this package:

* [Callables Collections](CallablesCollections.md): a collection that can only contain [callables](http://php.net/manual/en/language.types.callable.php)
* [Object Collections](ObjectCollections.md): a collection that can only contain [objects](http://php.net/manual/en/language.types.object.php) (any kind of object)
* [Resource Collections](ResourceCollections.md): a collection that can only contain [resources](http://php.net/manual/en/language.types.resource.php)
* [Scalar Collections](ScalarCollections.md): a collection that can only scalar values. I.e. any of [booleans](http://php.net/manual/en/language.types.boolean.php), [floats](http://php.net/manual/en/language.types.float.php), [integers](http://php.net/manual/en/language.types.integer.php) or [strings](http://php.net/manual/en/language.types.string.php). It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all be present in an instance of this type of collection.
    * [Numeric Collections](NumericCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php) and/or [integers](http://php.net/manual/en/language.types.integer.php)
        * [Float Collections](FloatCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php)
        * [Int Collections](IntCollections.md): a collection that can only contain [integers](http://php.net/manual/en/language.types.integer.php)
    * [String Collections](StringCollections.md): a collection that can only contain [strings](http://php.net/manual/en/language.types.string.php)

