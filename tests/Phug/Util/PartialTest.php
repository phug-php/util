<?php

namespace Phug\Test\Util;

use Phug\Util\OptionInterface;
use Phug\Util\Partial;
use stdClass;

//@codingStandardsIgnoreStart
class TestClass implements OptionInterface
{
    use Partial\AssignmentTrait;
    use Partial\AttributeTrait;
    use Partial\BlockTrait;
    use Partial\CheckTrait;
    use Partial\EscapeTrait;
    use Partial\FilterTrait;
    use Partial\ModeTrait;
    use Partial\NameTrait;
    use Partial\PairTrait;
    use Partial\PathTrait;
    use Partial\SubjectTrait;
    use Partial\ValueTrait;
    use Partial\VisibleTrait;
    use Partial\OptionTrait;
}


class PartialTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @covers Phug\Util\Partial\AssignmentTrait
     * @covers Phug\Util\Partial\AssignmentTrait::getAssignments
     */
    public function testAssignmentTrait()
    {

        $inst = new TestClass;
        $this->assertInstanceOf(\SplObjectStorage::class, $inst->getAssignments());

        $someObj = new stdClass();
        $inst->getAssignments()->attach($someObj);

        $this->assertTrue($inst->getAssignments()->contains($someObj));
        $this->assertEquals(1, $inst->getAssignments()->count());
    }

    /**
     * @covers Phug\Util\Partial\AttributeTrait
     * @covers Phug\Util\Partial\AttributeTrait::getAttributes
     */
    public function testAttributeTrait()
    {

        $inst = new TestClass;
        $this->assertInstanceOf(\SplObjectStorage::class, $inst->getAttributes());

        $someObj = new stdClass();
        $inst->getAttributes()->attach($someObj);

        $this->assertTrue($inst->getAttributes()->contains($someObj));
        $this->assertEquals(1, $inst->getAttributes()->count());
    }

    /**
     * @covers Phug\Util\Partial\BlockTrait
     * @covers Phug\Util\Partial\BlockTrait::isBlock
     * @covers Phug\Util\Partial\BlockTrait::setIsBlock
     */
    public function testBlockTrait()
    {

        $inst = new TestClass;
        $this->assertFalse($inst->isBlock(), 'after ctor');

        $inst->setIsBlock(true);
        $this->assertTrue($inst->isBlock(), 'setIsBlock(true)');

        $inst->setIsBlock(false);
        $this->assertFalse($inst->isBlock(), 'setIsBlock(false)');
    }

    /**
     * @covers Phug\Util\Partial\CheckTrait
     * @covers Phug\Util\Partial\CheckTrait::isChecked
     * @covers Phug\Util\Partial\CheckTrait::setIsChecked
     * @covers Phug\Util\Partial\CheckTrait::check
     * @covers Phug\Util\Partial\CheckTrait::uncheck
     */
    public function testCheckTrait()
    {

        $inst = new TestClass;
        $this->assertTrue($inst->isChecked());

        $inst->setIsChecked(false);
        $this->assertFalse($inst->isChecked(), 'setIsChecked(false)');

        $inst->setIsChecked(true);
        $this->assertTrue($inst->isChecked(), 'setIsChecked(true)');

        $inst->uncheck();
        $this->assertFalse($inst->isChecked(), 'uncheck');

        $inst->check();
        $this->assertTrue($inst->isChecked(), 'check');
    }

    /**
     * @covers Phug\Util\Partial\EscapeTrait
     * @covers Phug\Util\Partial\EscapeTrait::isEscaped
     * @covers Phug\Util\Partial\EscapeTrait::setIsEscaped
     * @covers Phug\Util\Partial\EscapeTrait::escape
     * @covers Phug\Util\Partial\EscapeTrait::unescape
     */
    public function testEscapeTrait()
    {

        $inst = new TestClass;
        $this->assertFalse($inst->isEscaped());

        $inst->setIsEscaped(true);
        $this->assertTrue($inst->isEscaped(), 'setIsEscaped(true)');

        $inst->setIsEscaped(false);
        $this->assertFalse($inst->isEscaped(), 'setIsEscaped(false)');

        $inst->escape();
        $this->assertTrue($inst->isEscaped(), 'escape');

        $inst->unescape();
        $this->assertFalse($inst->isEscaped(), 'unescape');
    }

    /**
     * @covers Phug\Util\Partial\FilterTrait
     * @covers Phug\Util\Partial\FilterTrait::setFilter
     * @covers Phug\Util\Partial\FilterTrait::getFilter
     */
    public function testFilterTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getFilter());

        $inst->setFilter('test filter');
        $this->assertEquals('test filter', $inst->getFilter());
    }

    /**
     * @covers Phug\Util\Partial\ModeTrait
     * @covers Phug\Util\Partial\ModeTrait::setMode
     * @covers Phug\Util\Partial\ModeTrait::getMode
     */
    public function testModeTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getMode());

        $inst->setMode('test mode');
        $this->assertEquals('test mode', $inst->getMode());
    }

    /**
     * @covers Phug\Util\Partial\NameTrait
     * @covers Phug\Util\Partial\NameTrait::setName
     * @covers Phug\Util\Partial\NameTrait::getName
     */
    public function testNameTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getName());

        $inst->setName('test name');
        $this->assertEquals('test name', $inst->getName());
    }

    /**
     * @covers Phug\Util\Partial\PairTrait
     * @covers Phug\Util\Partial\PairTrait::setKey
     * @covers Phug\Util\Partial\PairTrait::getKey
     * @covers Phug\Util\Partial\PairTrait::setItem
     * @covers Phug\Util\Partial\PairTrait::getItem
     */
    public function testPairTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getKey());
        $this->assertNull($inst->getValue());

        $inst->setKey('test key');
        $this->assertEquals('test key', $inst->getKey());

        $inst->setItem('test item');
        $this->assertEquals('test item', $inst->getItem());
    }

    /**
     * @covers Phug\Util\Partial\PathTrait
     * @covers Phug\Util\Partial\PathTrait::setPath
     * @covers Phug\Util\Partial\PathTrait::getPath
     */
    public function testPathTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getPath());

        $inst->setPath('test path');
        $this->assertEquals('test path', $inst->getPath());
    }

    /**
     * @covers Phug\Util\Partial\SubjectTrait
     * @covers Phug\Util\Partial\SubjectTrait::setSubject
     * @covers Phug\Util\Partial\SubjectTrait::getSubject
     */
    public function testSubjectTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getSubject());

        $inst->setSubject('test subject');
        $this->assertEquals('test subject', $inst->getSubject());
    }

    /**
     * @covers Phug\Util\Partial\ValueTrait
     * @covers Phug\Util\Partial\ValueTrait::setValue
     * @covers Phug\Util\Partial\ValueTrait::getValue
     */
    public function testValueTrait()
    {

        $inst = new TestClass;
        $this->assertNull($inst->getValue());

        $inst->setValue('test value');
        $this->assertEquals('test value', $inst->getValue());
    }

    /**
     * @covers Phug\Util\Partial\VisibleTrait
     * @covers Phug\Util\Partial\VisibleTrait::isVisible
     * @covers Phug\Util\Partial\VisibleTrait::setIsVisible
     * @covers Phug\Util\Partial\VisibleTrait::hide
     * @covers Phug\Util\Partial\VisibleTrait::show
     */
    public function testVisibleTrait()
    {

        $inst = new TestClass;
        $this->assertTrue($inst->isVisible());

        $inst->setIsVisible(false);
        $this->assertFalse($inst->isVisible(), 'setIsVisible(false)');

        $inst->setIsVisible(true);
        $this->assertTrue($inst->isVisible(), 'setIsVisible(true)');

        $inst->hide();
        $this->assertFalse($inst->isVisible(), 'hide');

        $inst->show();
        $this->assertTrue($inst->isVisible(), 'show');
    }

    /**
     * @covers Phug\Util\OptionInterface
     * @covers Phug\Util\Partial\OptionTrait
     * @covers Phug\Util\Partial\OptionTrait::getOptions
     * @covers Phug\Util\Partial\OptionTrait::setOptions
     * @covers Phug\Util\Partial\OptionTrait::getOption
     * @covers Phug\Util\Partial\OptionTrait::setOption
     */
    public function testOptionTraitAndInterface()
    {

        $inst = new TestClass;
        $this->assertInternalType('array', $inst->getOptions());
        $this->assertCount(0, $inst->getOptions());

        $options = [
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => 3
            ]
        ];

        $flatOptions = [
            'b' => 2
        ];

        $deepOptions = [
            'b' => [
                'c' => 3,
                'e' => 4
            ]
        ];

        $inst->setOptions($options);
        $this->assertEquals($options, $inst->getOptions(), '$options === $inst->getOptions()');
        $this->assertEquals(['c' => 2, 'd' => 3], $inst->getOption('b'), '$options[b] === $inst->getOption(b)');

        $cloned = clone $inst;
        $cloned->setOptions($flatOptions);
        $this->assertEquals(2, $cloned->getOption('b'), '$cloned->getOption(b) === 2');

        $inst->setOptions($deepOptions, true);
        $this->assertEquals(['c' => 3, 'd' => 3, 'e' => 4], $inst->getOption('b'), '$inst->getOption(b) (deep)');

        $inst->setOption('b', 5);
        $this->assertEquals(5, $inst->getOption('b'), '$inst->getOption(b) === 5');
    }
}
//@codingStandardsIgnoreEnd
