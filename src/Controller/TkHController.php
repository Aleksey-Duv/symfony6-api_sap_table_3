<?php

namespace App\Controller;

use App\Entity\ZinmmSofLotH;
use App\Entity\ZtinmmTkH;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
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
    #[Route('/tkh_dql1', name: 'app_dql1_h', methods: 'GET')]
    public function index_dql1(Request $request): JsonResponse
    {
//        for Postman body JSON
//        {
//            "bukrs": "1241",
//           "maxResults": "4"
//       }
        $data = json_decode($request->getContent(), true);
        $bukrs = $data['bukrs'];
        $maxResults = $data['maxResults'];

        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql($bukrs, $maxResults);

        return new JsonResponse($item_tkh)  ;
    }
    #[Route('/tkh_dql2', name: 'app_dql2_h', methods: 'GET')]
    public function index_dql2(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $maxResults = $data['maxResults'];

        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql_all($maxResults);


        return new JsonResponse($item_tkh)  ;
    }
    #[Route('/tkh_dql3', name: 'app_dql3_h', methods: 'GET')]
    public function index_dql3(Request $request): JsonResponse
    {
//        {
//            "bukrs": "1241",
//           "maxResults": "4"
//       }
        $data = json_decode($request->getContent(), true);
        $bukrs = $data['bukrs'];
        $maxResults = $data['maxResults'];

        $item_tkh = $this->manager->getRepository(ZtinmmTkH::class)->getHeadDql1($bukrs,$maxResults);
     //   return $this->jsonEncode($item_tkh)  ;
        return new JsonResponse($item_tkh)  ;
    }
    //// DQL///////////////////////////////////////////////////////////////////////DQL/////////////////////////////////////////////////////
    //// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
    #[Route('/tkh_sql1', name: 'app_sql1_h1', methods: 'GET')]
    public function index_sql1(Request $request): JsonResponse
    {
        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadSql1();
        return new JsonResponse($itemList)  ;
    }
    #[Route('/tkh_sql2', name: 'app_sql2_h1', methods: 'GET')]
    public function index_sql2(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $bukrs = $data['bukrs'];

        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadSql2($bukrs);
        return new JsonResponse($itemList)  ;
    }
    //// SQL///////////////////////////////////////////////////////////////////////SQL/////////////////////////////////////////////////////
    //// QueryBuilder///////////////////////////////////////////////////////////QueryBuilder/////////////////////////////////////////////////////
    #[Route('/tkh2', name: 'app_tk_h2', methods: 'GET')]
    public function index2(SerializerInterface $serializer ,Request $request): JsonResponse //SerializerInterface $serializer
    {
        $data = json_decode($request->getContent(), true);

        $bukrs =  $data['bukrs'];
       // $maxResults = $data['maxResults'];

        $itemList = $this->manager->getRepository(ZtinmmTkH::class)->getHeadQb($bukrs);

//        $context = (new ObjectNormalizerContextBuilder())
//            ->withGroups('gr1')
//            ->toArray();
//
//        $fg = $serializer->serialize($itemList,'json', $context);
//
//        return  JsonResponse::fromJsonString($fg)  ;
        return new JsonResponse($itemList);
    }
    //// QueryBuilder///////////////////////////////////////////////////////////QueryBuilder/////////////////////////////////////////////////////
    ///
    #[Route('/set_tkh_upd', name: 'set_tkh_upd', methods: 'POST')]
    public function set_tkh_upd(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = $data['konkurs_id'];
        $konkurs_name = $data['konkurs_name'];

        $Proc = $this->manager->getRepository(ZtinmmTkH::class)->find($id);

        $Proc->setKonkursName($konkurs_name);

        $this->manager->persist($Proc);
        $this->manager->flush();

        return new JsonResponse
        (
            [
                'statys' => true,
                'message' => 'Update'
            ]
        );


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
