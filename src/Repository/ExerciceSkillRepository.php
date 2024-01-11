<?php

namespace App\Repository;

use App\Entity\ExerciceSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciceSkill>
 *
 * @method ExerciceSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceSkill[]    findAll()
 * @method ExerciceSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceSkill::class);
    }

//    /**
//     * @return ExerciceSkill[] Returns an array of ExerciceSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExerciceSkill
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
