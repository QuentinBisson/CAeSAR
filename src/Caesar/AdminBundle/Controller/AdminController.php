<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Entity\Config;
use Caesar\AdminBundle\Form\ReservationDeleteType;
use Caesar\AdminBundle\Form\WebminingModuleType;
use Caesar\UserBundle\Form\ChangePasswordType;
use Caesar\AdminBundle\Form\LoadBackupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use \ZipArchive;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\File;

class AdminController extends Controller {

    public function indexAction() {
        return $this->render('CaesarAdminBundle:Admin:index.html.twig');
    }

    public function passwordAction() {
        $translator = $this->get('translator');
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new ChangePasswordType());

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encoded = $encoder->encodePassword($data['currentPassword'], $user->getSalt());
                if ($encoded === $user->getPassword()) {
                    if ($data['newPassword'] === $data['confirmPassword']) {
                        //handle data
                        $newPassword = $encoder->encodePassword($data['newPassword'], $user->getSalt());
                        $em = $this->getDoctrine()->getManager();
                        $userInDB = $em->getRepository('CaesarUserBundle:User')->find($user->getId());
                        $user->setPassword($newPassword);
                        $userInDB->setPassword($newPassword);
                        $em->flush();
                        $this->get('session')->getFlashBag()->add(
                                'notice', $translator->trans('admin.form.users.notice.password.changed')
                        );
                        return $this->redirect($this->generateUrl('caesar_admin_homepage'));
                    } else {
                        $this->get('session')->getFlashBag()->add(
                                'error', $translator->trans('admin.form.users.password.not_same')
                        );
                    }
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'error', $translator->trans('admin.form.users.password.no_match')
                    );
                }
            }
        }

        return $this->render('CaesarAdminBundle:Admin:password.html.twig', array('form' => $form->createView()));
    }

    public function listReservationsAction($page = 1, $sort = 'id', $direction = 'asc') {
        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $em = $this->getDoctrine()->getManager();

        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $reservations = $repository_reservation->getReservationsFromToSortBy($page, $sort, $direction);
        $count = $repository_reservation->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'reservations' => $reservations,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:Admin:listReservations.html.twig", $array);
        }

        return $this->render("CaesarAdminBundle:Admin:reservations.html.twig", $array);
    }

    public function deleteReservationAction($id) {
        $translator = $this->get('translator');
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException($translator->trans('admin.form.reservations.exception', array('%reservation%' => $id)));
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $reservation = $em->getRepository('CaesarUserBundle:Reservation')
                    ->find($clean);
        }

        if (!$reservation) {
            throw $this->createNotFoundException($translator->trans('admin.form.reservations.exception', array('%reservation%' => $id)));
        }
        $em->remove($reservation);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', $translator->trans('admin.form.reservations.notice.delete', array('%reservation%' => $reservation->getId()))
        );

        return $this->redirect($this->generateUrl('caesar_admin_general_reservation_homepage'));
    }

    public function purgeAction() {
        $translator = $this->get('translator');
        $form = $this->createForm(new ReservationDeleteType());

        $em = $this->getDoctrine()->getManager();
        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $reservations = $repository_reservation->getOldFromToSortBy($data['reservationDate']);
                foreach ($reservations as $r) {
                    $em->remove($r);
                }
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('admin.form.reservations.delete', array("%count%" => count($reservations), "%date%" => $data['reservationDate']->format('d/m/Y')))
                );
            }
        }
        return $this->render('CaesarAdminBundle:Admin:purge.html.twig', array('form' => $form->createView()));
    }

    public function webminingAction() {
        $translator = $this->get('translator');

        $array = array();
        $array['active_module'] = Config::isWebminingModuleActivated($this->container);
        $array['authors_key'] = Config::getAuthorsKey($this->container);
        $array['publisher_key'] = Config::getPublisherKey($this->container);
        $array['published_date_key'] = Config::getPublishedDateKey($this->container);
        $array['language_key'] = Config::getLanguageKey($this->container);
        $array['description_key'] = Config::getDescriptionKey($this->container);
        $array['page_count_key'] = Config::getPageCountKey($this->container);
        $array['google_books_url'] = Config::getGoogleBooksURL($this->container);
        $array['categories_key'] = Config::getCategoriesKey($this->container);
        $form = $this->createForm(new WebminingModuleType(), $array);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->get('caesar.params')->save(
                        array(
                            'active_webmining' => $data['active_module'],
                            'authors_webmining_key' => $data['authors_key'],
                            'publisher_webmining_key' => $data['publisher_key'],
                            'publishedDate_webmining_key' => $data['published_date_key'],
                            'language_webmining_key' => $data['language_key'],
                            'description_webmining_key' => $data['description_key'],
                            'pageCount_webmining_key' => $data['page_count_key'],
                            'google_books_url' => $data['google_books_url'],
                            'categories_webmining_key' => $data['categories_key'],
                ));
                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('admin.form.webmining.notice')
                );
                return $this->redirect($this->generateUrl('caesar_admin_general_webmining'));
            } else {
                $this->get('session')->getFlashBag()->add(
                        'error', $translator->trans('admin.form.webmining.error')
                );
            }
        }

        return $this->render('CaesarAdminBundle:Admin:webmining.html.twig', array('form' => $form->createView()));
    }

    public function createBackupAction() {
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $save_table = array(
                'user' => 'CaesarUserBundle:User',
                'shelf' => 'CaesarShelfBundle:Shelf',
                'resource' => 'CaesarResourceBundle:Resource',
                'borrowing' => 'CaesarUserBundle:Borrowing',
                'borrowingArchive' => 'CaesarUserBundle:BorrowingArchive',
                'reservation' => 'CaesarUserBundle:Reservation',
                'tag' => 'CaesarTagBundle:Tag',
                'format' => 'CaesarTagBundle:Format',
            );
            $date = date("d-m-Y");
            $heure = date("H-i-s");
            $repertoire = $date . "-" . $heure;
            $save_file = "";
            $save_file.= "/*====== Drop des données  */\n";
            $save_file.="DELETE FROM borrowing;\n";
            $save_file.="DELETE FROM borrowingArchive;\n";
            $save_file.="DELETE FROM reservation;\n";
            $save_file.="DELETE FROM reservation;\n";
            $save_file.="DELETE FROM resource;\n";
            $save_file.="DELETE FROM tag;\n";
            $save_file.="DELETE FROM format;\n";
            $save_file.="DELETE FROM shelf;\n";
            $save_file.="DELETE FROM user;\n\n";

            foreach ($save_table as $key => $value) {
                $save_file.= "/* ====== Sauvegarde de la table " . $key . " */\n\n";
                $repo = $em->getRepository($value);
                $alldata = $repo->findAllInArray();
                foreach ($alldata as $datum) {
                    $insert = "INSERT INTO " . $key . " VALUES(";
                    foreach ($datum as $colum) {
                        if (!$colum instanceof \DateTime) {
                            $insert .= "'" . $colum . "',";
                        } else {
                            $insert .= "'" . date_format($colum, 'Y-m-d H:i:s') . "',";
                        }
                    }
                    $save_file.=substr($insert, 0, strlen($insert) - 1) . ");\n";
                }
                $save_file.="\n";
            }
            $zip = new ZipArchive();
            if ($zip->open('resources/backup/backup-' . $repertoire . ".zip", ZipArchive::CREATE) === true) {
                $zip->addFile("resources/backup/" . $repertoire . "/backup.sql", "backup.sql");
                $file_in_img = scandir("resources/img");
                foreach ($file_in_img as $file) {
                    if ($file != "." && $file != "..") {
                        $zip->addFile("resources/img/" . $file, "img/" . $file);
                    }
                }
                $zip->addFromString("backup.sql", $save_file);
            }
            $zip->close();
            $response = new Response();
            $response->setContent(file_get_contents('resources/backup/backup-' . $repertoire . ".zip"));
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', "application/zip");
            $response->headers->set('Content-Disposition', sprintf('attachment;filename="%s"', "backup-" . $repertoire . ".zip", "zip"));
            $response->setCharset('UTF-8');
            $response->send();
            unlink('resources/backup/backup-' . $repertoire . ".zip");
            return $response;
        }

        return $this->render('CaesarAdminBundle:Admin:createBackup.html.twig');
    }

    private function deleteDirectory($dir) {
        if (!file_exists($dir))
            return true;
        if (!is_dir($dir) || is_link($dir))
            return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..')
                continue;
            if (!$this->deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!deleteDirectory($dir . "/" . $item))
                    return false;
            };
        }
        return rmdir($dir);
    }

    public function loadBackupAction() {
        $file = null;
        $form = $this->createForm(new LoadBackupType(), $file);
        $translator = $this->get('translator');

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            $constraint = new File(array('mimeTypes' => "application/zip"));
            $errorList = $this->get('validator')->validateValue($form['fileName']->getData(), $constraint);
            if (count($errorList) == 0) {
                $form['fileName']->getData()->move("resources/backup/load", "backup.zip");
                $zip = new ZipArchive();
                if ($zip->open("resources/backup/load/backup.zip") === TRUE) {
                    $zip->extractTo("resources/backup/load");
                    $zip->close();
                    unlink("resources/backup/load/backup.zip");
                }
                if (!file_exists("resources/backup/load/backup.sql") && !is_dir("resources/backup/load/img")) {
                    $this->deleteDirectory("resources/backup/load");
                    $this->get('session')->getFlashBag()->add(
                            'error', $translator->trans('load.backup.badFormat', array(), 'CaesarAdminBundle')
                    );
                    return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig', array('form' => $form->createView()));
                }
                $data = file_get_contents("resources/backup/load/backup.sql");
                $this->getDoctrine()->getManager()->getConnection()->executeUpdate($data);
                $file_in_img = scandir("resources/backup/load/img");
                $this->deleteDirectory("resources/img");
                mkdir("resources/img");
                foreach ($file_in_img as $file) {
                    if ($file != "." && $file != "..") {
                        rename("resources/backup/load/img/" . $file, "resources/img/" . $file);
                    }
                }
                $this->deleteDirectory("resources/backup/load");
            } else {
                $this->get('session')->getFlashBag()->add(
                        'error', $translator->trans('load.backup.badMimeType', array(), 'CaesarAdminBundle')
                );
            }
        }
        return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig', array('form' => $form->createView()));
    }

}