<?php

namespace App\Servise;

use App\Entity\BookCategory;
use App\Entity\ZtinmmTkH;
use Doctrine\ORM\EntityManagerInterface;



class KonkursServise
{

    public function __construct(
//        private readonly ZtinmmTkHRepository $tkhRepository
    )
    {
    }


    public function getHeadList(entityManagerInterface $manager): array
    {
        $itemList = $manager->getRepository(ZtinmmTkH::class)->getHeadDql(2);

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