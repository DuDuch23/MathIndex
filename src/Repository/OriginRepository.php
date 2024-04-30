<?php

namespace App\Repository;

use App\Entity\Origin;
use App\Repository\Traits\PaginateTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\Traits\PaginateTrait;

/**
 * @extends ServiceEntityRepository<Origin>
 *
 * @method Origin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Origin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Origin[]    findAll()
 * @method Origin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OriginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Origin::class);
    }

    public function searchOrigin($searchTerm, $page, $itemsPerPage){
        return $this->createQueryBuilder('o')
            ->where('o.name = :searchTerm')
            ->setParameter('searchTerm', $searchTerm)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }

    use PaginateTrait;

//    /**
//     * @return Origin[] Returns an array of Origin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Origin
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function searchByName($searchTerm, $page, $itemsPerPage){
    return $this->createQueryBuilder('u')
        ->where('u.name = :searchTerm')
        ->setParameter('searchTerm', $searchTerm)
        ->setFirstResult(($page -1) * $itemsPerPage)
        ->setMaxResults($itemsPerPage)
        ->getQuery()
        ->getResult();
}

use PaginateTrait;
}
