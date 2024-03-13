<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;

class SupplierController extends AbstractController
{
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /** Método para listar todos los proveedores y que lo muestre en suppliers.html.twig */
    public function getSuppliers()
    {
        $em = $this->doctrine->getManager();
        $listSuppliers = $em->getRepository('App\Entity\Proveedores')->findAll();

        // renderiza y crea la vista
        return $this->render('supplier/suppliers.html.twig', [
            'listSuppliers' => $listSuppliers
        ]);
    }

    /** Método para crear nuevos proveedores */
    public function createSuppliers(Request $request)
    {
        $em = $this->doctrine->getManager();

        $suppliers = new \App\Entity\Proveedores();

        // crea un formulario
        $form_suppliers = $this->createForm(\App\Form\SupplierType::class, $suppliers);
        $form_suppliers->handleRequest($request);

        // si el formulario fue enviado y es valido
        if ($form_suppliers->isSubmitted() && $form_suppliers->isValid()) {
            $suppliers->setActivo(1); // pone la propiedad como true (activo)

            $currentDate = new \DateTime('now'); // obtenemos fecha actual
            // le agrega la fecha de hoy a fecha_introduccion y fecha_actualizacion
            $suppliers->setFechaIntroduccion($currentDate);
            $suppliers->setFechaActualizacion($currentDate);
            // persistimos los cambios en la base de datos
            $em->persist($suppliers);
            // guardamos los cambios persistidos en la base de datos
            $em->flush();

            // redirigimos a "getSuppliers"
            return $this->redirectToRoute('getSuppliers');
        }

        // renderiza y crea la vista del formulario
        return $this->render('supplier/supplier_create.html.twig', [
            'form_suppliers' => $form_suppliers->createView()
        ]);
    }

    /** Método para actualizar/modificar un proveedor */
    public function updateSuppliers(Request $request, $id)
    {
        $em = $this->doctrine->getManager();

        // recuperamos el id del proveedor
        $suppliers = $em->getRepository('App\Entity\Proveedores')->find($id);
        
        // creamos el formulario de actualización
        $form_suppliers = $this->createForm(\App\Form\SupplierType::class, $suppliers, [
            'modificar' => true // opción para el formulario (si es 'true' deja ver la línea de 'Activo', para cambiar el estado del proveedor)
        ]);
        // procesamos los datos
        $form_suppliers->handleRequest($request);

        // si el formulario fue enviado y es válido
        if ($form_suppliers->isSubmitted() && $form_suppliers->isValid()) {
            $currentDate = new \DateTime('now'); // obtenemos fecha actual
            // le agrega la fecha de hoy a fecha_actualizacion
            $suppliers->setFechaActualizacion($currentDate);
            $em->persist($suppliers);
            $em->flush();

            // redirigimos a "getSuppliers"
            return $this->redirectToRoute('getSuppliers');
        }
        // renderiza y crea la vista del formulario
        return $this->render('supplier/supplier_update.html.twig', [
            'form_suppliers' => $form_suppliers->createView()
        ]);
    }

    /** Método para eliminar un proveedor */
    public function deleteSuppliers($id)
    {
        $em = $this->doctrine->getManager();

        // recuperamos el id del proveedor
        $suppliers = $em->getRepository('App\Entity\Proveedores')->find($id);
        // eliminamos el proveedor
        $em->remove($suppliers);
        $em->flush();

        // redirigimos a "getSuppliers"
        return $this->redirectToRoute('getSuppliers');
    }
}
