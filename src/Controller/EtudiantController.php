<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        // Appel au model
        // Contrôleur va demander au model la liste des étudiants
        $etudiants = $etudiantRepository->findAll();
        // Appel au vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }

    #[Route('/etudiant/mineurs', name: 'app_etudiant_mineurs_list', requirements: ['id' => '\d+'])]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {
        $etudiants = $etudiantRepository->findMineurs2();
        dd($etudiants);

        // Appel au vue
        return $this->render('etudiant/detail.html.twig', [
            'etudiant' => $etudiant
        ]);
    }


    #[Route('/etudiant/{id}', name: 'app_etudiant_list_detail')]
    public function detail(EtudiantRepository $etudiantRepository, int $id): Response
    {

        $etudiant = $etudiantRepository->find($id);
        // Appel au vue
        return $this->render('etudiant/detail.html.twig', [
            'etudiant' => $etudiant
        ]);
    }
}
