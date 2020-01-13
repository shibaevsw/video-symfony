<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadMainCategories($manager);
        $this->loadElectronics($manager);
        $this->loadComputers($manager);
        $this->loadLaptops($manager);
        $this->loadBooks($manager);
        $this->loadMovies($manager);
        $this->loadRomans($manager);
    }

    private function loadMainCategories($manager)
    {
        foreach ($this->getMainCategoriesSData() as [$name]) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }
        $manager->flush();
    }

    private function loadElectronics($manager)
    {
        $this->loadSubCategories($manager, 'Electronics', 1);
    }

    private function loadComputers($manager)
    {
        $this->loadSubCategories($manager, 'Computers', 6);
    }

    private function loadLaptops($manager)
    {
        $this->loadSubCategories($manager, 'Laptops', 8);
    }

    private function loadBooks($manager)
    {
        $this->loadSubCategories($manager, 'Books', 3);
    }

    private function loadMovies($manager)
    {
        $this->loadSubCategories($manager, 'Movies', 4);
    }

    private function loadRomans($manager)
    {
        $this->loadSubCategories($manager, 'Romans', 18);
    }

    private function loadSubCategories($manager, $category, $parent_id)
    {
        $parent = $manager->getRepository(Category::class)->find($parent_id);
        $methodName = "get{$category}Data";

        foreach ($this->$methodName() as [$name]) {
            $category = new Category();
            $manager->persist($category);
            $category->setParent($parent);
            $category->setName($name);
        }

        $manager->flush();
    }

    private function getMainCategoriesSData()
    {
        return [
            ['Electronics', 1],
            ['Toys', 2],
            ['Books', 3],
            ['Movies', 4]
        ];
    }

    private function getElectronicsData()
    {
        return [
            ['Cameras', 5],
            ['Computers', 6],
            ['Cell Phones', 7],
        ];
    }

    private function getComputersData()
    {
        return [
            ['Laptops', 8],
            ['Desktops', 9],
        ];
    }

    private function getLaptopsData()
    {
        return [
            ['Apple', 10],
            ['Asus', 11],
            ['Dell', 12],
            ['Lenovo', 13],
            ['HP', 14],
        ];
    }

    private function getBooksData()
    {
        return [
            ['Children\'s Books', 15],
            ['Kindle eBooks', 16],
        ];
    }

    private function getMoviesData()
    {
        return [
            ['Family', 17],
            ['Romans', 18],
        ];
    }

    private function getRomansData()
    {
        return [
            ['Romantic Comedy', 19],
            ['Romantic Drama', 20],
        ];
    }
}
