<?php

namespace App\Controllers;

use App\Entites\Passage;
use App\Models\CategoriesRepository;
use App\Models\PassagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ClassementController extends AbstractController
{
    /**
     * @var PassagesRepository
     */
    private PassagesRepository $Passage;
    /**
     * @var Passage
     */
    private Passage $passages;
    /**
     * @var CategoriesRepository
     */
    private CategoriesRepository $categorie;

    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->Passage = new PassagesRepository();
        $this->passages = new Passage();
        $this->categorie = new CategoriesRepository();
    }
    public function classementPage()
    {
        $categories = $this->categorie->findAll();


        try {
            echo $this -> twig -> render('ClassementView.html.twig', ['ListeCategories' => $categories]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function deserializeFromCsv(Request $request)
    {

        $data = $request->files->get('file');
           $encoders = [new CsvEncoder(), new JsonEncoder()];
           $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
           $serializer = new Serializer($normalizers, $encoders);

           $data2 =  file_get_contents($data);


        $ObjectResult = $serializer->deserialize($data2, 'App\Entites\Passage[]', 'csv');



        foreach ($ObjectResult as $reslut) {
            $this->Passage->addListePassage($reslut);
        }
        $Allpassage = $this->Passage->findAll();
         //var_dump($re);

        foreach ($Allpassage as $passage => $value) {
            $time1 = explode(":", $value[1]);

            $minute1 = $time1[0] * 60;
            $milliseconde1 = $time1[2] / 1000;
            $passage1 = $minute1 + $time1[1] + $milliseconde1;


            $time2 = explode(":", $value[2]);
            $minute2 = $time2[0] * 60;
            $milliseconde2 = $time2[2] / 1000;
            $passage2 = $minute2 + $time2[1] + $milliseconde2;

            $moyenne = $passage1 + $passage2;

            $this->Passage->update($moyenne, $value[0]);
        }
    }
    public function classementGeneral()
    {

        $ClassementPremier = $this->Passage->firstorderGeneral();
        $ClassementGeneral = $this->Passage->orderGeneral();
        try {
            echo $this -> twig -> render('ClassementGeneralView.html.twig', ['ListPremiers' => $ClassementPremier,
                'ListGeneral' => $ClassementGeneral]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function classementByCategorie()
    {
        $request = Request::createFromGlobals();
        $IdCategorie = $request->get('categorie');

        $ClassementPremierCategorie = $this->Passage->firstorderByCategorie($IdCategorie);
        $ClassementCategorie = $this->Passage->orderByCategorie($IdCategorie);
        try {
            echo $this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementPremierCategorie,'ListGeneral' => $ClassementCategorie]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function classementByAge()
    {
        $request = Request::createFromGlobals();
        $IdCategorie = $request->get('age');
        if ($IdCategorie == 1) {
            $ClassementParAge = $this->Passage->ordreByAgeFirstInterval();

                echo $this -> twig -> render(
                    'ClassementByCategorieView.html.twig',
                    ['ListPremiers' => $ClassementParAge]
                );
        } elseif ($IdCategorie == 2) {
            $ClassementParAge = $this->Passage->ordreByAgeSecondeInterval();


            echo $this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementParAge]
            );
        }
    }
}
