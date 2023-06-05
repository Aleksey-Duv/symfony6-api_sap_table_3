<?php

namespace App\Repository;

use App\Entity\ZtinmmTkH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
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

}
