<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;

class LoadProgrammationCircuitData extends Fixture {
    
    public function load(ObjectManager $manager) {
        
        $circuit=$this->getReference('vietnam-circuit');
        $programmationcircuit = new ProgrammationCircuit();
        $programmationcircuit->setDateDepart(new \DateTime('2018-08-05'));
        $programmationcircuit->setNombrePersonnes(25);
        $programmationcircuit->setPrix(100);
        $programmationcircuit->setImg('vietnam.jpg');
        $circuit->addProgrammationCircuit($programmationcircuit);
        $manager->persist($programmationcircuit);
        $manager->persist($circuit);
        
        $circuit=$this->getReference('idf-circuit');
        $programmationcircuit = new ProgrammationCircuit();
        $programmationcircuit->setDateDepart(new \DateTime('2018-12-25'));
        $programmationcircuit->setNombrePersonnes(40);
        $programmationcircuit->setPrix(100);
        $programmationcircuit->setImg('idf.jpg');
        $circuit->addProgrammationCircuit($programmationcircuit);
        $manager->persist($programmationcircuit);
        $manager->persist($circuit);
        
        $circuit=$this->getReference('italie-circuit');
        $programmationcircuit = new ProgrammationCircuit();
        $programmationcircuit->setDateDepart(new \DateTime('2018-10-25'));
        $programmationcircuit->setNombrePersonnes(40);
        $programmationcircuit->setPrix(100);
        $programmationcircuit->setImg('italie.jpg');
        $circuit->addProgrammationCircuit($programmationcircuit);
        $manager->persist($programmationcircuit);
        $manager->persist($circuit);
       
        $manager->flush();
        
    }
    
    
}