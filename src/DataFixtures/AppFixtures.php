<?php

namespace App\DataFixtures;

use App\Entity\FavoriteStation;
use App\Entity\Lift;
use App\Entity\LiftType;
use App\Entity\LostAndFoundObject;
use App\Entity\Shop;
use App\Entity\Slope;
use App\Entity\User;
use App\Entity\WeatherReport;
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

        foreach (['Les Saisies', 'Crest-Volant Cohennoz', 'Notre-Dame-de-Bellecombe', 'Praz-sur-Arly', 'Flumet'] as $StationName){
            $user = new User();
            $user->setStationName($StationName);
            $user->setEmail(implode('-', explode(' ', strtolower($StationName))) . '@example.com');
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            $user->setPresentation($StationName . " : Posé à une altitude idéale entre le massif du Beaufortain et le Val d’Arly, face au Mont-Blanc, l’Espace Diamant est un terrain de jeu exceptionnel.

 

Grâce à son enneigement et son ouverture sur des panoramas d’une rare beauté, l’Espace Diamant est le spot idéal pour pratiquer un ski itinérant et jouer à saute-mouton d’un domaine à l’autre.



Le résultat est à la hauteur de vos attentes : au charme simple de ses stations-villages, s’ajoute le dynamisme des domaines skiables toujours à la recherche de l’innovation et de la qualité.

 

Sur les pistes, le ski est généreux, accessible et sportif. La qualité de vie dans les villages fait souffler un vent de douceur sur les vacances en famille. Finalement, un grand voyage au pays du Diamant ne peut que faire briller les yeux de tous, petits et grands !");
            $user->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
        }

        $types = ['télésiège', 'téléski', 'télécabine'];

        $shopTypes = ['Sport', 'Supermarket', 'Restaurant', 'Coffee', 'Bakery', 'Drugstore', 'Bar', 'Smoke Shop', 'Ski Store'];

        $weatherTypes = ['soleil', 'pluie', 'neige', 'nuageux', 'brumeux'];

        $uvIndex = ['faible', 'modéré', 'fort', "très fort"];

        $snowQuality = ['sèche', 'humide', 'mouillée', 'dure', 'glacée', "poudreuse"];

        foreach ($types as $type) {
            $station = new LiftType();
            $station->setName($type);
            $manager->persist($station);
        }

        $manager->flush();

        $userRepository = $manager->getRepository(User::class);
        $users = array_slice($userRepository->findAll(), 1);

        $typesRepository = $manager->getRepository(LiftType::class);
        $types = $typesRepository->findAll();

        foreach ($users as $user) {

            $weatherReport = new WeatherReport();
            $weatherReport->setStation($user);
            $weatherReport->setTemperature(rand(0, 30) -15);
            $weatherReport->setTemperatureRange("Maximum : " . rand(10, 20) -10 . " / Minimum : " . rand(0, 20) - 20);
            $weatherReport->setTemperatureFelt(rand(0, 20) -15);
            $weatherReport->setType($weatherTypes[rand(0, 4)]);
            $weatherReport->setWind(rand(0, 100));
            $weatherReport->setHumidity(rand(0, 100));
            $weatherReport->setUvIndex($uvIndex[rand(0, 2)]);
            $weatherReport->setAvalancheRisk($uvIndex[rand(0, 3)]);
            $weatherReport->setSnowQuality($snowQuality[rand(0, 5)]);

            $manager->persist($weatherReport);


            for ($i = 0; $i < 3; $i++) {
                $lift = new Lift();
                $lift->setStation($user);
                $lift->setName('Lift ' . $i);
                $lift->setType($types[rand(0, 2)]);
                $lift->setManualOpen(0);
                $lift->setManualClose(0);

                $manager->persist($lift);

                $slope = new Slope();
                $slope->setStation($user);
                $slope->setName('Slope ' . $i);
                $slope->setDifficulty(['black', 'red', 'blue', 'green'][rand(0, 3)]);
                $slope->setManualOpen(0);
                $slope->setManualClose(0);

                $manager->persist($slope);
            }

            for ($i = 0; $i < 10; $i++) {
                $shop = new Shop();
                $shop->setStation($user);
                $shop->setName('Shop' . $i);
                $shop->setType($shopTypes[rand(0, 8)]);

                $manager->persist($shop);
            }
        }

        $manager->flush();

        $slopeRepository = $manager->getRepository(Slope::class);
        $slopes = $slopeRepository->findAll();

        $user = new User();
        $user->setEmail('utilisateur@example.com');
        $user->setPassword($this->hasher->hashPassword($user, 'password'));

        $manager->persist($user);

        $favoriteStation = new FavoriteStation();
        $favoriteStation->setUser($user);
        $favoriteStation->setStation($users[rand(0, count($users) - 2)]);

        $manager->persist($favoriteStation);

        $object = new LostAndFoundObject();
        $object->setDescription('Bonnet rouge');
        $object->setSlope($slopes[rand(0, count($slopes) - 1)]);
        $object->setFoundDate(new \DateTime('2021-01-01 12:00:00'));

        $manager->persist($object);

        $manager->flush();
    }
}
