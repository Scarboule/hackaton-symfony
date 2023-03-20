<?php

namespace App\DataFixtures;

use App\Entity\Lift;
use App\Entity\LiftType;
use App\Entity\Slope;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $superAdmin = new User();
        $superAdmin->setEmail('superadmin@example.com');
        $superAdmin->setPassword($this->hasher->hashPassword($superAdmin, 'password'));
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);

        $manager->persist($superAdmin);

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail('station' . $i . '@example.com');
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            $user->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
        }

        $types = ['télésiège', 'téléski', 'télécabine'];

        foreach ($types as $type) {
            $station = new LiftType();
            $station->setName($type);

            $manager->persist($station);
        }

        $manager->flush();

        $userRepository = $manager->getRepository(User::class);
        $users = $userRepository->findAll();

        $typesRepository = $manager->getRepository(LiftType::class);
        $types = $typesRepository->findAll();

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $lift = new Lift();
                $lift->setStation($user);
                $lift->setType($types[rand(0, 2)]);

                $manager->persist($lift);

                $slope = new Slope();
                $slope->setStation($user);
                $slope->setName('Slope ' . $i);
                $slope->setDifficulty(['black', 'red', 'blue', 'green'][rand(0, 3)]);

                $manager->persist($slope);
            }
        }

        $manager->flush();
    }
}
