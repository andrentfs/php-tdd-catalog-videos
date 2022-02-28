<?php 

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    /** 
     * Interface insert
     * @param Category $category 
     * @return Category 
     */
    public function insert(Category $category): Category;
    public function findById(string $categoryId): Category;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): array;
    public function update(Category $category): Category;
    public function delete(string $categoryId): bool;
    public function toCategory(object $data): Category;
}