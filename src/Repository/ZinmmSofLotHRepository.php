<?php

namespace App\Repository;

use App\Entity\ZinmmSofLotH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZinmmSofLotH>
 *
 * @method ZinmmSofLotH|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZinmmSofLotH|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZinmmSofLotH[]    findAll()
 * @method ZinmmSofLotH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZinmmSofLotHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZinmmSofLotH::class);
    }

    public function save(ZinmmSofLotH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ZinmmSofLotH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ZinmmSofLotH[] Returns an array of ZinmmSofLotH objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('z.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ZinmmSofLotH
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
