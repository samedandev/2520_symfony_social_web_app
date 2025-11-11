<?php

namespace App\Repository;

use App\Entity\MicroPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MicroPost>
 */
class MicroPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroPost::class);
    }

    /* Content removed after 6.2+ */
    public function add(MicroPost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
 
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
 
    public function remove(MicroPost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
 
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllWithComments(): array 
    {
        // 'p' is the table in the database = MicroPost
        // 'c' is the alliace to the 'p.comments' relation
        return $this->createQueryBuilder('p')
            ->addSelect('c') // selectes all the fileds from all the comments related to this post
            ->leftJoin('p.comments', 'c') // 'leftJoin' selects all the posts, comments or not
            // ->innerJoin('p.comments', 'c') // 'innerJoin' selects only posts with comments
            ->orderBy('p.created', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /* END Content removed after 6.2+ */

    //    /**
    //     * @return MicroPost[] Returns an array of MicroPost objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MicroPost
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
