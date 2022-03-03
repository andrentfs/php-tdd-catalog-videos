<?php 

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        $categoryId = '1';
        $categoryName = 'name cat';

        // $this->mockEntity = Mockery::mock(Category::class, [
        //     $categoryId,
        //     $categoryName,
        // ]);

        $this->mockRepo = Mockery::mock(stdClass::class,CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('insert');// ->andReturn($this->mockEntity);
        
        
        $useCase = new CreateCategoryUseCase($this->mockRepo);
        $useCase->execute();

        $this->assertTrue(true);

        Mockery::close();
    }
}