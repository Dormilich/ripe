<?php

namespace Dormilich\RIPE\Tests\Factory;

use Dormilich\RIPE\Entity\Mntner;
use Dormilich\RIPE\Entity\Person;
use Dormilich\RIPE\Entity\Poem;
use Dormilich\RIPE\Entity\PoeticForm;
use Dormilich\RIPE\Factory\EntityFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EntityFactory::class)]
#[UsesClass(Poem::class), UsesClass(PoeticForm::class), UsesClass(Person::class), UsesClass(Mntner::class)]
class EntityFactoryTest extends TestCase
{
    #[Test, TestDox('creates an object from its type')]
    public function create()
    {
        $factory = new EntityFactory();
        $poem = $factory->create('poem', 'POEM-DESTINY');

        $this->assertInstanceOf(Poem::class, $poem);
        $this->assertSame('POEM-DESTINY', $poem->getHandle());
    }

    #[Test, TestDox('adds transformers to an object')]
    public function transformer()
    {
        $factory = new EntityFactory();
        $poem = $factory->create('poem', 'POEM-DESTINY');
        $poem->set('author', new Person('TEST-RIPE'));
        $poem->set('form', new PoeticForm('FORM-HAIKU'));
        $poem->set('mnt-by', new Mntner('LIM-MNT'));
        $poem->set('source', 'TEST');
        $poem->set('created', '2002-02-02T03:15:20Z');
        $poem->set('last-modified', '2020-02-02T04:21:35Z');
        $poem->set('descr', 'Fleeting Destiny');
        $poem->add('text', 'Wave of destiny');
        $poem->add('text', 'So many lives in motion');
        $poem->add('text', 'Pebble in a pond');

        $this->assertSame(['TEST-RIPE'], $poem->get('author'));
        $this->assertSame('FORM-HAIKU', $poem->get('form'));
        $this->assertSame('LIM-MNT', $poem->get('mnt-by'));

        $poem = $factory->addTransformers($poem);

        $this->assertContainsOnlyInstancesOf(Person::class, $poem->get('author'));
        $this->assertInstanceOf(PoeticForm::class, $poem->get('form'));
        $this->assertInstanceOf(Mntner::class, $poem->get('mnt-by'));
        $this->assertInstanceOf(\DateTimeInterface::class, $poem->get('created'));
        $this->assertInstanceOf(\DateTimeInterface::class, $poem->get('last-modified'));
        $this->assertSame('FORM-HAIKU', $poem->get('form')->getHandle());
        $this->assertSame('LIM-MNT', $poem->get('mnt-by')->getHandle());
    }

    #[Test, TestDox('fails to instantiate unknown type')]
    public function not_found()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Object of type "test" does not exist.');

        $factory = new EntityFactory();
        $factory->create('test');
    }
}
