<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StaffController extends AbstractController
{
    /**
     * @Route("/staff", name="staff")
     */
    public function ShowStaffList()
    {
        $staff = $this->getDoctrine()
            ->getRepository('App\Entity\Staff')
            ->findAll();
        return $this->render('staff/index.html.twig', [
            'staff' => $staff
        ]);
    }
    
    /**
     * @Route("/staff/{id}", name="view each staff")
     */
    public function detailsAction($id)
    {
        $staff = $this->getDoctrine()
            ->getRepository('App\Entity\Staff')
            ->find($id);

        return $this->render('staff/views.html.twig', [
            'staff' => $staff
        ]);
    }
    
    /**
     * @Route("/staff/delete/{id}", name="staff_delete")
     */
    public function deleteAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $staff = $entityManager->getRepository('App\Entity\Staff')->find($id);
        $entityManager->remove($staff);
        $entityManager->flush();

        return $this->redirectToRoute('staff_list');
    }
    
    /**
    * @Route("/staff/create", name="staff_create", methods={"GET","POST"})
    */
    public function createAction(Request $request)
    {
        $staff = new Staff();
        $form = $this->createForm(StaffType::class, $staff);
        
        if ($this->saveChanges($form, $request, $staff)) {
            $this->addFlash(
                'notice',
                'Staff Added'
            );
            
            return $this->redirectToRoute('staff_list');
        }
        
        return $this->render('staff/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
     public function saveChanges($form, $request, $staff)
    {
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $staff->setName($request->request->get('staff')['name']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($staff);
            $em->flush();
            
            return true;
        }
        return false;
    }
    
     /**
    * @Route("Staff/edit/{id}", name="staff_edit")
    */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $staff = $em->getRepository('App\Entity\Staff')->find($id);
        
        $form = $this->createForm(BookType::class, $staff);
        
        if ($this->saveChanges($form, $request, $staff)) {
            $this->addFlash(
                'notice',
                'staff Edited'
            );
            return $this->redirectToRoute('staff_list');
        }
        
        return $this->render('staff/edit.html.twig', [
            'form' => $form->createView()
        ]);
     }
}
