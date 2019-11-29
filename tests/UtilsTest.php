<?php
declare(strict_types=1);
use VersatileCollections\Utils;

/**
 * Description of ArraysCollectionTest
 *
 * @author Rotimi Ade
 */
class UtilsTest extends \PHPUnit\Framework\TestCase{
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThat_gettype_WorksAsExpected() {

        $heredoc = <<<EOT
bar
EOT;
        $nowdoc = <<<'EOT'
bar
EOT;
        $this->assertEquals('boolean', Utils::gettype(true));
        $this->assertEquals('integer', Utils::gettype(777));
        $this->assertEquals('double', Utils::gettype(777.777));
        $this->assertEquals('string', Utils::gettype('777.777'));
        $this->assertEquals('string', Utils::gettype("777.777"));
        $this->assertEquals('string', Utils::gettype($heredoc));
        $this->assertEquals('string', Utils::gettype($nowdoc));
        $this->assertEquals('array', Utils::gettype([]));
        $this->assertEquals(\ArrayObject::class, Utils::gettype(new ArrayObject()));
        $this->assertEquals('resource', Utils::gettype(tmpfile()));
        $this->assertEquals('NULL', Utils::gettype(NULL));
    }
    
    public function testThat_array_key_first_WorksAsExpected() {
        
        $arr = [];
        $arr1 = ['One', 'Two', 'Three', 'Four'];
        $arr2 = ['a'=>'One', 'Two', 'Three', 'Four'];
        $arr3 = ['z'=>'One', 'Two', 'Three', 'Four'];
      
        $this->assertEquals(Utils::array_key_first($arr), null);
        $this->assertEquals(Utils::array_key_first($arr1), 0);
        $this->assertEquals(Utils::array_key_first($arr2), 'a');
        $this->assertEquals(Utils::array_key_first($arr3), 'z');
    }
    
    public function testThat_array_key_last_WorksAsExpected() {
        
        $arr = [];
        $arr1 = ['One', 'Two', 'Three', 'Four'];
        $arr2 = ['One', 'Two', 'Three', 'a'=>'Four'];
        $arr3 = ['One', 'Two', 'Three', 'z'=>'Four'];

        $this->assertEquals(Utils::array_key_last($arr), null);
        $this->assertEquals(Utils::array_key_last($arr1), 3);
        $this->assertEquals(Utils::array_key_last($arr2), 'a');
        $this->assertEquals(Utils::array_key_last($arr3), 'z');
    }
    
    public function testThatGetClosureFromCallableWorksAsExpected() {
        
        $this->assertTrue(
            Utils::getClosureFromCallable('my_callback_function') instanceof \Closure
        ); // from non-anonymous & non-class function
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Ancestor::class, 'who']) instanceof \Closure    
        ); // static method call on a class
        
        $this->assertTrue(
            Utils::getClosureFromCallable([ (new \Descendant() ), 'echoOut']) instanceof \Closure    
        ); // instance method call on a class instance
        
        $this->assertTrue(
            Utils::getClosureFromCallable(\Descendant::class.'::who') instanceof \Closure    
        ); // static method call string syntax
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Descendant::class, 'parent::who']) instanceof \Closure    
        ); // parent class' static method call
        
        $this->assertTrue(
            Utils::getClosureFromCallable( (new \Descendant()) ) instanceof \Closure    
        ); // instance of class that has __invoke()
        
        $anon_func = function($a) {
            return $a * 2;
        };
        $this->assertTrue(
            Utils::getClosureFromCallable($anon_func) instanceof \Closure    
        ); // anonymous function a.k.a Closure
    }

    public function testThatBindObjectAndScopeToClosureWorksAsExpected() {
        
        $this->assertTrue(
            Utils::getClosureFromCallable('my_callback_function') instanceof \Closure
        ); // from non-anonymous & non-class function
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Ancestor::class, 'who']) instanceof \Closure    
        ); // static method call on a class
        
        $this->assertTrue(
            Utils::getClosureFromCallable([ (new \Descendant() ), 'echoOut']) instanceof \Closure    
        ); // instance method call on a class instance
        
        $this->assertTrue(
            Utils::getClosureFromCallable(\Descendant::class.'::who') instanceof \Closure    
        ); // static method call string syntax
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Descendant::class, 'parent::who']) instanceof \Closure    
        ); // parent class' static method call
        
        $this->assertTrue(
            Utils::getClosureFromCallable( (new \Descendant()) ) instanceof \Closure    
        ); // instance of class that has __invoke()
        
        $anon_func = function($a) {
            return $a * 2;
        };
        $this->assertTrue(
            Utils::bindObjectAndScopeToClosure($anon_func, $this) instanceof \Closure    
        ); // anonymous function a.k.a Closure
        
        if( 
            (PHP_MAJOR_VERSION === 7 && PHP_MINOR_VERSION >=1)
            || PHP_MAJOR_VERSION > 7
        ) {
            $this->expectException(\InvalidArgumentException::class);
            
            // Code should generate Exception: binding $this to a static Closure
            Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable([\Ancestor::class, 'who']), 
                $this
            );
        }
    }
    
    public function testThatGetThrowableAsStrWorksAsExpected() {
        
        $e1 = new \DescendantException('Descendant Thrown', 911);
        $e2 = new \AncestorException('Ancestor Thrown', 777, $e1);
        $e3 = new \Exception('Base Thrown', 187, $e2);
        
        $ex_as_str = Utils::getThrowableAsStr($e3);
        $this->assertStringContainsString(PHP_EOL, $ex_as_str);
        $this->assertStringContainsString('187', $ex_as_str);
        $this->assertStringContainsString('Base Thrown', $ex_as_str);
        $this->assertStringContainsString('777', $ex_as_str);
        $this->assertStringContainsString('AncestorException', $ex_as_str);
        $this->assertStringContainsString('Ancestor Thrown', $ex_as_str);
        $this->assertStringContainsString('911', $ex_as_str);
        $this->assertStringContainsString('DescendantException', $ex_as_str);
        $this->assertStringContainsString('Descendant Thrown', $ex_as_str);
        
        $ex_as_str2 = Utils::getThrowableAsStr($e3, '<br>');
        $this->assertStringContainsString('<br>', $ex_as_str2);
        $this->assertStringContainsString('187', $ex_as_str2);
        $this->assertStringContainsString('Base Thrown', $ex_as_str2);
        $this->assertStringContainsString('777', $ex_as_str2);
        $this->assertStringContainsString('AncestorException', $ex_as_str2);
        $this->assertStringContainsString('Ancestor Thrown', $ex_as_str2);
        $this->assertStringContainsString('911', $ex_as_str2);
        $this->assertStringContainsString('DescendantException', $ex_as_str2);
        $this->assertStringContainsString('Descendant Thrown', $ex_as_str2);
    }
}

function my_callback_function() { echo 'hello world!'; }