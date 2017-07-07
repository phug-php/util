<?php

namespace Phug\Test\Util;

use Phug\Util\DocumentLocationInterface;
use Phug\Util\OptionInterface;
use Phug\Util\Partial;
use Phug\Util\PugFileLocationInterface;
use Phug\Util\ScopeInterface;
use stdClass;

//@codingStandardsIgnoreStart
/**
 * Class TestClass.
 */
class TestClass implements DocumentLocationInterface, OptionInterface, ScopeInterface, PugFileLocationInterface
{
    use Partial\AssignmentTrait;
    use Partial\AttributeTrait;
    use Partial\BlockTrait;
    use Partial\CheckTrait;
    use Partial\DocumentLocationTrait;
    use Partial\EscapeTrait;
    use Partial\FilterTrait;
    use Partial\LevelTrait;
    use Partial\ModeTrait;
    use Partial\NameTrait;
    use Partial\OptionTrait;
    use Partial\PairTrait;
    use Partial\PathTrait;
    use Partial\RestTrait;
    use Partial\ScopeTrait;
    use Partial\SubjectTrait;
    use Partial\ValueTrait;
    use Partial\VisibleTrait;
    use Partial\PugFileLocationTrait;

    /**
     * @param int $line
     */
    public function setLine($line)
    {
        $this->line = $line;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }
}

/**
 * Class PartialTest.
 */
class PartialTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Phug\Util\Partial\AssignmentTrait
     * @covers \Phug\Util\Partial\AssignmentTrait::getAssignments
     */
    public function testAssignmentTrait()
    {
        $inst = new TestClass();
        self::assertInstanceOf(\SplObjectStorage::class, $inst->getAssignments());

        $someObj = new stdClass();
        $inst->getAssignments()->attach($someObj);

        self::assertTrue($inst->getAssignments()->contains($someObj));
        self::assertSame(1, $inst->getAssignments()->count());
    }

    /**
     * @covers \Phug\Util\Partial\AttributeTrait
     * @covers \Phug\Util\Partial\AttributeTrait::getAttributes
     */
    public function testAttributeTrait()
    {
        $inst = new TestClass();
        self::assertInstanceOf(\SplObjectStorage::class, $inst->getAttributes());

        $someObj = new stdClass();
        $inst->getAttributes()->attach($someObj);

        self::assertTrue($inst->getAttributes()->contains($someObj));
        self::assertSame(1, $inst->getAttributes()->count());
    }

    /**
     * @covers \Phug\Util\Partial\BlockTrait
     * @covers \Phug\Util\Partial\BlockTrait::isBlock
     * @covers \Phug\Util\Partial\BlockTrait::setIsBlock
     */
    public function testBlockTrait()
    {
        $inst = new TestClass();
        self::assertFalse($inst->isBlock(), 'after ctor');

        $inst->setIsBlock(true);
        self::assertTrue($inst->isBlock(), 'setIsBlock(true)');

        $inst->setIsBlock(false);
        self::assertFalse($inst->isBlock(), 'setIsBlock(false)');
    }

    /**
     * @covers \Phug\Util\Partial\CheckTrait
     * @covers \Phug\Util\Partial\CheckTrait::isChecked
     * @covers \Phug\Util\Partial\CheckTrait::setIsChecked
     * @covers \Phug\Util\Partial\CheckTrait::check
     * @covers \Phug\Util\Partial\CheckTrait::uncheck
     */
    public function testCheckTrait()
    {
        $inst = new TestClass();
        self::assertTrue($inst->isChecked());

        $inst->setIsChecked(false);
        self::assertFalse($inst->isChecked(), 'setIsChecked(false)');

        $inst->setIsChecked(true);
        self::assertTrue($inst->isChecked(), 'setIsChecked(true)');

        $inst->uncheck();
        self::assertFalse($inst->isChecked(), 'uncheck');

        $inst->check();
        self::assertTrue($inst->isChecked(), 'check');
    }

    /**
     * @covers \Phug\Util\Partial\RestTrait
     * @covers \Phug\Util\Partial\RestTrait::isRest
     * @covers \Phug\Util\Partial\RestTrait::setIsRest
     */
    public function testRestTrait()
    {
        $inst = new TestClass();
        self::assertFalse($inst->isRest());

        $inst->setIsRest(true);
        self::assertTrue($inst->isRest(), 'setIsRest(true)');

        $inst->setIsRest(false);
        self::assertFalse($inst->isRest(), 'setIsRest(false)');
    }

    /**
     * @covers \Phug\Util\DocumentLocationInterface
     * @covers \Phug\Util\Partial\DocumentLocationTrait
     * @covers \Phug\Util\Partial\LineGetTrait
     * @covers \Phug\Util\Partial\LineGetTrait::getLine
     * @covers \Phug\Util\Partial\OffsetGetTrait
     * @covers \Phug\Util\Partial\OffsetGetTrait::getOffset
     */
    public function testDocumentLocationTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getLine());
        self::assertNull($inst->getOffset());

        $inst->setLine(15);
        self::assertSame(15, $inst->getLine(), 'getLine()');

        $inst->setOffset(23);
        self::assertSame(23, $inst->getOffset(), 'getOffset()');
    }

    /**
     * @covers \Phug\Util\Partial\LevelTrait
     * @covers \Phug\Util\Partial\LevelTrait::setLevel
     * @covers \Phug\Util\Partial\LevelGetTrait
     * @covers \Phug\Util\Partial\LevelGetTrait::getLevel
     */
    public function testLevelTrait()
    {
        $inst = new TestClass();
        self::assertSame(0, $inst->getLevel());

        $inst->setLevel(101);
        self::assertSame(101, $inst->getLevel());
    }

    /**
     * @covers \Phug\Util\Partial\EscapeTrait
     * @covers \Phug\Util\Partial\EscapeTrait::isEscaped
     * @covers \Phug\Util\Partial\EscapeTrait::setIsEscaped
     * @covers \Phug\Util\Partial\EscapeTrait::escape
     * @covers \Phug\Util\Partial\EscapeTrait::unescape
     */
    public function testEscapeTrait()
    {
        $inst = new TestClass();
        self::assertFalse($inst->isEscaped());

        $inst->setIsEscaped(true);
        self::assertTrue($inst->isEscaped(), 'setIsEscaped(true)');

        $inst->setIsEscaped(false);
        self::assertFalse($inst->isEscaped(), 'setIsEscaped(false)');

        $inst->escape();
        self::assertTrue($inst->isEscaped(), 'escape');

        $inst->unescape();
        self::assertFalse($inst->isEscaped(), 'unescape');
    }

    /**
     * @covers \Phug\Util\Partial\FilterTrait
     * @covers \Phug\Util\Partial\FilterTrait::setFilter
     * @covers \Phug\Util\Partial\FilterTrait::getFilter
     */
    public function testFilterTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getFilter());

        $inst->setFilter('test filter');
        self::assertSame('test filter', $inst->getFilter());
    }

    /**
     * @covers \Phug\Util\Partial\ModeTrait
     * @covers \Phug\Util\Partial\ModeTrait::setMode
     * @covers \Phug\Util\Partial\ModeTrait::getMode
     */
    public function testModeTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getMode());

        $inst->setMode('test mode');
        self::assertSame('test mode', $inst->getMode());
    }

    /**
     * @covers \Phug\Util\Partial\NameTrait
     * @covers \Phug\Util\Partial\NameTrait::setName
     * @covers \Phug\Util\Partial\NameTrait::getName
     */
    public function testNameTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getName());

        $inst->setName('test name');
        self::assertSame('test name', $inst->getName());
    }

    /**
     * @covers \Phug\Util\Partial\PairTrait
     * @covers \Phug\Util\Partial\PairTrait::setKey
     * @covers \Phug\Util\Partial\PairTrait::getKey
     * @covers \Phug\Util\Partial\PairTrait::setItem
     * @covers \Phug\Util\Partial\PairTrait::getItem
     */
    public function testPairTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getKey());
        self::assertNull($inst->getValue());

        $inst->setKey('test key');
        self::assertSame('test key', $inst->getKey());

        $inst->setItem('test item');
        self::assertSame('test item', $inst->getItem());
    }

    /**
     * @covers \Phug\Util\Partial\PathTrait
     * @covers \Phug\Util\Partial\PathTrait::setPath
     * @covers \Phug\Util\Partial\PathTrait::getPath
     */
    public function testPathTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getPath());

        $inst->setPath('test path');
        self::assertSame('test path', $inst->getPath());
    }

    /**
     * @covers \Phug\Util\Partial\SubjectTrait
     * @covers \Phug\Util\Partial\SubjectTrait::setSubject
     * @covers \Phug\Util\Partial\SubjectTrait::getSubject
     */
    public function testSubjectTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getSubject());

        $inst->setSubject('test subject');
        self::assertSame('test subject', $inst->getSubject());
    }

    /**
     * @covers \Phug\Util\Partial\ValueTrait
     * @covers \Phug\Util\Partial\ValueTrait::setValue
     * @covers \Phug\Util\Partial\ValueTrait::getValue
     * @covers \Phug\Util\Partial\StaticMemberTrait
     * @covers \Phug\Util\Partial\StaticMemberTrait::hasStaticMember
     */
    public function testValueTrait()
    {
        $inst = new TestClass();
        self::assertNull($inst->getValue());

        $inst->setValue('test value');
        self::assertSame('test value', $inst->getValue());

        self::assertFalse($inst->hasStaticValue());
        $inst->setValue('$foo');
        self::assertFalse($inst->hasStaticValue());
        $inst->setValue([]);
        self::assertFalse($inst->hasStaticValue());

        $inst->setValue('0x54');
        self::assertTrue($inst->hasStaticValue());
        $inst->setValue('"foo"');
        self::assertTrue($inst->hasStaticValue());

        $inst->setName('"foo"');
        self::assertTrue($inst->hasStaticMember('name'));
        $inst->setName('"$foo"');
        self::assertFalse($inst->hasStaticMember('name'));
    }

    /**
     * @covers \Phug\Util\Partial\VisibleTrait
     * @covers \Phug\Util\Partial\VisibleTrait::isVisible
     * @covers \Phug\Util\Partial\VisibleTrait::setIsVisible
     * @covers \Phug\Util\Partial\VisibleTrait::hide
     * @covers \Phug\Util\Partial\VisibleTrait::show
     */
    public function testVisibleTrait()
    {
        $inst = new TestClass();
        self::assertTrue($inst->isVisible());

        $inst->setIsVisible(false);
        self::assertFalse($inst->isVisible(), 'setIsVisible(false)');

        $inst->setIsVisible(true);
        self::assertTrue($inst->isVisible(), 'setIsVisible(true)');

        $inst->hide();
        self::assertFalse($inst->isVisible(), 'hide');

        $inst->show();
        self::assertTrue($inst->isVisible(), 'show');
    }

    /**
     * @covers \Phug\Util\OptionInterface
     * @covers \Phug\Util\Partial\OptionTrait
     * @covers \Phug\Util\Partial\OptionTrait::setOptionArrays
     * @covers \Phug\Util\Partial\OptionTrait::withOptionsReference
     * @covers \Phug\Util\Partial\OptionTrait::getOptions
     * @covers \Phug\Util\Partial\OptionTrait::setOptions
     * @covers \Phug\Util\Partial\OptionTrait::setOptionsRecursive
     * @covers \Phug\Util\Partial\OptionTrait::getOption
     * @covers \Phug\Util\Partial\OptionTrait::setOption
     * @covers \Phug\Util\Partial\OptionTrait::unsetOption
     */
    public function testOptionTraitAndInterface()
    {
        $inst = new TestClass();
        self::assertInternalType('array', $inst->getOptions());
        self::assertCount(0, $inst->getOptions());

        $options = [
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => 3,
            ],
        ];

        $flatOptions = [
            'b' => 2,
        ];

        $anotherFlatOptions = [
            'a' => 3,
        ];

        $deepOptions = [
            'b' => [
                'c' => 3,
                'e' => 4,
            ],
        ];

        $anotherDeepOptions = [
            'b' => [
                'e' => 5,
                'f' => 6,
            ],
        ];

        $inst->setOptions($options);
        self::assertSame($options, $inst->getOptions(), '$options === $inst->getOptions()');
        self::assertSame(['c' => 2, 'd' => 3], $inst->getOption('b'), '$options[b] === $inst->getOption(b)');

        $cloned = clone $inst;
        $cloned->setOptions($flatOptions);
        self::assertSame(2, $cloned->getOption('b'), '$cloned->getOption(b) === 2');

        $cloned->setOptions([], null, $anotherFlatOptions);
        self::assertSame(3, $cloned->getOption('a'), '$cloned->getOption(a) === 3 (thrid argument)');

        $inst->setOptionsRecursive($deepOptions);
        self::assertSame(['c' => 3, 'd' => 3, 'e' => 4], $inst->getOption('b'), '$inst->getOption(b) (deep)');

        $inst->setOptionsRecursive([], $anotherDeepOptions);
        self::assertSame(5, $inst->getOption('b')['e'], '$inst->getOption(b)[e] === 5 (second argument)');
        self::assertSame(6, $inst->getOption('b')['f'], '$inst->getOption(b)[f] === 6 (second argument)');

        $inst->setOption('b', 5);
        self::assertSame(5, $inst->getOption('b'), '$inst->getOption(b) === 5');

        $inst->setOption(['foo', 'bar'], 3);
        $inst->setOption(['foo', 'baz'], 6);
        self::assertSame(6, $inst->getOption(['foo', 'baz']), '$inst->getOption(foo.bar) === 5');
        $inst->setOption(['foo', 'baz'], 8);
        self::assertSame(8, $inst->getOption(['foo', 'baz']), '$inst->getOption(foo.bar) === 5');
        $inst->unsetOption(['foo', 'baz']);
        self::assertSame(['bar' => 3], $inst->getOption('foo'), '$inst->getOption(foo.bar) === 5');
    }

    /**
     * @covers \Phug\Util\ScopeInterface
     * @covers \Phug\Util\Partial\ScopeTrait
     * @covers \Phug\Util\Partial\ScopeTrait::setScope
     * @covers \Phug\Util\Partial\ScopeTrait::getScopeId
     */
    public function testScopeTrait()
    {
        $inst = new TestClass();
        self::assertSame(null, $inst->getScopeId());

        $foo = new stdClass();
        $inst->setScope($foo);
        self::assertSame(spl_object_hash($foo), $inst->getScopeId());

        $inst->setScope(null);
        self::assertSame(null, $inst->getScopeId());
    }

    /**
     * @covers \Phug\Util\PugFileLocationInterface
     * @covers \Phug\Util\Partial\PugFileLocationTrait
     * @covers \Phug\Util\Partial\PugFileLocationTrait::setPugFile
     * @covers \Phug\Util\Partial\PugFileLocationTrait::getPugFile
     * @covers \Phug\Util\Partial\PugFileLocationTrait::setPugLine
     * @covers \Phug\Util\Partial\PugFileLocationTrait::getPugLine
     * @covers \Phug\Util\Partial\PugFileLocationTrait::setPugOffset
     * @covers \Phug\Util\Partial\PugFileLocationTrait::getPugOffset
     */
    public function testPugFileLocationTrait()
    {
        $inst = new TestClass();
        self::assertSame(null, $inst->getPugFile());
        self::assertSame($inst, $inst->setPugFile('foo.pug'));
        self::assertSame('foo.pug', $inst->getPugFile());

        self::assertSame(null, $inst->getPugLine());
        self::assertSame($inst, $inst->setPugLine(2));
        self::assertSame(2, $inst->getPugLine());

        self::assertSame(null, $inst->getPugOffset());
        self::assertSame($inst, $inst->setPugOffset(15));
        self::assertSame(15, $inst->getPugOffset());
    }
}
//@codingStandardsIgnoreEnd
