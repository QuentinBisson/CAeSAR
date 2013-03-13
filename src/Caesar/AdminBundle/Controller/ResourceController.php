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
        $newFileName = "";
        $resource = $form->getData();
        if ($resource->getLocal() != null && $resource->getLocal() != "") {
          $fileName = $resource->getLocal()->getClientOriginalName();
          $extension = explode('.', $fileName);
          $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
          $resource->getLocal()->move("resources/img", $newFileName);
          $this->resizeIMG($newFileName);
          $resource->setPath($newFileName);
        } else if ($resource->getUrl() != null && $resource->getUrl() != "") {
          $url = $resource->getUrl();
          $extension = explode('.', $url);
          $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
          $img = 'resources/img/' . $newFileName;
          file_put_contents($img, file_get_contents($url));
          $this->resizeIMG($newFileName);
          $resource->setPath($newFileName);
        }
        $resource->setPath($newFileName);

        if ($this->checkCode($resource->getCode())) {
          $em->persist($resource);
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', 'La ressource ' . $resource->getDescription() . ' a été ajoutée.'
          );
          return $this->redirect($this->generateUrl('caesar_admin_resource_homepage'));
        } else {
          $this->get('session')->getFlashBag()->add(
            'errot', 'Le code de la ressource ' . $resource->getCode() . ' n\'est pas un ISBN valide ou un code propriétaire.'
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
        $newFileName = $resource->getPath();
        $resource = $form->getData();
        if ($resource->getLocal() != null && $resource->getLocal() != "") {
          $fileName = $resource->getLocal()->getClientOriginalName();
          $extension = explode('.', $fileName);
          $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
          $resource->getLocal()->move("resources/img", $newFileName);
          $this->resizeIMG($newFileName);
          $resource->setPath($newFileName);
        } else if ($resource->getUrl() != null && $resource->getUrl() != "") {
          $url = $resource->getUrl();
          $extension = explode('.', $url);
          $newFileName = $resource->getCode() . "." . $extension[count($extension) - 1];
          $img = 'resources/img/' . $newFileName;
          file_put_contents($img, file_get_contents($url));
          $this->resizeIMG($newFileName);
          $resource->setPath($newFileName);
        }
        $resource->setPath($newFileName);

        //TODO check ISBN validator. Un bug sur 978-2749917474
        if ($this->checkCode($resource->getCode())) {
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', 'La ressource ' . $resource->getDescription() . ' a été modifiée.'
          );
          return $this->redirect($this->generateUrl('caesar_admin_resource_homepage'));
        } else {
          $this->get('session')->getFlashBag()->add(
            'error', 'Le code de la ressource ' . $resource->getCode() . ' n\'est pas un ISBN valide ou un code propriétaire.'
          );
        }
      }
    }

    return $this->render('CaesarAdminBundle:Resource:update.html.twig', array(
          'form' => $form->createView(), 'resource' => $resource, 'shelf' => $resource->getShelf()
      ));
  }

  public function descriptionAction($id = 1) {
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $id . ' est invalide.');
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $shelf = $em->getRepository('CaesarShelfBundle:Shelf')
        ->find($clean);
    }
    if (!$shelf) {
      throw $this->createNotFoundException('Emplacement non trouvé avec id ' . $clean);
    }

    $request = $this->get('request');
    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:Resource:shelfDescription.html.twig", array('shelf' => $shelf));
    }
    throw $this->createNotFoundException('Requete invalide');
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
      $Reduction = ( ($NouvelleLargeur * 100) / $img_src_width);
      $NouvelleHauteur = ( ($img_src_height * $Reduction) / 100 );
      $img_dst_resource = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur);
      imagecopyresampled($img_dst_resource, $img_src_resource, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $img_src_width, $img_src_height);
      imagejpeg($img_dst_resource, "resources/img/" . $fileName);
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
    $caesar = "CAeSAR-";
    if (strlen($caesar) < strlen($code) && substr($code, 0, strlen($caesar)) === $caesar) {
      $em = $this->getDoctrine()->getManager();
      if (filter_input(INPUT_GET, substr($code, strlen($caesar), strlen($code)), FILTER_VALIDATE_INT) !== false) {
        $clean = $code;
      } else {
        return false;
      }
      $tag = $em->getRepository('CaesarTagBundle:Tag')
        ->findOneByCode($clean);
      if (!$tag) {
        return false;
      }
      print_r($tag);

      $em->remove($tag);
      $em->flush();
      return true;
    } else {
      //On enlève les tirets au cas où
      $code = str_replace('-', '', $code);
      return $this->checkISBN($code);
    }
  }

  /**
   * Cette fonction teste si une chaîne est un ISBN-10 ou un ISBN-13
   * @param type $isbn
   * @return boolean
   */
  private function checkISBN($isbn) {
    $type = gettype($isbn);
    if ($type === -1) {
      return false;
    } else if ($type === 13) {
      return $this->validatettn($isbn) > 0;
    } else {
      return $this->validateten($isbn) > 0;
    }
  }

  /**
   * Cette fonction permet de savoir si une chaîne est un ISBN-10 ou un ISBN-13
   * @param type $isbn
   * @return int
   */
  public function gettype($isbn) {
    if (preg_match('%[0-9]{12}?[0-9Xx]%s', $isbn)) {
      return 13;
    } else if (preg_match('%[0-9]{9}?[0-9Xx]%s', $isbn)) {
      return 10;
    } else {
      return -1;
    }
  }

  /**
   * Cette fonction permet de valider un code ISBN-10
   *
   * @param type $isbn
   * @return int
   */
  public function validateten($isbn) {
    $chksum = substr($isbn, -1, 1);
    $isbn = substr($isbn, 0, -1);
    if (preg_match('/X/i', $chksum)) {
      $chksum = "10";
    }
    $sum = $this->genchksum10($isbn);
    if ($chksum == $sum) {
      return 1;
    } else {
      return 0;
    }
  }

  /**
   * Cette fonction permet de valider un code ISBN-13
   *
   * @param type $isbn
   * @return int
   */
  public function validatettn($isbn) {
    $chksum = substr($isbn, -1, 1);
    $isbn = substr($isbn, 0, -1);
    if (preg_match('/X/i', $chksum)) {
      $chksum = "10";
    }
    $sum = $this->genchksum13($isbn);
    if ($chksum == $sum) {
      return 1;
    } else {
      return 0;
    }
  }

  public function genchksum13($isbn) {
    for ($i = 0; $i <= 12; $i++) {
      $tc = substr($isbn, -1, 1);
      $isbn = substr($isbn, 0, -1);
      $ta = ($tc * 3);
      $tci = substr($isbn, -1, 1);
      $isbn = substr($isbn, 0, -1);
      $tb = $tb + $ta + $tci;
    }
    $tg = ($tb / 10);
    $tint = intval($tg);
    if ($tint == $tg) {
      return 0;
    }
    $ts = substr($tg, -1, 1);
    $tsum = (10 - $ts);
    return $tsum;
  }

  public function genchksum10($isbn) {
    $t = 2;
    $isbn = trim($isbn);
    $a = 0;
    $b = 0;
    for ($i = 0; $i <= 9; $i++) {
      $b = $b + $a;
      $c = substr($isbn, -1, 1);
      $isbn = substr($isbn, 0, -1);
      $a = ($c * $t);
      $t++;
    }
    $s = ($b / 11);
    $s = intval($s);
    $s++;
    $g = ($s * 11);
    $sum = ($g - $b);
    return $sum;
  }

}