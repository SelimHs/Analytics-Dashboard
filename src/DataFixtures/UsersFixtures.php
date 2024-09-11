<?php

namespace App\DataFixtures;
use App\Entity\User; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder){}
    public function load(ObjectManager $manager): void
    {
        $admin= new User();
        $admin->setEmail('admin@email.tr');
        $admin->setFirstName('Deus');
        $admin->setLastName('Vondeus');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin,'admin'));
        $admin->setRoles(['ROLE_USER,ROLE_ADMIN']);

        $manager->persist($admin);

        $faker=Faker\Factory::create('fr_FR');
        for($i=1; $i<=10; $i++){
            $user= new User();
            $user->setEmail($faker->email);
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setPassword($this->passwordEncoder->hashPassword($user,'admin'));

            $manager->persist($user);
    
        }
        $manager->flush();
    }
}
