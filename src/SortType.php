<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of SortParameters
 *
 * @author Rotimi Ade
 */
class SortType
{
    protected int $sort_type = SORT_REGULAR;
    
    /**
     * @var int[]
     */
    protected static array $valid_sort_types = [
        SORT_REGULAR, SORT_NATURAL, SORT_NUMERIC, SORT_STRING, SORT_LOCALE_STRING,
        SORT_FLAG_CASE, (SORT_FLAG_CASE | SORT_STRING), (SORT_FLAG_CASE | SORT_NATURAL)
    ];

    /** @noinspection PhpUnhandledExceptionInspection */
    public function __construct(int $sort_type=-777) 
    {    
        if( \in_array($sort_type, static::$valid_sort_types, true) ) {
            
            $this->sort_type = $sort_type;
            
        } else if( 
            // !\in_array($sort_type, static::$valid_sort_types, true)
            // && 
            $sort_type !== -777
        ) {
            $class = \get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_type supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_type`: " . var_to_string($sort_type);
            throw new Exceptions\InvalidSortType($msg);
        }
    }

    public function getSortType(): int
    {
        return $this->sort_type;
    }

    /**
     * @return int[]
     */
    public static function getValidSortTypes(): array
    {
        return static::$valid_sort_types;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function setSortType(int $sort_type): self
    {
        if( !\in_array($sort_type, static::$valid_sort_types, true) ) {
            
            $class = \get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_type supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_type`: " . var_to_string($sort_type);
            
            throw new Exceptions\InvalidSortType($msg);
        }
        
        $this->sort_type = $sort_type;
        
        return $this;
    }
}
