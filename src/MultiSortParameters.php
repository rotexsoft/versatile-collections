<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of SortParameters
 * 
 * @author Rotimi Ade
 */
class MultiSortParameters 
{    
    protected string $field_name = '';
    protected int $sort_direction = SORT_ASC;
    protected int $sort_type = SORT_REGULAR;
    
    /**         
     * @var int[]
     */
    protected static array $valid_sort_directions = [ SORT_ASC, SORT_DESC ];
    
    /**
     * @var int[]
     */
    protected static array $valid_sort_types = [
        SORT_REGULAR, SORT_NATURAL, SORT_NUMERIC, SORT_STRING, SORT_LOCALE_STRING,
        SORT_FLAG_CASE, (SORT_FLAG_CASE | SORT_STRING), (SORT_FLAG_CASE | SORT_NATURAL)
    ];

    /** 
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function __construct(string $field_name, ?int $sort_direction=null, ?int $sort_type=null) 
    {    
        if( $this->validateFieldName($field_name) ) {
            
            $this->field_name = $field_name;
        }
        
        if( !\is_null($sort_direction) && $this->validateSortDirection($sort_direction) ) {
            
            $this->sort_direction = $sort_direction; 
        }
        
        if( !\is_null($sort_type) && $this->validateSortType($sort_type) ) {
            
            $this->sort_type = $sort_type;
        }
    }
    
    public function getFieldName(): string
    {    
        return $this->field_name;
    }

    public function getSortDirection(): int
    {    
        return $this->sort_direction;
    }

    public function getSortType(): int
    {    
        return $this->sort_type;
    }

    /**
     * @return int[]
     */
    public static function getValidSortDirections(): array
    {    
        return static::$valid_sort_directions;
    }

    /**
     * @return int[]
     */
    public static function getValidSortTypes(): array
    {    
        return static::$valid_sort_types;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function setFieldName(string $field_name): self
    {    
        if( $this->validateFieldName($field_name) ) {
            
            $this->field_name = $field_name;
        }
        
        return $this;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function setSortDirection(int $sort_direction): self
    {
        if ( $this->validateSortDirection($sort_direction) ) {
            
            $this->sort_direction = $sort_direction;
        }
        
        return $this;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function setSortType(int $sort_type): self
    {
        if( $this->validateSortType($sort_type) ) {
            
            $this->sort_type = $sort_type;
        }
        
        return $this;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    protected function validateFieldName(string $field_name): bool
    {
        if( \strlen($field_name) <= 0 ) {
            
            $class = static::class;
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Missing \$field_name"
                . " in `{$class}::{$function}(...)` "
                . PHP_EOL . " `\$field_name`: " . var_to_string($field_name);
            
            throw new Exceptions\MissingMultiSortParameterFieldName($msg);
        }
        
        return true;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    protected function validateSortDirection(int $sort_direction): bool
    {    
        if( !\in_array($sort_direction, static::$valid_sort_directions, true) ) {
            
            $class = static::class;
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_direction supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_direction`: " . var_to_string($sort_direction);
            
            throw new Exceptions\InvalidMultiSortParameterException($msg);
        }
        
        return \in_array($sort_direction, static::$valid_sort_directions, true);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    protected function validateSortType(int $sort_type): bool
    {    
        if( !\in_array($sort_type, static::$valid_sort_types, true) ) {
            
            $class = static::class;
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_type supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_type`: " . var_to_string($sort_type);
            
            throw new Exceptions\InvalidMultiSortParameterException($msg);
        }
        
        return \in_array($sort_type, static::$valid_sort_types, true);
    }
}
