<?php

namespace App\Controllers;

use App\Entites\Epreuve;
use App\Models\EpreuvesRepository;
use App\Models\PassagesRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class EpreuvesController extends AbstractController
{
    private EpreuvesRepository $Epreuves;
    /**
     * @var PassagesRepository
     */
    private PassagesRepository $Passage;

    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->Epreuves = new EpreuvesRepository();
        $this->Passage = new PassagesRepository();
    }

    public function showEpreuve(): void
    {
        $epreuve = $this->Epreuves->findAll();
        var_dump($epreuve);

        try {
            echo $this -> twig -> render('EpreuveView.html.twig', ['Listeepreuves' => $epreuve]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function EpreuveAdd()
    {
        $request = Request::createFromGlobals();
        $newepreuve = new Epreuve();
        $newepreuve->setLieu($request->get('lieu'));
        $newepreuve->setDate($request->get('date'));
        $checkepreuve = $this->Epreuves->findbyName($newepreuve->setLieu($request->get('lieu')));
        if (empty($checkepreuve)) {
            $this->Epreuves->add($newepreuve);
        }
        $response = new RedirectResponse('http://localhost/www/ChampionnatDeSki/epreuve');
        $response->send();
    }

    public function listParticipantEpreuve(Request $request)
    {
        $params = explode('/', $request->getPathInfo());
        var_dump($params);
        $listbyEpreuve = $this->Epreuves->findparticipantbyEpreuve($params[2]);
        var_dump($listbyEpreuve);
        try {
            echo $this -> twig -> render(
                'ListParticipantbyEpreuveView.html.twig',
                ['Listeepreuves' => $listbyEpreuve]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function exportCustomersDataCsvAction(Request $request)
    {
        $params = explode('/', $request->getPathInfo());
        $list = $this->Epreuves->findparticipantByEpreuveForCSV($params[3]);
        $fp = fopen('php://output', 'w', "w");
        fputcsv($fp, array('participant_id,nom,prenom,categorie,temps_passage1,temps_passage2'), ';');
        foreach ($list as $line) {
            fputcsv(
                $fp, // The file pointer
                (array)$line // The fields
                // The delimiter
            );
        }
        fclose($fp);
        $response = new Response();
        $response->headers->set('Content-type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="ok.csv";');
        $response->sendHeaders();
        $response->getContent();

        return $response;
    }
}
