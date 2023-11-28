<?php

namespace App\Repository;

use App\Entity\DietType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DietType>
 *
 * @method DietType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DietType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DietType[]    findAll()
 * @method DietType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DietType::class);
    }

//    /**
//     * @return DietType[] Returns an array of DietType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DietType
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
