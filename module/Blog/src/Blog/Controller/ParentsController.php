<?php

namespace Blog\Controller;

use Application\Controller\EntityUsingController;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use Zend\View\Model\ViewModel;

use Blog\Form\CreateParentsForm;
use Blog\Entity\ChildParent;
use Blog\Entity\Children;
//use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ParentsController extends EntityUsingController
{

    public function indexAction()
    {
        $em = $this->getEntityManager();

        $posts = $em->getRepository('Blog\Entity\ChildParent')->findBy(array());

        return new ViewModel(array('posts' => $posts,));
    }

    public function addAction()
    {
        return $this->editAction();
    }

    public function addManualEntry(){
        $objectManager = $this->getEntityManager();
        $hydrator = new DoctrineHydrator($this->getEntityManager());
        $blogPost = new ChildParent();

        $tags = array();

        $tag1 = new Children();
        $tag1->setName('PHP');
        $tags[] = $tag1;

        $tag2 = new Children();
        $tag2->setName('STL');
        $tags[] = $tag2;

        $data = array(
            'name' => 'The best blog post in the world !',
            'tags'  => $tags // Note that you can mix integers and entities without any problem
        );

        $blogPost = $hydrator->hydrate($data, $blogPost);
        $objectManager->persist($blogPost);
            $objectManager->flush();
    }

    public function editAction()
    {
//        $this->addManualEntry();
        
        $form = new CreateParentsForm($this->serviceLocator);
        
        $post = new ChildParent();

        if ($this->params('id') > 0) {
            $post = $this->getEntityManager()->getRepository('Blog\Entity\ChildParent')->find($this->params('id'));
        }
        //$form->setHydrator(new DoctrineEntity($this->getEntityManager(),'Blog\Entity\ChildParent'));
        $form->bind($post);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $em = $this->getEntityManager();

                $em->persist($post);
                $em->flush();

                $this->flashMessenger()->addSuccessMessage('Parents Saved');

                return $this->redirect()->toRoute('parents');
            }
        }

        return new ViewModel(array(
            'post' => $post,
            'form' => $form
        ));
    }

    public function deleteAction()
    {
        $post = $this->getEntityManager()->getRepository('Blog\Entity\ChildParent')->find($this->params('id'));

        if ($post) {
            $em = $this->getEntityManager();
            $em->remove($post);
            $em->flush();

            $this->flashMessenger()->addSuccessMessage('Parent Deleted');
        }

        return $this->redirect()->toRoute('parents');
    }


}

