<?php

namespace App\Controllers;

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

    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->Passage = new PassagesRepository();
    }
    public function classementPage()
    {
        try {
            echo $this -> twig -> render('ClassementView.html.twig');
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
        var_dump($data2);

        $result2 = $serializer->deserialize($data2, 'App\Entites\Passage[]', 'csv');

        var_dump($result2);

        foreach ($result2 as $reslut) {
            $this->Passage->addListePassage($reslut);
            var_dump($reslut);
        }



        return $result2;
    }
}
