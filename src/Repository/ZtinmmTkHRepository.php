<?php

namespace App\Repository;

use App\Entity\ZtinmmTkH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZtinmmTkH>
 *
 * @method ZtinmmTkH|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZtinmmTkH|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZtinmmTkH[]    findAll()
 * @method ZtinmmTkH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZtinmmTkHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZtinmmTkH::class);
    }

    public function save(ZtinmmTkH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ZtinmmTkH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return ZtinmmTkH[]
     */
    public function findAllSortedByKonkurs(): array
    {
        return $this->findBy([], ['konkurs_nr' => Criteria::ASC]);
    }

    /**
     * @throws NonUniqueResultException
     */
    public  function getHeadSql()
    {
        $em = $this->getEntityManager();
        $ret = $em->createQuery(
            'select h ,b
            from App\Entity\ZtinmmTkH h
            left join h.bukrsID b
           '
        );
        return $ret->getArrayResult();

    }

    /**
     * @throws NonUniqueResultException
     */
    public  function getHeadQb()
    {


        return $this->createQueryBuilder('h')
     //       ->leftJoin('t001','t', '','')
            ->andWhere('h.konkurs_id = :val')
            ->setParameter('val', 2)
            ->getQuery()
            ->getOneOrNullResult()
        ;


    }
}
