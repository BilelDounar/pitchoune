<?php

namespace App\Repository;

use App\Entity\Rdv;
use App\Entity\FullChild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rdv>
 *
 * @method Rdv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rdv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rdv[]    findAll()
 * @method Rdv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RdvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rdv::class);
    }

    //    /**
    //     * @return Rdv[] Returns an array of Rdv objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Rdv
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findValidatedRdvs(): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.status = :status')
            ->setParameter('status', 'validated')
            ->getQuery()
            ->getResult();
    }


public function findChildIdsByCrecheId(int $crecheId): array
{
    $qb = $this->createQueryBuilder('r')
        ->select('c.id')
        ->join('r.child', 'c') // Joindre l'entité FullChild
        ->join('r.pro', 'p') // Joindre l'entité AddCreche
        ->where('p.id = :crecheId')
        ->setParameter('crecheId', $crecheId)
        ->distinct();

    $results = $qb->getQuery()->getResult();

    $childIds = [];
    foreach ($results as $result) {
        $childIds[] = $result['id']; // Ajouter l'identifiant de l'enfant à la liste
    }

    return $childIds;
}

}
