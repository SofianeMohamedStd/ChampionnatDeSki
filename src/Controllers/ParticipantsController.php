<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use App\Entites\Participant;
use Twig\Error\RuntimeError;
use App\Models\EpreuvesRepository;
use App\Models\PassagesRepository;
use App\Models\ProfilesRepository;
use App\Models\CategoriesRepository;
use App\Models\ParticipantsRepository;
use Symfony\Component\HttpFoundation\Request;

class ParticipantsController extends AbstractController
{
    private ParticipantsRepository $participant;
    private CategoriesRepository $categorie;
    private ProfilesRepository $profil;
    private EpreuvesRepository $epreuve;
    private PassagesRepository $passage;

    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->participant = new ParticipantsRepository();
        $this->categorie = new CategoriesRepository();
        $this->profil = new ProfilesRepository();
        $this->epreuve = new EpreuvesRepository();
    }
    public function participantPage()
    {
        try {
            $response = new Response($this -> twig -> render('ParticipantView.html.twig'));
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function participantAddPage(): void
    {
        $categories = $this->categorie->findAll();
        $profils = $this->profil->findAll();
        $epreuve = $this->epreuve->findAll();
        try {
            $response = new Response($this -> twig -> render(
                'ParticipantAddView.html.twig',
                ['ListeCategories' => $categories,'ListeProfils' => $profils,
                'ListeEpreuves' => $epreuve]
            ));
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function participantAdd()
    {
        $request = Request::createFromGlobals();
        $newparticipant = new Participant();
        $newparticipant->setNom($request->get('nom'));
        $newparticipant->setPrenom($request->get('prenom'));
        $newparticipant->setDate($request->get('datenaissance'));
        $newparticipant->setEmail($request->get('email'));
        $newparticipant->setCategorieID($request->get('categorie'));
        $newparticipant->setProfilID($request->get('profil'));
        $newparticipant->setPhoto($request->get('photo'));
        $newparticipant->setEpreuveID($request->get('epreuve'));

        $this->participant->addParticipant($newparticipant);
    }

    public function showParticipant()
    {
        $participant = $this -> participant -> getAllParticipants();
        try {
            $response = new Response($this -> twig -> render(
                'ParticipantShowView.html.twig',
                ['Listeparticipants' => $participant]
            ));
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function deserializeFromCsv2(Request $request)
    {

        $data = $request->files->get('file');
        $encoders = [new CsvEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data2 =  file_get_contents($data);


        $result2 = $serializer->deserialize($data2, 'App\Entites\Participant[]', 'csv');

        foreach ($result2 as $result) {
            $this->participant->addParticipant($result);
        }
    }
}
