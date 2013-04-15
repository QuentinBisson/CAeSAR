<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Entity\Config;
use Caesar\AdminBundle\Form\ResourceSkeletonType;
use Caesar\ResourceBundle\Entity\Resource;
use Caesar\ResourceBundle\Form\ResourceSearchType;
use Caesar\ResourceBundle\Form\ResourceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
                    'resource' => $resource,
                    'active_module' => Config::isWebminingModuleActivated($this->container)
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
                            'error', $translator->trans('admin.form.resources.error', array('%resource%' => $resource->getCode()))
                    );
                }
            }
        }

        return $this->render('CaesarAdminBundle:Resource:update.html.twig', array(
                    'form' => $form->createView(), 'resource' => $resource, 'shelf' => $resource->getShelf(),
                    'active_module' => Config::isWebminingModuleActivated($this->container)
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
     * Permet de rechercher les informations sur une ressource depuis un isbn
     *
     * @param type $id
     * @return type
     * @throws type
     */
    public function webminingAction($code) {
        $translator = $this->get('translator');
        if (!Config::isWebminingModuleActivated($this->container)) {
            throw $this->createNotFoundException($translator->trans('admin.form.webmining.activated.exception'));
        }
        if (filter_input(INPUT_GET, $code, FILTER_VALIDATE_INT) !== false) {
            $clean = $code;
        } else {
            throw $this->createNotFoundException($translator->trans('admin.form.webmining.exception', array('%code%' => $code)));
        }
        if (!Resource::checkISBN($clean)) {
            throw $this->createNotFoundException($translator->trans('admin.form.webmining.exception', array('%shelf%' => $clean)));
        }

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            $resource = $this->webmining($clean);
            return new Response($resource);
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
        $translator = $this->get('translator');

        $array = array();
        $array['skeleton'] = str_replace("\\r\\n", "\r\n", Config::getResourceSkeleton($this->container));

        $form = $this->createForm(new ResourceSkeletonType(), $array);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->get('caesar.params')->save(
                        array(
                            'resource_skeleton' => $data['skeleton']
                ));
                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('admin.form.skeleton.notice')
                );
                return $this->redirect($this->generateUrl('caesar_admin_resource_skeleton'));
            } else {
                $this->get('session')->getFlashBag()->add(
                        'error', $translator->trans('admin.form.skeleton.error')
                );
            }
        }

        return $this->render('CaesarAdminBundle:Resource:skeleton.html.twig', array('form' => $form->createView()));
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
            imagejpeg($destinationResource, "resources/img/" . $fileName, 80);
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

    private function webmining($isbn) {
        $resource = null;
        if (Resource::checkISBN($isbn)) {
            if (Config::isGoogleBooksWebmining($this->container)) {
                $resource = $this->searchDataFromGoogleBooks($isbn);
            }
        }
        return $this->transformResourceToJSON($resource);
    }

    private function searchDataFromGoogleBooks($isbn) {
        if (($request = Config::getGoogleBooksURL($this->container)) == null) {
            return null;
        }
        $request .= $isbn;
        $response = file_get_contents($request);
        $results = json_decode($response);

        if ($results->totalItems > 0) {
            $book = $results->items[0];
            $resource = array();
            if (isset($book->volumeInfo->industryIdentifiers[0]->identifier)) {
                $resource['isbn'] = $book->volumeInfo->industryIdentifiers[0]->identifier;
            }
            if (isset($book->volumeInfo->title)) {
                $resource['title'] = $book->volumeInfo->title;
            }
            if (isset($book->volumeInfo->authors)) {
                $resource['authors'] = $book->volumeInfo->authors;
            }
            if (isset($book->volumeInfo->publisher)) {
                $resource['publisher'] = $book->volumeInfo->publisher;
            }
            if (isset($book->volumeInfo->description)) {
                $resource['description'] = $book->volumeInfo->description;
            }
            if (isset($book->volumeInfo->publishedDate)) {
                $resource['publishedDate'] = $book->volumeInfo->publishedDate;
            }
            if (isset($book->volumeInfo->categories)) {
                $resource['categories'] = $book->volumeInfo->categories;
            }
            if (isset($book->volumeInfo->language)) {
                $resource['language'] = $book->volumeInfo->language;
            }
            if (isset($book->volumeInfo->pageCount)) {
                $resource['pageCount'] = $book->volumeInfo->pageCount;
            }
            if (isset($book->volumeInfo->imageLinks)) {
                $resource['image'] = str_replace('&edge=curl', '', $book->volumeInfo->imageLinks->thumbnail);
            }
            return $resource;
        } else {
            return null;
        }
    }

    private function transformResourceToJSON($resource) {
        if ($resource == null) {
            return null;
        }
        $request = $this->getRequest();
        $skeleton = Config::getResourceSkeleton($this->container);
        $result = array();

        $key = Config::getAuthorsKey($this->container);
        if (isset($resource['authors'])) {
            $authors = "";
            $separator = "";
            foreach ($resource['authors'] as $author) {
                $authors .= $separator . $author;
                $separator = ", ";
            }
            $longDescription = str_replace('$' . $key, $authors, $skeleton);
        } else {
            $longDescription = str_replace('$' . $key, "", $skeleton);
        }

        if (isset($resource['title'])) {
            $result['description'] = $resource['title'];
        } else {
            $result['description'] = "";
        }

        $key = Config::getPublisherKey($this->container);
        if (isset($resource['publisher'])) {
            $longDescription = str_replace('$' . $key, $resource['publisher'], $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        $key = Config::getDescriptionKey($this->container);
        if (isset($resource['description'])) {
            $longDescription = str_replace('$' . $key, $resource['description'], $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        $key = Config::getPublishedDateKey($this->container);
        if (isset($resource['publishedDate'])) {
            $longDescription = str_replace('$' . $key, $resource['publishedDate'], $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        $key = Config::getCategoriesKey($this->container);
        if (isset($resource['categories'])) {
            $categories = "";
            $separator = "";
            foreach ($resource['categories'] as $category) {
                $categories .= $separator . $category;
                $separator = ", ";
            }
            $longDescription = str_replace('$' . $key, $categories, $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        $key = Config::getLanguageKey($this->container);
        if (isset($resource['language'])) {
            $longDescription = str_replace('$' . $key, $resource['language'], $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        $key = Config::getPageCountKey($this->container);
        if (isset($resource['pageCount'])) {
            $longDescription = str_replace('$' . $key, $resource['pageCount'], $longDescription);
        } else {
            $longDescription = str_replace('$' . $key, "", $longDescription);
        }

        if (isset($resource['image'])) {
            $result['image'] = $resource['image'];
        } else {
            $result['image'] = "";
        }

        $result['longDescription'] = $longDescription;
        return json_encode($result);
    }

}