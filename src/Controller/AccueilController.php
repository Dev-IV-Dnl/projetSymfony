<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Repository\ProduitRepository;
use App\Entity\Produit;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/', name: 'home')]
    public function home(ProduitRepository $repo): Response
    {
        $listeProduits = $repo->findAll();

        return $this->render('accueil/home.html.twig', [
            "listeProduits" => $listeProduits
        ]);
    }

    #[Route('/accueil/new', name: 'accueil_create')]
    public function create(Request $request) {
        $produit = new Produit();

        $form = $this
                    ->createFormBuilder($produit)
                    ->add("nomProduit", TextType::class, [
                        "attr" => [
                            "placeholder" => "Nom du produit"
                        ]
                    ])
                    ->add("descriptionProduit", TextareaTYpe::class, [
                        "attr" => [
                            "placeholder" => "Description du produit"
                        ]
                    ])
                    ->add("imageProduit", TextType::class, [
                        "attr" => [
                            "placeholder" => "Image du produit"
                        ]
                    ])
                    ->getForm();

        return $this->render("accueil/create.html.twig", [
            "formProduit" => $form->createView()
        ]);
    }

    #[Route('/accueil/{id}', name: 'accueil_show')]
    public function show(Produit $detailProduit): Response
    {
        return $this->render('accueil/show.html.twig', [
            "detailProduit" => $detailProduit
        ]);
    }

}