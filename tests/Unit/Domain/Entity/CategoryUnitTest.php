<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testGetAtributes()
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true
        );
        
        $this->assertNotEmpty($category->createdAt());
        $this->assertNotEmpty($category->id);
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated()
    {
        $cagetory = new Category(
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
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'name',
            description: 'desc',
            isActive: true,
            createdAt: '2023-01-01 00:00:00',
        );

        $category->update(
            name: 'updated',
            description: 'desc_updated'
        );

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals('updated', $category->name);
        $this->assertEquals('desc_updated', $category->description);
    }

    public function testUpdateEmptyDescription()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id:  $uuid,
            name: 'name',
            description: 'desc',
        );

        $category->update(
            name: 'updated',
            description: $category->description
        );

        $this->assertEquals('updated', $category->name);
        $this->assertEquals('desc', $category->description);
    }

    public function testId()
    {
        $category = new Category(
            name: 'test name',
        );

        $this->assertNotEmpty('id', $category->id);
        $uuid = (string) Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: 'test name',
        );

        $category->update(
            name: 'new name',
            description: 'new desc'
        );

        $this->assertEquals($uuid, $category->id());
    }
}