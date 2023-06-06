<?php

namespace App\Servise;

use App\Model\KonkursModel;
use App\Repository\ZtinmmTkHRepository;
use Doctrine\ORM\NonUniqueResultException;


class KonkursServise
{

    public function __construct(
      private  readonly ZtinmmTkHRepository $tkhRepository
    )
    {
    }



    public  function getHeadList(): string //KonkursModel
    {
$listItems = $this->tkhRepository->getHeadSql();

//        $data = [];
//
//        foreach ($listItems as $item) {
//            $data[] = [
//                'id' => $item->getId(),
//                'email' => $item->getEmail(),
//                'roles' => $item->getRoles(),
//                'password' => $item->getPassword(),
//            ];
//        }

        return '';

    }


}