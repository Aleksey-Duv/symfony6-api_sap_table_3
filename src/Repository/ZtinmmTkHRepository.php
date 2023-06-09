<?php

namespace App\Repository;

use App\Entity\T001;
use App\Entity\ZtinmmTkH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Exception;
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

    public function findAllSortedByKonkurs(): array
    {
        return $this->findBy([], ['konkurs_nr' => Criteria::ASC]);
    }
//// DQL///////////////////////////////////////////////////////////////////////DQL/////////////////////////////////////////////////////
    public  function getHeadDql_all($maxResults): array //Обьеденение 3 таблиц, групировка, получение количества лотов, вывод всех записей, с сортировкой
    {
        $em = $this->getEntityManager();
        $ret = $em->createQuery(
            'select h.konkurs_id, h.konkurs_nr, h.konkurs_name, h.konkurs_name ,b.bukrs, b.butxt, count( lot ) lotCountDQL
            from App\Entity\ZtinmmTkH h
            inner join h.bukrsID b
            left join h.zinmmSofLotHs lot
            group by h.konkurs_id, h.konkurs_nr,h.konkurs_name, b.bukrs, b.butxt
            order by h.konkurs_id desc
           '
        );

        $ret->setFirstResult(0)->setMaxResults( $maxResults);

        return $ret->getArrayResult();
    }
    public  function getHeadDql($bukrs, $maxResults): array//Обьеденение 2 таблиц, получение количества лотов, вывод  записей по bukrs, с сортировкой
    {
        $em = $this->getEntityManager();
        $ret = $em->createQuery(
            'select h, b
            from App\Entity\ZtinmmTkH h
            inner join h.bukrsID b
            where b.bukrs = :bukrs 
            order by h.konkurs_id desc
           '
        )->setParameter('bukrs', $bukrs)
        ->setFirstResult(0)->setMaxResults($maxResults);
      //  echo $ret->getDQL();
        return $ret->getArrayResult();
    }
    public  function getHeadDql1($bukrs,$maxResults): array//Обьеденение 3 таблиц, вывод  записей по bukrs, с сортировкой
    {
        $em = $this->getEntityManager();
        $ret = $em->createQuery(
            'select h, b, lot
            from App\Entity\ZtinmmTkH h
            inner join h.bukrsID b
            left join h.zinmmSofLotHs lot
            where b.bukrs = :bukrs
            order by h.konkurs_id desc
           '
        )->setParameter('bukrs', $bukrs)
            ->setFirstResult(0)->setMaxResults($maxResults);;
        return $ret->getArrayResult();
    }
//// DQL///////////////////////////////////////////////////////////////////////DQL/////////////////////////////////////////////////////
//// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
    /**
     * @throws Exception
     */
    public  function getHeadSql1(): array
    {
        $conn = $this->getEntityManager()->getConnection();//Обьеденение 3 таблиц, с сортировкой,получение количества лотов
        $sql = 'SELECT h.konkurs_id, h.konkurs_nr,h.konkurs_name, t.bukrs, t.butxt, count( lot_id ) lotCountSQL FROM ztinmm_tk_h h
                inner join t001 t on h.bukrs_id_id = t.id
                left join zinmm_sof_lot_h lot on h.konkurs_id = lot.konkurs_id
                group by h.konkurs_id, h.konkurs_nr,h.konkurs_name, t.bukrs, t.butxt
                order by h.konkurs_id desc
        ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }
    /**
     * @throws Exception
     */
    public  function getHeadSql2($bukrs): array
    {
        if (isset($bukrs) && $bukrs == '')
        {
            $bukrs = null;
        }

        $conn = $this->getEntityManager()->getConnection();//Обьеденение 3 таблиц, вывод  записей по bukrs, с сортировкой,получение количества лотов
        $sql = 'SELECT h.konkurs_id, h.konkurs_nr,h.konkurs_name, t.bukrs, t.butxt, count( lot_id ) lotCountSQL 
                    FROM ztinmm_tk_h h
                    INNER JOIN t001 t on h.bukrs_id_id = t.id
                    LEFT JOIN zinmm_sof_lot_h lot on h.konkurs_id = lot.konkurs_id
                    WHERE  t.bukrs = :bukrs OR :bukrs is null
                GROUP BY h.konkurs_id, h.konkurs_nr,h.konkurs_name, t.bukrs, t.butxt
                ORDER BY h.konkurs_id DESC 
        ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['bukrs' => $bukrs]);
        return $resultSet->fetchAllAssociative();
    }
//// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
//// QueryBuilder///////////////////////////////////////////////////////////////////////QueryBuilder/////////////////////////////////////////////////////
    /**
    * @method ZtinmmTkH[]
    */
    public  function getHeadQb($bukrs):array
    {
        if (isset($bukrs) && $bukrs == '')
        {
            $bukrs = null;
        }

        $fff = $this->createQueryBuilder('h')
            ->select( 'h, lot, b' )
            ->leftJoin('h.zinmmSofLotHs','lot' )
            ->leftJoin('h.bukrsID','b' )
            ->Where('b.bukrs = :bukrs')
            ->orWhere(':bukrs is null')
            ->setParameter('bukrs', $bukrs)
            ->getQuery()

        ;
        //$fff->setMaxResults(2);

       // echo $fff->getDQL();
        return $fff->getArrayResult() ;
    }


}
