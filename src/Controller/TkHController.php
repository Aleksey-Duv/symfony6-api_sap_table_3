<?php

namespace App\Controller;

use App\Entity\ZinmmSofLotH;
use App\Entity\ZtinmmTkH;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class TkHController extends AbstractController
{
//    private $request;
    private EntityManagerInterface $manager;

    public function __construct(entityManagerInterface $manager)
    {
        $this->manager = $manager;
//        $this->request = $request;
    }


    #[Route('/tkh_findAll', name: 'app_findAll')]
    public function index_findAll(SerializerInterface $serializer): JsonResponse
    {


        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->find(2);

       $fg = $serializer->serialize($item_tkh,'json', ['groups' => ['gr1']]);

        return  JsonResponse::fromJsonString($fg)  ;
    }

//// DQL///////////////////////////////////////////////////////////////////////DQL/////////////////////////////////////////////////////
    #[Route('/tkh_dql1', name: 'app_dql1_h')]
    public function index_dql1(): JsonResponse
    {
        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql('1240');

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $productLis = $serializer->deserialize($item_tkh,'json',ZtinmmTkH::class);

        return new JsonResponse($item_tkh)  ;
    }
    #[Route('/tkh_dql2', name: 'app_dql2_h')]
    public function index_dql2(): JsonResponse
    {
        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql_all();

        return new JsonResponse($item_tkh)  ;
    }
    #[Route('/tkh_dql3', name: 'app_dql3_h')]
    public function index_dql3(): JsonResponse
    {
        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql1(1241);
     //   return $this->jsonEncode($item_tkh)  ;
        return new JsonResponse($item_tkh)  ;
    }
    //// DQL///////////////////////////////////////////////////////////////////////DQL/////////////////////////////////////////////////////
    //// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
    #[Route('/tkh_sql1', name: 'app_sql1_h1')]
    public function index_sql1(): JsonResponse
    {
        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadSql1();
        return new JsonResponse($itemList)  ;
    }
    #[Route('/tkh_sql2', name: 'app_sql2_h1')]
    public function index_sql2(): JsonResponse
    {
        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadSql2(1241);
        return new JsonResponse($itemList)  ;
    }
    //// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
    #[Route('/tkh2', name: 'app_tk_h2')]
    public function index2( ): JsonResponse //SerializerInterface $serializer
    {
        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadQb();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $productListJSON = $serializer->serialize($itemList, 'json');
        dd($productListJSON);

     //   return $this->json($productListJSON);



//dd($rtt);
        return new JsonResponse($itemList)  ;
      //  $rrr = $serializer->serialize($itemList,'json');
       // $rrr = $serializer->
       // return  $this->json(  $itemList );;
    }


    #[Route('/get_list_lot', name: 'get_lot', methods: 'GET')]
    public  function getlistlot(): JsonResponse
    {

//$ddee = $this->manager->getRepository(ZtinmmTkH::class)->createQueryBuilder('h')->select('h', 'h.BukrsID');
        $ddee = $this->manager->getRepository(ZtinmmTkH::class)->getHeadSql();

dump($ddee);//
//

        return $this->json(  $ddee        );
    }



    #[Route('/set_tk_h', name: 'set_tkh', methods: 'POST')]
    public function set_tk_h(Request $request): JsonResponse
    {
//        for Postman body JSON
//        {
//            "konkurs_nr": "100004",
//            "konkurs_name": "Конкурс №4"
//        }
//        dd($request);
        $data = json_decode($request->getContent(), true);
        $konkurs_nr = $data['konkurs_nr'];
        $konkurs_name = $data['konkurs_name'];

        $ztinmmtkh = new ZtinmmTkH();
        $ztinmmtkh->setKonkursNr($konkurs_nr)
            ->setKonkursName($konkurs_name);
        $this->manager->persist($ztinmmtkh);
        $this->manager->flush();

        return new JsonResponse
        (
            [
                'statys' => true,
                'message' => 'user added'
            ]
        );


    }
    #[Route('/set_sof_lot_h', name: 'set_sof_lot_h ', methods: 'POST')]
    public function set_sof_lot_h(Request $request): JsonResponse
    {
//        for Postman body JSON
//        {
//            "lot_nr": "Реестровыйномер лота 4",
//            "lot_name": "Труба d11 сорт3",
//            "konkurs_id": 2
//         }
//        dd($request);
        $data = json_decode($request->getContent(), true);
        $lot_nr = $data['lot_nr'];
        $lot_name = $data['lot_name'];
        $konkurs_id = $data['konkurs_id'];

     //   $sof_lot_h = new ZtinmmTkH();
        $lo_konkurs_id  = $this->manager->getRepository(ZtinmmTkH::class)->findOneBy(['konkurs_id' => $konkurs_id]);

        $sof_lot_h = new ZinmmSofLotH();
        $sof_lot_h->setKonkursIdd($lo_konkurs_id)
            ->setLotName($lot_name)
            ->setLotNr($lot_nr);
        $this->manager->persist($sof_lot_h);
        $this->manager->flush();

        return new JsonResponse
        (
            [
                'statys' => true,
                'message' => 'user added'
            ]
        );


    }





}
