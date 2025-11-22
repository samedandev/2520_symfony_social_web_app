<?php

namespace App\Repository;

use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
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
        return $this->findAllQuery(
            withComments: true
        )->getQuery()->getResult();

        // 'p' is the table in the database = MicroPost
        // 'c' is the alliace to the 'p.comments' relation
        // return $this->createQueryBuilder('p')
        //     ->addSelect('c') // selectes all the fileds from all the comments related to this post
        //     ->leftJoin('p.comments', 'c') // 'leftJoin' selects all the posts, comments or not
        //     // ->innerJoin('p.comments', 'c') // 'innerJoin' selects only posts with comments
        //     ->orderBy('p.created', 'DESC')
        //     ->getQuery()
        //     ->getResult();
    }

    public function findAllByAuthor(
        int | User $author // pass id(int) or User
    ) {
        return $this->findAllQuery(
            withComments:true,
            withAuthors:true,
            withLikes:true,
            withProfiles:true
        )->where('p.author = :author')
        ->setParameter(
            'author',
            $author instanceof User ? $author->getId(): $author
        )->getQuery()->getResult();
    }


    public function findAllByAuthors(
        Collection | array $authors 
    ):array {
        return $this->findAllQuery(
            withComments:true,
            withAuthors:true,
            withLikes:true,
            withProfiles:true
        )->where('p.author IN (:authors)')
        ->setParameter(
            'authors',
            $authors
        )->getQuery()->getResult();
    }

    // MINIMUM LIKES
    public function findAllWithMinLikes(int $minLikes): array 
    {
        $idList = $this->findAllQuery(           
            withLikes:true            
        )->select('p.id') // return only the id
        ->groupBy('p.id')  // 'p' is alias for posts
        ->having('COUNT(l) >= :minLikes') // 'l' is alias for likes
        ->setParameter('minLikes', $minLikes) // the passed parameter
        ->getQuery()->getResult(Query::HYDRATE_SCALAR_COLUMN);

        return $this->findAllQuery(
            withComments:true,
            withAuthors:true,
            withLikes:true,
            withProfiles:true
        )->where('p.id in (:idList)')
            ->setParameter('idList', $idList)
            ->getQuery()->getResult();
    }

    private function findAllQuery(
        bool $withComments = false,
        bool $withLikes = false,
        bool $withAuthors = false,
        bool $withProfiles = false,
    ): QueryBuilder {
        $query = $this->createQueryBuilder('p');
        if ($withComments) {
            $query->leftJoin('p.comments', 'c')
                ->addSelect('c');
        }
        if ($withLikes) {
            $query->leftJoin('p.likedBy', 'l')
                ->addSelect('l');
        }
        if ($withAuthors || $withProfiles) {
            $query->leftJoin('p.author', 'a')
                ->addSelect('a');
        }
        if ($withProfiles) {
            $query->leftJoin('a.userProfile', 'up')
                ->addSelect('up');
        }

        return $query->orderBy('p.created', 'DESC');
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
