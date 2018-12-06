# Laravel Collection Methods Equivalence

|Laravel Collection Methods                             |Versatile Collection Equivalent(s)
|---							|---
|all							|toArray
|average						|NumericsCollection::average, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->average();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|avg							|See NumericsCollection::average above
|chunk							|getCollectionsOfSizeN, or iterator_to_array( yieldCollectionsOfSizeN )
|collapse						|Not implemented, see [below](#laravel-collection-method-collapse) for alternative snippet
|combine						|Not implemented, see [below](#laravel-collection-method-combine) for alternative snippet	
|concat							|appendCollection() or appendItem() depending on the use case, see [below](#laravel-collection-method-concat) for snippet
|contains						|no non-strict version for now
|containsStrict                                         |containsItem, containsItems, containsKey, containsKeys & containsItemWithKey 
|count							|count
|crossJoin						|Not implemented, maybe in a later version
|dd							|Not implemented, user should choose how to dump collection objects. __toString() & __debugInfo() can be helpful.
|diff							|diff, diffUsing
|diffAssoc						|diffAssoc, diffAssocUsing
|diffKeys						|diffKeys, diffKeysUsing
|dump							|Not implemented, user should choose how to dump collection objects. __toString() & __debugInfo() can be helpful.
|each							|each
|eachSpread						|Not implemented, maybe in a later version
|every							|allSatisfyConditions
|except							|getAllWhereKeysNotIn
|filter							|filterAll & filterFirstN
|first							|firstItem & filterFirstN
|firstWhere						|filterFirstN
|flatMap						|Not implemented, maybe in a later version
|flatten						|Not implemented, maybe in a later version
|flip							|Not implemented, see [below](#laravel-collection-method-flip) for alternative snippet
|forget							|removeAll
|forPage						|paginate
|get							|getIfExists
|groupBy						|Not implemented, will be implemented in a later version
|has							|containsKey & containsKeys
|implode						|Not implemented, will be implemented in a later version
|intersect						|intersectByItems, intersectByItemsUsingCallback, intersectByKeysAndItems, intersectByKeysAndItemsUsingCallbacks
|intersectByKeys                                        |intersectByKeys, intersectByKeysAndItems, intersectByKeysAndItemsUsingCallbacks, intersectByKeysUsingCallback
|isEmpty						|isEmpty
|isNotEmpty						|Will implement soon, for fluency sake
|keyBy							|Not Implemented, Does not make sense for ScalarCollection and its sub-classes.
|keys							|getKeys
|last							|lastItem. Can do $coll->reverse()->filterFirstN() to emulate last() with callback
|static macro                                           |addMethod, static addMethodForAllInstances & static addStaticMethod
|static make                                            |static makeNew
|map							|map
|mapInto						|Not Implemented, may implement if there is enough demand or if a pull request is submitted
|mapSpread						|Not Implemented, may implement if there is enough demand or if a pull request is submitted
|mapToDictionary                                        |Not Implemented, may implement if there is enough demand or if a pull request is submitted
|mapToGroups                                            |Not Implemented, may implement if there is enough demand or if a pull request is submitted
|mapWithKeys                                            |Not Implemented, may implement if there is enough demand or if a pull request is submitted
|max							|NumericsCollection::max, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->max();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|median							|NumericsCollection::median, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->median();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|merge							|mergeWith & mergeMeWith
|min							|NumericsCollection::min, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->min();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|mode							|NumericsCollection::mode, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->mode();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|nth							|everyNth
|only							|getAllWhereKeysIn
|pad							|Not Implemented, may implement if there is enough demand or if a pull request is submitted
|partition						|Not implemented, will be implemented in a later version	
|pipe							|pipeAndReturnCallbackResult & pipeAndReturnSelf
|pluck							|column	
|pop							|getAndRemoveLastItem
|prepend						|prependItem & prependCollection	
|pull							|pull
|push							|push & appendItem
|put							|put
|random							|randomItem, randomItems, randomKey & randomKeys
|reduce							|reduce & reduceWithKeyAccess
|reject							|Not Implemented, may implement if there is enough demand or if a pull request is submitted, use filterAll instead
|reverse						|reverse & reverseMe
|search							|searchAllByVal, searchByCallback & searchByVal
|shift							|getAndRemoveFirstItem 	
|shuffle						|shuffle
|slice							|slice
|some							|containsItem, containsItems, containsKey, containsKeys & containsItemWithKey. All use strict comparison
|sort, sortBy, sortByDesc                               |sort, sortDesc, sortByMultipleFields, sortMe, sortMeDesc, sortMeByMultipleFields
|sortKeys, sortKeysDesc                                 |sortByKey, sortDescByKey, sortMeByKey, sortMeDescByKey
|splice							|splice
|split							|split
|sum							|NumericsCollection::sum, `$coll->getAsNewType(\VersatileCollections\NumericsCollection::class)->sum();` where `$coll` is an instance of CollectionInterface containing integers and / or floats.
|take							|take
|tap							|tap
|static times						|Not Implemented, may implement if there is enough demand or if a pull request is submitted
|toArray						|toArray. Just returns underlying array, no traversal of items to process them before returning.
|toJson							|Not Implemented, may implement if there is enough demand or if a pull request is submitted
|transform						|transform
|union							|unionWith & unionMeWith
|unique							|ScalarsCollection::uniqueNonStrict
|uniqueStrict                                           |unique
|unless							|whenFalse		
|static unwrap						|Same as toArray() on an instance
|values							|getItems
|when							|whenTrue
|where							|Not implemented, will be implemented in a later version
|whereStrict                                            |Not implemented, will be implemented in a later version
|whereIn						|Not implemented, will be implemented in a later version
|whereInStrict                                          |Not implemented, will be implemented in a later version
|whereInstanceOf                                        |Not implemented, will be implemented in a later version	
|whereNotIn						|Not implemented, will be implemented in a later version
|whereNotInStrict                                       |Not implemented, will be implemented in a later version
|static wrap						|Not Implemented, may implement if there is enough demand or if a pull request is submitted	
|zip							|Not Implemented, may implement if there is enough demand or if a pull request is submitted

------------------------------------------------------------------------------------------------
<div id="laravel-collection-method-collapse"></div>

## Collapse Alternative:

```php
<?php 
    collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]])->collapse();

    // equivalent to

    \VersatileCollections\GenericCollection::makeNew([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
        ->reduce(
            function($carry , $item) {

                foreach($item as $val) {

                    $carry[] = $val;
                }
                return $carry;
            }, 
            \VersatileCollections\GenericCollection::makeNew()
        );
```

------------------------------------------------------------------------------------------------
<div id="laravel-collection-method-combine"></div>

## Combine Alternative:

```php
<?php 
    collect(['name', 'age'])->combine(['George', 29]);

    // equivalent to

    $vals = ['George', 29];
    \VersatileCollections\GenericCollection::makeNew(['name', 'age'])
        ->reduce(
            function($carry , $item) use (&$vals) {

                $carry[$item] = array_shift($vals);
                
                return $carry;
            }, 
            \VersatileCollections\GenericCollection::makeNew()
        );
```

------------------------------------------------------------------------------------------------
<div id="laravel-collection-method-concat"></div>

## Concat Alternative:

```php
<?php 
    collect(['John Doe'])
        ->concat(['Jane Doe'])
        ->concat(['name' => 'Johnny Doe'])
        ->all();

    // equivalent to

    \VersatileCollections\GenericCollection::makeNew(['John Doe'])
        ->appendCollection(
            \VersatileCollections\GenericCollection::makeNew(['Jane Doe'])
        )
        ->appendCollection(
            \VersatileCollections\GenericCollection::makeNew(['name' => 'Johnny Doe'])
        )
        ->toArray();
```

------------------------------------------------------------------------------------------------
<div id="laravel-collection-method-flip"></div>

## Flip Alternative:

```php
<?php 
    $collection = collect(['name' => 'taylor', 'framework' => 'laravel']);

    $flipped = $collection->flip();

    // equivalent to

    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['name' => 'taylor', 'framework' => 'laravel']
    );

    $flipped = \VersatileCollections\GenericCollection::makeNew(
            array_flip($collection->toArray())
    );
```
