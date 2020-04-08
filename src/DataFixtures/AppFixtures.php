<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $categories = [];

        for ($i = 0; $i < 20; $i++) {
            $category = new Category();
            $category->setName($faker->word());

            $manager->persist($category);
            $categories[] = $category;
        }

        for ($j = 0; $j < 30; $j++) {
            $product = new Product();
            $product->setName($faker->word())
                ->setDescritpion($faker->word())
                ->setPrice($faker->numberBetween(5, 50))
                ->addCategory($categories[$faker->numberBetween(0, count($categories) - 1)]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
