<?php

namespace App\Controllers;

use App\Entites\Passage;
use App\Models\CategoriesRepository;
use App\Models\PassagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            $response = new Response($this -> twig -> render(
                'ClassementView.html.twig',
                ['ListeCategories' => $categories]
            ));
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function deserializeFromCsv(Request $request)
    {

        $data = $request->files->get('file');
        var_dump($data);
           $encoders = [new CsvEncoder(), new JsonEncoder()];
           $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
           $serializer = new Serializer($normalizers, $encoders);

           $data2 =  file_get_contents($data);
        var_dump($data2);

        $ObjectResult = $serializer->deserialize($data2, 'App\Entites\Passage[]', 'csv');

        var_dump($ObjectResult);
        $this->Passage->delete ();
        foreach ($ObjectResult as $reslut) {
            $this->Passage->addListePassage($reslut);
        }
        $Allpassage = $this->Passage->findAll();


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
        try {
            echo $this -> twig -> render('ClassementGeneralView.html.twig', ['ListPremiers' => $ClassementPremier]);
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
        try {
            $response = new Response($this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementPremierCategorie]
            ));
            $response->send();
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

            $response = new Response($this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementParAge]
            ));
            $response->send();
        } elseif ($IdCategorie == 2) {
            $ClassementParAge = $this->Passage->ordreByAgeSecondeInterval();


            $response = new Response($this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementParAge]
            ));
            $response->send();
        } elseif ($IdCategorie == 3) {
            $ClassementParAge = $this->Passage->ordreByThirdInterval();


            $response = new Response($this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementParAge]
            ));
            $response->send();
        } elseif ($IdCategorie == 4) {
            $ClassementParAge = $this->Passage->ordreByFourthInterval();


            $response = new Response($this -> twig -> render(
                'ClassementByCategorieView.html.twig',
                ['ListPremiers' => $ClassementParAge]
            ));
            $response->send();
        }
    }
}
