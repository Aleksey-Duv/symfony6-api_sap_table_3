<?php

namespace App\Servise;

use App\Entity\BookCategory;
use App\Entity\ZtinmmTkH;
use App\Model\BookCategory as BookCategoryModel;
use App\Model\KonkursItem;
use App\Model\KonkursModel;
use App\Repository\ZtinmmTkHRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;


class KonkursServise
{

    public function __construct(
//        private readonly ZtinmmTkHRepository $tkhRepository
    )
    {
    }


    public function getHeadList1(entityManagerInterface $manager): array
    {
        $itemList = $manager->getRepository(ZtinmmTkH::class)->getHeadDql();


//        $items = array_map(
//            fn (ZtinmmTkH $tkh) => new KonkursItem(
//                $tkh->getKonkursId(), $tkh->getKonkursNr(), $tkh->getKonkursName()
//            ),
//            $itemList
//        );
        return $itemList;
    }

//    public function getHeadList(): KonkursModel
//    {
//        $listItems = $this->tkhRepository->getHeadSql();
//$ff = $this->
//
////        $items = array_map(
////            fn (ZtinmmTkH $tkh) => new KonkursItem(
////                $tkh->getKonkursId(), $tkh->getKonkursNr(), $tkh->getKonkursName()
////            ),
////            $listItems
////        );
//        foreach ($listItems as $item)
//        {
//            new KonkursItem(   );
//        }
//
//        return new KonkursModel($items);
//
//    }


}