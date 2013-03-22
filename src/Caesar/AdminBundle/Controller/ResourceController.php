<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\ResourceBundle\Entity\Resource;
use Caesar\ResourceBundle\Form\ResourceSearchType;
use Caesar\ResourceBundle\Form\ResourceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ResourceController
 *
 * @author bissoqu1
 */
class ResourceController extends Controller {

  /**
   * Lister les ressources
   * @param type $page
   * @param type $sort
   * @param type $direction
   * @return type
   */
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
    $count = $repository_resource->count($keywords);

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

  private function handleImage($resource) {
    $newFileName = "";
    if ($resource->getLocal() != null && $resource->getLocal() != "") {
      $fileName = $resource->getLocal()->getClientOriginalName();
      $extension = explode('.', $fileName);
      $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
      $resource->getLocal()->move("resources/img", $newFileName);
      $this->resizeImg($newFileName);
    } else if ($resource->getUrl() != null && $resource->getUrl() != "") {
      $url = $resource->getUrl();
      $extension = explode('.', $url);
      $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
      $img = 'resources/img/' . $newFileName;
      file_put_contents($img, file_get_contents($url));
      $this->resizeImg($newFileName);
    } else {
      $newFileName = $resource->getPath();
    }
    return $newFileName;
  }

  public function addAction() {
    $em = $this->getDoctrine()->getEntityManager();
    $translator = $this->get('translator');
    $resource = new Resource();
    $form = $this->createForm(new ResourceType(), $resource);
    $request = $this->get('request');

    if ($request->isMethod('POST')) {
      $form->bind($request);
      if ($form->isValid()) {
        $resource = $form->getData();
        $filename = $this->handleImage($resource);
        $resource->setPath($filename);

        if (!Resource::isCAeSARCode($resource->getCode())) {
          $resource->setCode(str_replace(array(' ', '-', '.'), '', $resource->getCode()));
        }

        if ($this->checkCode($resource->getCode())) {

          if (Resource::isCAeSARCode($resource->getCode())) {
            $em = $this->getDoctrine()->getManager();
            $tag = $em->getRepository('CaesarTagBundle:Tag')
              ->findOneByCode($resource->getCode());
            if (!$tag) {
              $this->get('session')->getFlashBag()->add(
                'error', $translator->trans('admin.form.resources.tag.invalid', array('%resource%' => $resource->getCode()))
              );
              return $this->render('CaesarAdminBundle:Resource:add.html.twig', array(
                    'form' => $form->createView(),
                    'resource' => $resource
                ));
            }
            $em->remove($tag);
            $em->flush();
          }

          $em->persist($resource);
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', $translator->trans('admin.form.resources.notice.add', array('%resource%' => $resource->getDescription()))
          );
          return $this->redirect($this->generateUrl('caesar_admin_resource_homepage'));
        } else {
          $this->get('session')->getFlashBag()->add(
            'error', $translator->trans('admin.form.resources.error', array('%resource%' => $resource->getCode()))
          );
        }
      }
    }

    return $this->render('CaesarAdminBundle:Resource:add.html.twig', array(
          'form' => $form->createView(),
          'resource' => $resource
      ));
  }

  public function updateAction($id) {
    $translator = $this->get('translator');
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException($translator->trans('admin.form.resources.exception', array('%resource%' => $id)));
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    }

    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('admin.form.resources.exception', array('%resource%' => $clean)));
    }

    $form = $this->createForm(new ResourceType(), $resource);
    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $form->bind($request);
      if ($form->isValid()) {
        $resource = $form->getData();
        $filename = $this->handleImage($resource);
        $resource->setPath($filename);

        if (!Resource::isCAeSARCode($resource->getCode())) {
          $resource->setCode(str_replace(array(' ', '-', '.'), '', $resource->getCode()));
        }

        if ($this->checkCode($resource->getCode())) {
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', $translator->trans('admin.form.resources.notice.update', array('%resource%' => $resource->getDescription()))
          );
          return $this->redirect($this->generateUrl('caesar_admin_resource_homepage'));
        } else {
          $this->get('session')->getFlashBag()->add(
            'error', $translator->trans('admin.form.resources.error', array('%resource%' => $resource->getDescription()))
          );
        }
      }
    }

    return $this->render('CaesarAdminBundle:Resource:update.html.twig', array(
          'form' => $form->createView(), 'resource' => $resource, 'shelf' => $resource->getShelf()
      ));
  }

  /**
   * Permet de récupérer la description d'une étagère
   *
   * @param type $id
   * @return type
   * @throws type
   */
  public function descriptionAction($id = 1) {
    $translator = $this->get('translator');
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException($translator->trans('admin.form.resources.exception', array('%resource%' => $id)));
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $shelf = $em->getRepository('CaesarShelfBundle:Shelf')
        ->find($clean);
    }
    if (!$shelf) {
      throw $this->createNotFoundException($translator->trans('admin.form.shelves.exception', array('%shelf%' => $clean)));
    }

    $request = $this->get('request');
    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:Resource:shelfDescription.html.twig", array('shelf' => $shelf));
    }
    throw $this->createNotFoundException($translator->trans('admin.form.invalid'));
  }

  /**
   * Permet de supprimer une ressource
   * @param type $id
   * @return type
   * @throws type
   */
  public function deleteAction($id) {
    $translator = $this->get('translator');
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException($translator->trans('admin.form.resources.exception', array('%resource%' => $id)));
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    }

    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('admin.form.resources.exception', array('%resource%' => $id)));
    }
    unlink('resources/img/' . $resource->getPath());
    $em->remove($resource);
    $em->flush();

    $this->get('session')->getFlashBag()->add(
      'notice', $translator->trans('admin.form.resources.notice.delete', array('%resource%' => $resource->getId()))
    );

    return $this->render('CaesarAdminBundle:Resource:delete.html.twig');
  }

  /**
   * Permet de modifier le squelette d'une ressource
   * @return type
   */
  public function skeletonAction() {
    return $this->render('CaesarAdminBundle:Resource:skeleton.html.twig');
  }

  /**
   * Méthode permettant de
   * @param type $fileName
   */
  private function resizeImg($fileName) {
    $prefix = "resources/img/";
    $info = getimagesize($prefix . $fileName);

    if ($info['mime'] == 'image/jpeg')
      $image = imagecreatefromjpeg($prefix . $fileName);
    elseif ($info['mime'] == 'image/gif')
      $image = imagecreatefromgif($prefix . $fileName);
    elseif ($info['mime'] == 'image/png')
      $image = imagecreatefrompng($prefix . $fileName);

    if ($image != null) {
      $sourceWidth = imagesx($image);
      $sourceHeight = imagesy($image);
      $newWidth = 140;
      $reduction = (($newWidth * 100) / $sourceWidth);
      $newHeight = (($sourceHeight * $reduction) / 100);
      $destinationResource = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($destinationResource, $image, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
      imagejpeg($destinationResource, "resources/img/" . $fileName, 90);
    }
  }

  /**
   * Cette fonction prend le code en paramètre et teste s'il s'agit d'un code géré par l'application.
   * Si c'est un code ISBN-10 ou ISBN-13, la fonction renvoie true
   * Si c'est un code propriétaire, la fonction renvoie true si le code existe dans la table étiquette.
   * L'étiquette est alors supprimé de la table.
   * Sinon, la fonction renvoie false
   *
   * @param type $code
   * @return boolean whether the code is an ISBN or a CAeSAR-code
   */
  private function checkCode($code) {
    $code = trim($code);
    if (Resource::isCAeSARCode($code)) {
      return true;
    } else {
      $code = str_replace(array(' ', '-', '.'), '', $code);
      return Resource::checkISBN($code);
    }
  }

}