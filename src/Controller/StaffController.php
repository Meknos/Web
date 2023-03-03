<?php

namespace App\Controller;

use App\Entity\Staff;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('staff_list');
    }
}
