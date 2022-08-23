<?php

namespace App\Domain\Controller;

use App\Domain\Entity\Employee;
use App\Domain\Form\EmployeeType;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeController extends AbstractController
{
    public function saveCsvToDataBase(Request $request, EntityManagerInterface $entityManager)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $employeeFile */
            $employeeFile = $form->get('employee')->getData();

            if (($handle = fopen($employeeFile->getPathname(), "r")) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $result[] = $data;
                }
                fclose($handle);

                foreach ($result as $item) {
                    $employeeEntity = new Employee();
                    $employeeEntity->setEmployeeName($item[0]);
                    $employeeEntity->setEmployeeParentName($item[1]);
                    $entityManager->persist($employeeEntity);
                }
                $entityManager->flush();
            }

            return $this->redirectToRoute('employee-form');
        }

        return $this->renderForm('forms/new.html.twig', [
            'form' => $form,
        ]);
    }
}