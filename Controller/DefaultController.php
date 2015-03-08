<?php

namespace Patrycja\WypozyczBundle\Controller;

use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Patrycja\WypozyczBundle\Entity\Orders;
use Patrycja\WypozyczBundle\Entity\Movies;
use Patrycja\WypozyczBundle\Entity\Review;
use Patrycja\WypozyczBundle\Form\ReviewType;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\ResultSetMapping;
use Patrycja\WypozyczBundle\Form\OrdersType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PatrycjaWypozyczBundle:Default:index.html.twig');
    }

    public function mainAction()
    {
        $movie = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Movies')->findBy(array(), array('id' => 'asc'));
            //pobierasz wszystkich aktorow
        $actor = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:AActors')->findAll();
        $review = $this->getDoctrine()->getEntityManager()
            ->getRepository('PatrycjaWypozyczBundle:Review')->findAll();
        $Specy = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Species')->findAll();


        $em= $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                "SELECT f, COUNT(r.Movie_id) as c
                FROM PatrycjaWypozyczBundle:Review r
                INNER Join PatrycjaWypozyczBundle:Movies f WITH r.Movie_id=f.id
                Group by r.Movie_id
                Order by c desc
                ");
        $opinion = $query->getArrayResult();

        $query = $em->createQuery(
                "SELECT s.spec
                FROM PatrycjaWypozyczBundle:Species s
                INNER Join PatrycjaWypozyczBundle:Movies f WITH s.Movie_id=f.id
                Group by s.spec
                
                ");


        $kind = $query->getArrayResult();

        $query = $em->createQuery(
                "SELECT s.spec, f.title, f.id, f.poster
                FROM PatrycjaWypozyczBundle:Species s
                INNER Join PatrycjaWypozyczBundle:Movies f WITH s.Movie_id=f.id
                
                
                ");
        $variety = $query->getArrayResult();

        $em= $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                "SELECT f, COUNT(o.Movie_id) as c
                FROM PatrycjaWypozyczBundle:Orders o
                INNER Join PatrycjaWypozyczBundle:Movies f WITH o.Movie_id=f.id
                Group by o.Movie_id
                Order by c desc
                ");
        $lend = $query->getArrayResult();
        


        return $this->render('PatrycjaWypozyczBundle:Default:main.html.twig', array(
        'movie' => $movie,
        'reviews' => $review,
        'aactors' => $actor,
        'species' => $Specy,
        'opinion' => $opinion,
        'kind' => $kind,
        'variety' => $variety,
        'lend' => $lend

));
    }

    public function OrdersAction(Request $request)
    {
	
    	$id = $this->getUser()->getId();
    	$email = $this->getUser()->getEmail();
        
         echo $id, $email;
        $orders = new Orders();
        
        $form = $this ->createForm(new OrdersType(), $orders);
        if ($request->isMethod('POST')
            && $form->handleRequest($request)
            && $form->isValid()
            )   {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orders);
            $em->flush();
            $mailer = $this->get('mailer');
            
            $message = \Swift_Message::newInstance()
                ->setSubject('You have Completed Order!')
                ->setFrom('patka118@poczta.onet.pl')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                    
                        'confirm.html.twig',
                        array('orders' => $orders
                              
                            )
                    ),
                    'text/html'
                );
           
            $mailer->send($message);
            return $this->redirect($this->generateUrl('patrycja_wypozycz_homepage'));
        }

            return $this->render('PatrycjaWypozyczBundle:Default:orders.html.twig', array('form'=>$form->createView()));
            $form->handleRequest($request);

    }


    public function OrdersBuyAction(Request $request)
    {

    $id = $this->getUser()->getId();
    $email = $this->getUser()->getEmail();
       
        
        $users = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:User')->findOneByid($id);
        $orders = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Orders')->findByidCustomer($users->getId());
        $movies = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Movies')->findAll();
       
        $em= $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                "SELECT u, o, f
                FROM PatrycjaWypozyczBundle:User u
                INNER Join PatrycjaWypozyczBundle:Orders o WITH o.idCustomer=u.id
                INNER Join PatrycjaWypozyczBundle:Movies f WITH o.Movie_id=f.id
                Where o.idCustomer=$id and o.status='Zapłacone'
                
                ");
        $relations = $query->getArrayResult();
        
        

        return $this->render('PatrycjaWypozyczBundle:Default:ordersbuy.html.twig', array(
        'movies' => $movies,
        'users' => $users,
        'orders' => $orders,
        'relations' => $relations
));
    }

    public function OrdersListAction(Request $request)
    {
        $email = $this->getUser()->getEmail();
        $id = $this->getUser()->getId();

        
        $users = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:User')->findOneByid($id);
        $orders = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Orders')->findByidCustomer($users->getId());
        $movies = $this->getDoctrine()
            ->getRepository('PatrycjaWypozyczBundle:Movies')->findAll();
       
        $em= $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                "SELECT u, o, f
                FROM PatrycjaWypozyczBundle:User u
                INNER Join PatrycjaWypozyczBundle:Orders o WITH o.idCustomer=u.id
                INNER Join PatrycjaWypozyczBundle:Movies f WITH o.Movie_id=f.id
                Where o.idCustomer=$id
                
                ");
        $relations = $query->getArrayResult();
                

        return $this->render('PatrycjaWypozyczBundle:Default:orderslist.html.twig', array(
        'movies' => $movies,
        'users' => $users,
        'orders' => $orders,
        'relations' => $relations
));
    }





public function ReviewAction(Request $request)
    {
        
        $review = new Review();
        
        $form = $this ->createForm(new ReviewType(), $review);
        if ($request->isMethod('POST')
            && $form->handleRequest($request)
            && $form->isValid()
            )   {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            
            return $this->redirect($this->generateUrl('patrycja_wypozycz_homepage'));
           
        }

            return $this->render('PatrycjaWypozyczBundle:Default:review.html.twig', array('form'=>$form->createView()));


            $form->handleRequest($request);

    }

}
