<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $properties = ['Bank XYZ', 'Grocery store ABC', 'Office AAA', 'Office BBB', 'Office CCC', 'Residential', 'Private school QWE'];

        foreach ($properties as $propertyName) {
            $property = New Property();
            $property->setName($propertyName);
            $manager->persist($property);
        }

        $manager->flush();
    }
}
