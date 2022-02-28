<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testGetAtributes()
    {
        $category = new Category(
            id: 'uuid.value',
            name: 'name',
            description: 'desc',
            isActive: true
        );
        
        $this->assertEquals('uuid.value', $category->id);
        $this->assertEquals('name', $category->name);
        $this->assertEquals('desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated()
    {
        $cagetory = new Category(
            id: 'uuid.value',
            name: 'name',
            description: 'desc',
            isActive: false,
        );

        $this->assertFalse($cagetory->isActive);

        $cagetory->activate();

        $this->assertTrue($cagetory->isActive);
    }

    public function testDisabled()
    {
        $cagetory = new Category(
            id: 'uuid.value',
            name: 'name',
            description: 'desc',
        );

        $this->assertTrue($cagetory->isActive);

        $cagetory->disable();

        $this->assertFalse($cagetory->isActive);
    }

    public function testExceptionName()
    {
        try {
            $category = new Category(
                id: 'uuid.value',
                name: 'na',
                description: 'desc',
            );

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
            );
        }
    }

    public function testExceptionDescription()
    {
        try {
            $category = new Category(
                id: 'uuid.value',
                name: 'name',
                description: random_bytes(9999999),
            );

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
            );
        }
    }

    public function testUpdate()
    {
        $category = new Category(
            id: 'uuid.value',
            name: 'name',
            description: 'desc',
        );

        $category->update(
            name: 'updated',
            description: 'desc_updated'
        );

        $this->assertEquals('updated', $category->name);
        $this->assertEquals('desc_updated', $category->description);
    }

    public function testUpdateEmptyDescription()
    {
        $category = new Category(
            id: 'uuid.value',
            name: 'name',
            description: 'desc',
        );

        $category->update(
            name: 'updated',
            description: 'desc'
        );

        $this->assertEquals('updated', $category->name);
        $this->assertEquals('desc', $category->description);
    }
}