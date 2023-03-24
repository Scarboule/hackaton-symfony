<?php

namespace App\Repository;

use App\Entity\LostAndFoundObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LostAndFoundObject>
 *
 * @method LostAndFoundObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method LostAndFoundObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method LostAndFoundObject[]    findAll()
 * @method LostAndFoundObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LostAndFoundObjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LostAndFoundObject::class);
    }

    public function save(LostAndFoundObject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LostAndFoundObject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LostAndFoundObject[] Returns an array of LostAndFoundObject objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LostAndFoundObject
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
