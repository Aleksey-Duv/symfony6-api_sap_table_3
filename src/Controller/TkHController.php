<?php

namespace App\Controller;

//use App\Entity\User;
use App\Entity\ZinmmSofLotH;
use App\Entity\ZtinmmTkH;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TkHController extends AbstractController
{
//    private $request;
    private $manager;

    public function __construct(entityManagerInterface $manager)
    {
        $this->manager = $manager;
//        $this->request = $request;
    }




















    #[Route('/tkh', name: 'app_tk_h')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller! test serv',
            'path' => 'src/Controller/TkHController.php',
        ]);
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
