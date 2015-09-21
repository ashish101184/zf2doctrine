<?php
namespace Blog\Form;
// Filename: /module/Blog/src/Blog/Form/ParentFieldset.php

use Blog\Entity\ChildParent;
use Zend\Form\Fieldset;
 use Zend\InputFilter\InputFilterProviderInterface;
 use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
 use Zend\ServiceManager\ServiceManager;

class ParentsFieldset extends Fieldset implements InputFilterProviderInterface
{
   public function __construct(ServiceManager $serviceManager)
   {
       parent::__construct('childparent');

       $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $this->setHydrator(new DoctrineHydrator($entityManager, 'Blog\Entity\ChildParent'))
             ->setObject(new ChildParent());

      $this->add(array(
         'type' => 'hidden',
         'name' => 'id'
      ));


      $this->add(array(
         'type' => 'text',
         'name' => 'name',
         'options' => array(
           'label' => 'Parent Name'
         )
      ));
      
      $this->add(array(
             'type' => 'Zend\Form\Element\Collection',
             'name' => 'children',
             'options' => array(
                 'should_create_template' => true,
                 'object_manager' => $serviceManager,
                 'allow_add' => true,
                 'target_element' => new ChildrenFieldset($serviceManager) ,
             ),
             'attribute' => array('class' => 'childrenSet')
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
