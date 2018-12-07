<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Etape;
use App\Form\EtapeType;
use App\Repository\EtapeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;

/**
 * @Route("/admin/etape")
 */
class BackofficeEtapeController extends AbstractController
{
   
    /**
     * @Route("/", name="admin_etape_index", methods="GET")
     */
    
    public function index(EtapeRepository $etapeRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('back/etape/index.html.twig', ['etapes' => $etapeRepository->findAll()]);
        
    }

    /**
     * @Route("/new", name="admin_etape_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $etape = new Etape();
        $form = $this->createForm(EtapeType::class, $etape);
     /*   $formBuilder = $this->createFormBuilder()
        ->add('numeroEtape', IntegerType::class)
        ->add('villeEtape')
        ->add('nombreJours', IntegerType::class)
        ->add('circuit');
        
        $form=$formBuilder->getForm();*/
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etape);
            $em->flush();

            return $this->redirectToRoute('admin_etape_index');
        }

        return $this->render('back/etape/new.html.twig', [
            'etape' => $etape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_etape_show", methods="GET")
     */
    public function show(Etape $etape): Response
    {    $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('back/etape/show.html.twig', ['etape' => $etape]);
    }

    /**
     * @Route("/{id}/edit", name="admin_etape_edit", methods="GET|POST")
     */
    public function edit(Request $request, Etape $etape): Response
    {          
    
        $n=$etape->getNombreJours();
         $circuit = $etape->getCircuit();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);
         
        if ($form->isSubmitted() && $form->isValid()) {
           
            $circuit->setDureeCircuit($circuit->getDureeCircuit()+$etape->getNombreJours()-$n);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_etape_edit', ['id' => $etape->getId()]);
        }

        return $this->render('back/etape/edit.html.twig', [
            'etape' => $etape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_etape_delete", methods="DELETE")
     */
    public function delete(Request $request, Etape $etape): Response
    {       $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$etape->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etape);
            $em->flush();
        }

        return $this->redirectToRoute('admin_etape_index');
    }
}
