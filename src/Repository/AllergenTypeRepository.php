<?php

namespace App\Repository;

use App\Entity\AllergenType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AllergenType>
 *
 * @method AllergenType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllergenType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllergenType[]    findAll()
 * @method AllergenType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllergenTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AllergenType::class);
    }

//    /**
//     * @return AllergenType[] Returns an array of AllergenType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AllergenType
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
