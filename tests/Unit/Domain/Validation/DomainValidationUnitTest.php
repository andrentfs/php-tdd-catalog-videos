<?php 

namespace Test\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            DomainValidation::notNull('');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'Should not be empty or null'
            );
        }
    }

    public function testNotNullAndMessageException()
    {
        try {
            DomainValidation::notNull('');
            $this->assertTrue(false, 'Not null');
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'Not null'
            );
        }
    }

    public function testMaxLength()
    {
        try {
            DomainValidation::strMaxLength('abc', 2);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'The value must not be greater than 2 characters'
            );
        }
    }

    public function testMaxLengthCustomMessageException()
    {
        try {
            DomainValidation::strMaxLength('abc', 2, 'Invalid Total');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'Invalid Total'
            );
        }
    }

    public function testMaxLengthOk()
    {
        DomainValidation::strMaxLength('abc');
        $this->assertTrue(true);
    }

    public function testMinLength()
    {
        try {
            DomainValidation::strMinLength('abc', 5);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'The value must be at least 5 characters'
            );
        }
    }

    public function testMinLengthCustomMessageException()
    {
        try {
            DomainValidation::strMinLength('abc', 5, 'Qtd Min Invalid');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'Qtd Min Invalid'
            );
        }
    }

    public function testCanNullAndMaxLength()
    {
        try {
            DomainValidation::strCanNullAndMaxLength('abc',2);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th
            );
        }
    }

    public function testCanNullAndMaxLengthWithEmptyValue()
    {
        DomainValidation::strCanNullAndMaxLength('');
        $this->assertTrue(true);
    }

    public function testCanNullAndMaxLengthCustomMessageException()
    {
        try {
            DomainValidation::strCanNullAndMaxLength('abc',2, 'Qty Invalid');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(
                EntityValidationException::class,
                $th,
                'Qty Invalid'
            );
        }
    }
}