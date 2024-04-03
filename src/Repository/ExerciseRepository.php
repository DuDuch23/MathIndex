<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exercise>
 *
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    public function searchExerciceByClassroomThematicKeywords($classroomName, $thematicName, $keywords){
        return $this->createQueryBuilder('exercice')
            ->where('exercice.classroom_id = :classroomName')
            ->andWhere('exercice.thematic_id = :thematicName')
            ->andWhere('exercice.keywords LIKE :keywords')
            ->setParameter('classroomName', $classroomName)
            ->setParameter('thematicName', $thematicName)
            ->setParameter('keywords', '%'.$keywords.'%')
            ->getQuery()
            ->getResult();
    }

    public function searchExerciceByClassroom($classroomName){
        return $this->createQueryBuilder('exercice')
            ->where('exercice.classroom_id = :classroomName')
            ->setParameter('classroomName', $classroomName)
            ->getQuery()
            ->getResult();
    }

    public function searchExerciceByThematic($thematicName){
        return $this->createQueryBuilder('exercice')
            ->andWhere('exercice.thematic_id = :thematicName')
            ->setParameter('thematicName', $thematicName)
            ->getQuery()
            ->getResult();
    }

    public function searchExerciceByKeywords($keywords){
        return $this->createQueryBuilder('exercice')
            ->andWhere('exercice.keywords LIKE :keywords')
            ->setParameter('keywords', '%'.$keywords.'%')
            ->getQuery()
            ->getResult();
    }

    public function searchExerciceByClassroomThematic($classroomName, $thematicName){
        return $this->createQueryBuilder('exercice')
            ->where('exercice.classroom_id = :classroomName')
            ->andWhere('exercice.thematic_id = :thematicName')
            ->setParameter('classroomName', $classroomName)
            ->setParameter('thematicName', $thematicName)
            ->getQuery()
            ->getResult();
    }

    public function searchExerciceByClassroomcKeywords($classroomName, $keywords){
        return $this->createQueryBuilder('exercice')
            ->where('exercice.classroom_id = :classroomName')
            ->andWhere('exercice.keywords LIKE :keywords')
            ->setParameter('classroomName', $classroomName)
            ->setParameter('keywords', '%'.$keywords.'%')
            ->getQuery()
            ->getResult();
    }
    public function searchExerciceByThematicKeywords($thematicName, $keywords){
        return $this->createQueryBuilder('exercice')
            ->andWhere('exercice.thematic_id = :thematicName')
            ->andWhere('exercice.keywords LIKE :keywords')
            ->setParameter('thematicName', $thematicName)
            ->setParameter('keywords', '%'.$keywords.'%')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Exercise[] Returns an array of Exercise objects
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

    //    public function findOneBySomeField($value): ?Exercise
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
