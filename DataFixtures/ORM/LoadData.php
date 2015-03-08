<?php
namespace Patrycja\WypozyczBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Patrycja\WypozyczBundle\Entity\Movies;
use Patrycja\WypozyczBundle\Entity\Orders;
use Patrycja\WypozyczBundle\Entity\Species;
use Patrycja\WypozyczBundle\Entity\AActors;

class LoadData implements FixtureInterface
{
 	public function load(ObjectManager $manager){
  		
  		$xml=simplexml_load_file('Data/Films.xml');
  			foreach ($xml->Movie as $f) {
  				$Movie = new Movies();
	  			$Movie->setTitle($f->title);
	  			$Movie->setDescription($f->description);
	  			$Movie->setPrice($f->price);
	  			$Movie->setPoster($f->poster);
	  			$manager->persist($Movie);
	  			$manager->flush();

  				foreach ($f->AActors->Actor as $a) {
  				$AActors=$manager
  				->getRepository('PatrycjaWypozyczBundle:AActors')
 				->findOneBy(array('name' => $a->name));
 					if (!$AActors) {
 						$Actor = new AActors();
 						$Actor->setName($a->name);
 						$Actor->setMovieId($Movie->getId());
 						$manager->persist($Actor);
 				};
 				$Movie->addActor($Actor);
 				
 				$manager->flush();
 			}

 			foreach ($f->Species->Specy as $s){
 					$Species=$manager
 					->getRepository('PatrycjaWypozyczBundle:Species')
 					->findOneBy(array('spec' => $s->spec));
 					if (!$Species){
 						$specy= new Species();
 						$specy->setSpec($s->spec);
 						$specy->setMovieId($Movie->getId());
 						$manager->persist($specy);
 				};
 				$Movie->addSpecy($specy);
 				$manager->flush();
 			}


 				foreach ($f->Orders->order as $o){
 				$Orders=$manager
 				->getRepository('PatrycjaWypozyczBundle:Orders')
 				->findOneBy(array('term' => $o->term, 'form' => $o->form, 'conditions' => $o->conditions));
 				if (!$Orders){
 						$order= new Orders();
 						$order->setTerm($o->term);
 						$order->setForm($o->form);
 				 		$order->setConditions($o->conditions);
 					$manager->persist($order);
 				};
 				$Movie->addOrder($order);
 				$order->setMovieId($Movie->getId());
 				$manager->flush();

	    //     $Movie->setReview();
	  		// $manager->persist($Movie);
	    //     $manager->flush();






}





	        //   $Review=$manager
	        //   ->getRepository("PatrycjaWypozyczBundle:Review")
	        //   ->findOneBySubject($f->review);

	        // if(!$Review){
	        //   $Review = new Review();
	        //   $Review -> setSubject($f->review);
	        //   $Review -> setBody($f->review);
	        //   $manager->persist($Review);
	        //   $manager->flush();

	        // };


 				

      
      
 			$manager->flush();	
  			
  		}
}}
