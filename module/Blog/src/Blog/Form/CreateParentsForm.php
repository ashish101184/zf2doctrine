<?php
namespace Blog\Form;
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChildParentsForm
 *
 * @author ASHISH
 */

 use Zend\Form\Form;
 use Zend\InputFilter\InputFilter;
 use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;

 use Zend\ServiceManager\ServiceManager;

 
class CreateParentsForm extends Form {
    public function __construct(ServiceManager $serviceManager)
     {
        parent::__construct('create-parent-form');
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        // The form will hydrate an object of type "BlogPost"
        //$this->setHydrator(new DoctrineHydrator($entityManager, 'Blog\Entity\ChildParent'));
        
        $this->setAttribute('method', 'post');


        // Add the user fieldset, and set it as the base fieldset
        $blogPostFieldset = new ParentsFieldset($serviceManager);
        $blogPostFieldset->setUseAsBaseFieldset(true);
        $this->add($blogPostFieldset);


//         $this->add(array(
//            'type' => 'Zend\Form\Element\Collection',
//            'name' => 'childparent',
//            'options' => array(
//                'label' => 'Parents',
//                'count' => 1,
//                'allow_add' => true,
//                'allow_remove' => true,
//                'should_create_template' => true,
//                'target_element' => new ParentsFieldset($serviceManager),
//            )
//        ));

         $this->add(array(
             'type' => 'submit',
             'name' => 'submit',
             'attributes' => array(
                 'value' => 'Save'
             )
         ));
     }
}
?>
