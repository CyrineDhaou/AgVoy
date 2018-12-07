<?php

namespace App\Controller;
use App\Entity\Circuit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProgrammationCircuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        
        $programmationcircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        
        $circuits = $em->getRepository(Circuit::class)->findAll();
        
        dump($programmationcircuits);
        $likes = $this->get('session')->get('likes');
        if ($likes == null){
            $likes = [];
        }
        
        
        return $this->render('front/home.html.twig', [
            'programmationcircuits' => $programmationcircuits, 
            'likes' => $likes,
            'circuits' => $circuits, 
        ]);
    }
    
        /**
         * @Route("/circuit/{id}", name="front_circuit_show")
         */
    public function circuitShow($id)       {
            
            $em = $this->getDoctrine()->getManager();           
            
            $programmationcircuit = $em->getRepository(ProgrammationCircuit::class)->find($id);
           
            
            dump($programmationcircuit);
            $likes = $this->get('session')->get('likes');
            if ($likes == null){
                $likes = [];}
            
            return $this->render('front/circuit_show.html.twig', [
                'programmationcircuit' => $programmationcircuit,
                'likes' => $likes,
            ]);
        }
        
        /**
         * @Route("/likes/{id}", name="likes")
         */
        
        public function likes($id) {
            $em = $this->getDoctrine()->getManager();
            $circuit = $em->getRepository(Circuit::class)->find($id);
            $likes = $this->get('session')->get('likes');
            if ($likes == null){
                $likes = [];
            }
          
            // si l'identifiant n'est pas présent dans le tableau des likes, l'ajouter
            if (! in_array($id, $likes) )
            {
                $likes[] = $id;
                $this->addFlash(
                    'notice',
                    'Ce circuit a été ajouté à votre panier!'
                    );
            }
            else
            // sinon, le retirer du tableau
            {
                $likes = array_diff($likes, array($id));
                $this->addFlash(
                    'notice',
                    'Ce circuit a été enlevé de votre panier!'
                    );
            }
            $this->get('session')->set('likes', $likes);
            return $this->redirectToRoute('frontoffice_home');
        }
        
        /**
         * @Route("/monpanier/", name="likes_show")
         */
        public function likesShow()       {
            
            $em = $this->getDoctrine()->getManager();
            $likes = $this->get('session')->get('likes');
            if ($likes==null) { $likes=[];}
        
            $circuits = [];
            foreach ($likes as $idlike => $like) {
            $circuit = $em->getRepository(Circuit::class)->find($like);
            array_push($circuits,$circuit);
           
            }
           
            return $this->render('likes_show.html.twig', [
                
                'likes' => $likes,
                'circuits' => $circuits,
            ]);
        } 
       
      
    }
