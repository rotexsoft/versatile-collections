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
        $this->assertEquals('bool', Utils::gettype(true));
        $this->assertEquals('int', Utils::gettype(777));
        $this->assertEquals('float', Utils::gettype(777.777));
        $this->assertEquals('string', Utils::gettype('777.777'));
        $this->assertEquals('string', Utils::gettype("777.777"));
        $this->assertEquals('string', Utils::gettype($heredoc));
        $this->assertEquals('string', Utils::gettype($nowdoc));
        $this->assertEquals('array', Utils::gettype([]));
        $this->assertEquals(\ArrayObject::class, Utils::gettype(new ArrayObject()));
        $this->assertEquals('resource (stream)', Utils::gettype(tmpfile()));
        $this->assertEquals('null', Utils::gettype(NULL));
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

    public function testThatBindObjectAndScopeToClosureWorksAsExpected1() {
        
        $this->expectException(\InvalidArgumentException::class);
        
        @Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable([\Ancestor::class, 'who']), $this); // static method call on a class
    }

    public function testThatBindObjectAndScopeToClosureWorksAsExpected2() {
        
        $this->expectException(\InvalidArgumentException::class);
        
        @Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable(\Descendant::class.'::who'), $this); // static method call string syntax
    }

    public function testThatBindObjectAndScopeToClosureWorksAsExpected3() {
        
        $this->expectException(\InvalidArgumentException::class);
        
        @Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable([\Descendant::class, 'parent::who']), $this); // parent class' static method call
    }

    public function testThatBindObjectAndScopeToClosureWorksAsExpected4() {
        
        $this->expectException(\InvalidArgumentException::class);
        
        @Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable([ (new \Descendant() ), 'echoOut']), $this); // instance method call on a class instance
    }

    public function testThatBindObjectAndScopeToClosureWorksAsExpected5() {
        
        $this->expectException(\InvalidArgumentException::class);
        
        @Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable( (new \Descendant()) ), $this); // instance of class that has __invoke()
    }
    
    public function testThatBindObjectAndScopeToClosureWorksAsExpected() {
        
        $this->assertTrue(
            Utils::bindObjectAndScopeToClosure(Utils::getClosureFromCallable('my_callback_function'), $this) instanceof \Closure
        ); // from non-anonymous & non-class function
        
        $anon_func = function($a) {
            return $a * 2;
        };
        $this->assertTrue(
            Utils::bindObjectAndScopeToClosure($anon_func, $this) instanceof \Closure    
        ); // anonymous function a.k.a Closure
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