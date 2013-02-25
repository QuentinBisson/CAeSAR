<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Caesar\ResourceBundle\Entity\Resource;
use Caesar\ResourceBundle\Form\ResourceType;
use Caesar\ResourceBundle\Form\ResourceSearchType;

/**
 * Description of ResourceController
 *
 * @author bissoqu1
 */
class ResourceController extends Controller {

    public function indexAction($page = 1, $sort = 'code', $direction = 'asc') {

        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $searchForm = $this->createForm(new ResourceSearchType());
        $keywords = null;
        $em = $this->getDoctrine()->getManager();

        $repository_resource = $em->getRepository('CaesarResourceBundle:Resource');

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $searchForm->bind($request);
            if ($searchForm->isValid()) {
                $data = $searchForm->getData();
                $keywords = $data['keywords'];
            }
        }
        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
        }

        $resources = $repository_resource->getResourceFromToSortBy($page, $sort, $direction, $keywords);
        $count = $repository_resource->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'resources' => $resources,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:Resource:list.html.twig", $array);
        }

        $array['searchForm'] = $searchForm->createView();

        return $this->render("CaesarAdminBundle:Resource:index.html.twig", $array);
    }

    public function addAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $resource = new Resource();
        $form = $this->createForm(new ResourceType(), $resource);
        $request = $this->get('request');

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $resource = $form->getData();
                $newFileName = "";
                if ($resource->getLocal() != "") {
                    $fileName = $resource->getLocal()->getClientOriginalName();
                    $extension = explode('.', $fileName);
                    $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
                    $resource->getLocal()->move("resources/img", $newFileName);
                } else {
                    $url = $resource->getUrl();
                    $extension = explode('.', $url);
                    $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
                    $img = 'resources/img/' . $newFileName;
                    file_put_contents($img, file_get_contents($url));
                }
                $this->resizeIMG($newFileName);
                $resource->setPath($newFileName);

                $em->persist($resource);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'La ressource ' . $resource->getDescription() . ' a été ajoutée.'
                );
                return $this->redirect($this->generateUrl('caesar_admin_resource_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Resource:add.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function updateAction($id) {
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' est invalide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $resource = $em->getRepository('CaesarResourceBundle:Resource')
                    ->find($clean);
        }

        if (!$resource) {
            throw $this->createNotFoundException('Ressource non trouvé avec id ' . $id);
        }

        $form = $this->createForm(new ResourceType(), $resource);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $resource = $form->getData();
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'La ressource ' . $resource->getDescription() . ' a été modifiée.'
                );
                $this->redirect($this->generateUrl('caesar_resource_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Resource:update.html.twig', array(
                    'form' => $form->createView(), 'resource' => $id
                ));
    }

    public function deleteAction($id) {
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' n\'est pas valide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $resource = $em->getRepository('CaesarResourceBundle:Resource')
                    ->find($clean);
        }

        if (!$resource) {
            throw $this->createNotFoundException('Ressource non trouvé avec id ' . $id);
        }

        $em->remove($resource);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'La ressource ' . $resource->getId() . ' a été supprimée.'
        );

        return $this->render('CaesarAdminBundle:Resource:delete.html.twig');
    }

    public function skeletonAction() {
        return $this->render('CaesarAdminBundle:Resource:skeleton.html.twig');
    }

    private function resizeIMG($fileName) {
        $extension = strtolower(substr($fileName, -3));
        $img_src_resource = null;
        switch ($extension) {
            case "jpg":
                $img_src_resource = imagecreatefromjpeg("resources/img/" . $fileName);
                break;
            case "png":
                $img_src_resource = imagecreatefrompng("resources/img/" . $fileName);
                break;
        }
        if ($img_src_resource != null) {
            $img_src_width = imagesx($img_src_resource);
            $img_src_height = imagesy($img_src_resource);
            $NouvelleLargeur = 140;
            $Reduction = ( ($NouvelleLargeur * 100) /  $img_src_width);
            $NouvelleHauteur = ( ($img_src_height * $Reduction) / 100 );
            $img_dst_resource = imagecreatetruecolor( $NouvelleLargeur, $NouvelleHauteur );
            imagecopyresampled($img_dst_resource, $img_src_resource,0,0,0,0,$NouvelleLargeur,$NouvelleHauteur, $img_src_width,$img_src_height );
            imagejpeg( $img_dst_resource, "resources/img/".$fileName);
        }
    }

}

?>
