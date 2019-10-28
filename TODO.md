# Things To Do

* Post link to project in the comments section of this video: https://www.youtube.com/watch?time_continue=58&v=1l0kO-iaN_o
* Create a laravel collections to versatile collections method equivalence table

# References

* https://help.github.com/categories/writing-on-github/

> **NOTE TO SELF:** Create github issues rather than adding tasks to this file

New PHP 7.0 - 7.2 Features for Versatile Collections PHP 7.2+
===============================================================
- https://gist.github.com/rotexdegba/2e04245570810ff05f571ab95cc4c728 new stuff in PHP 7.X
- Bump PHPunit to version 8
- Use Scalar type definitions in method parameters and return signature and get rid of code formerly used to check types (and the exceptions thrown when types are wrong)
    - Update unit test expecting those exceptions to no longer do so where appropriate they should expect \TypeError in those cases I guess
- The spaceship operator is used for comparing two expressions. It returns -1, 0 or 1 when $a is respectively less than, equal to, or greater than $b. 
    - use where reasonable
- Use anonymous classes where reasonable
- Look at incorporating Closure::call() into places where Utils::bindObjectAndScopeToClosure & Utils::getClosureFromCallable are being called
    - Update Utils::bindObjectAndScopeToClosure removing PHP 5.6 related code
    - Utils::canReallyBind should no longer be needed for the php 7.2+ versions
- Use Generator Return Expressions and Generator delegation where appropriate
- No more polyfills needed for random_bytes() and random_int() i.e. paragonie/random_compat
- 