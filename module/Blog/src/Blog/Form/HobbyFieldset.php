<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChildrenFieldset
 *
 * @author ASHISH
 */
namespace Blog\Form;

use Blog\Entity\Hobby;

use Doctrine\ORM\EntityManager;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
 
 use Zend\ServiceManager\ServiceManager;

class HobbyFieldset extends Fieldset implements InputFilterProviderInterface {
   public function __construct(ServiceManager $serviceManager)
   {
        parent::__construct('hobby');

        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

       $this->setHydrator(new DoctrineHydrator($entityManager, 'Blog\Entity\Hobby'))
             ->setObject(new Hobby());
       

      $this->add(array(
         'type' => 'text',
         'name' => 'name',
         'options' => array(
           'label' => 'Hobby'
         )
      ));
   }


    /**
      * @return array
      */
     public function getInputFilterSpecification()
     {
         return array(
             'name' => array(
                 'required' => true,
             ),
         );
     }
}
?>
