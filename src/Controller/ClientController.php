<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\Client;

class ClientController extends Controller
{
    /**
     * @Route("/client", name="client")
     * METHOD({"POST"})
     */
    public function saveClient()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $client = new Client();
        $client->setName('Client2');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($client);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new client with id '.$client->getId());
        //return true;
    }
    
    /**
    * @Route("/client/{id}", name="getClient")
    * METHOD({"GET"})
    */
   public function getClient($id)
   {
       $client = $this->getDoctrine()
           ->getRepository(Client::class)
           ->find($id);

       if (!$client) {
           throw $this->createNotFoundException(
               'No client found for id '.$id
           );
       }

       return $this->render('index.html.twig', array(
            'client' => $client->getName(),
        ));
   }
   
   /**
    * @Route("/client/", name="getAllClient")
    * METHOD({"GET"})
    */
   public function getAllClient()
   {
       $client = $this->getDoctrine()
           ->getRepository(Client::class)
           ->findAll();

       if (!$client) {
           throw $this->createNotFoundException(
               'No client found for id '.$id
           );
       }
       
       return $this->render('index.html.twig', array(
            'client' => $client,
        ));
   }
}
