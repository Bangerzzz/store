<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 50 ; $i++) { 
            $product = new Product();
            $product
                ->setName("Product$i")
                ->setSlug("Product-$i")
                ->setDescription("Description du Product $i")
                ->setPrice( random_int(50,200) )
                ->setImage("lux.png")
                ;
                $manager->persist($product);
        }
        // $product = new Product();
        

        $manager->flush();
    }
}
