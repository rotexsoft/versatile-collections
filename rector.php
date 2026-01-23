<?php
declare(strict_types=1);

use Rector\Set\ValueObject\SetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfigurator): void {

    // Define what rule sets will be applied
    $rectorConfigurator->import(SetList::PHP_52);
    $rectorConfigurator->import(SetList::PHP_53);
    $rectorConfigurator->import(SetList::PHP_54);
    $rectorConfigurator->import(SetList::PHP_55);
    $rectorConfigurator->import(SetList::PHP_56);
    $rectorConfigurator->import(SetList::PHP_70);
    $rectorConfigurator->import(SetList::PHP_71);
    $rectorConfigurator->import(SetList::PHP_72);
    $rectorConfigurator->import(SetList::PHP_73);
    $rectorConfigurator->import(SetList::PHP_74);
    $rectorConfigurator->import(SetList::PHP_80);
    $rectorConfigurator->import(SetList::PHP_81);
    $rectorConfigurator->import(SetList::PHP_82);
    $rectorConfigurator->import(SetList::DEAD_CODE);
    $rectorConfigurator->import(SetList::INSTANCEOF);
    //$rectorConfigurator->import(SetList::CODE_QUALITY);
    $rectorConfigurator->import(SetList::TYPE_DECLARATION);
    $rectorConfigurator->import(SetList::TYPE_DECLARATION_DOCBLOCKS);
        
    $skipables = [
        \Rector\DeadCode\Rector\TryCatch\RemoveDeadCatchRector::class,
        \Rector\Php81\Rector\MethodCall\RemoveReflectionSetAccessibleCallsRector::class,
        \Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector::class,
//        \Rector\CodeQuality\Rector\If_\ShortenElseIfRector::class,
//        \Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector::class,
//        \Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class,
//        \Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector::class,
//        \Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector::class,
//        //\Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector::class,
//        \Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector::class,
//        \Rector\Php71\Rector\FuncCall\CountOnNullRector::class,
//        //\Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector::class,
//        \Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector::class
    ];
    
    $rectorConfigurator->skip($skipables);
};
