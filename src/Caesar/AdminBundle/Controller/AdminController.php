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
            $fileName = "backup.sql";
            mkdir("resources/backup/" . $repertoire, 777, true);
            $fp = fopen("resources/backup/" . $repertoire . "/" . $fileName, "a+");
            fputs($fp, "/*====== Drop des données  */\n");
            fputs($fp, "DELETE FROM borrowing;\n");
            fputs($fp, "DELETE FROM borrowingArchive;\n");
            fputs($fp, "DELETE FROM reservation;\n");
            fputs($fp, "DELETE FROM reservation;\n");
            fputs($fp, "DELETE FROM resource;\n");
            fputs($fp, "DELETE FROM tag;\n");
            fputs($fp, "DELETE FROM format;\n");
            fputs($fp, "DELETE FROM shelf;\n");
            fputs($fp, "DELETE FROM user;\n\n");

            foreach ($save_table as $key => $value) {
                fputs($fp, "/* ====== Sauvegarde de la table " . $key . " */\n\n");
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
                    fputs($fp, substr($insert, 0, strlen($insert) - 1) . ");\n");
                }
                fputs($fp, "\n");
            }
            fclose($fp);
            mkdir("resources/backup/" . $repertoire . "/img", 777, true);
            $this->CopyDir("resources/img", "resources/backup/" . $repertoire . "/img");
            /* $zip = new ZipArchive();
              if ($zip->open('fichier.zip', ZipArchive::CREATE) === true) {
              $zip->addFile("resources/backup/" . $repertoire);
              }
              $zip->close(); */
        }
        return $this->render('CaesarAdminBundle:Admin:createBackup.html.twig');
    }

    function CopyDir($origine, $destination) {
        $test = scandir($origine);

        $file = 0;
        $file_tot = 0;

        foreach ($test as $val) {
            if ($val != "." && $val != "..") {
                if (is_dir($origine . "/" . $val)) {
                    CopyDir($origine . "/" . $val, $destination . "/" . $val);
                    IsDir_or_CreateIt($destination . "/" . $val);
                } else {
                    $file_tot++;
                    if (copy($origine . "/" . $val, $destination . "/" . $val)) {
                        $file++;
                    } else {
                        if (!file_exists($origine . "/" . $val)) {
                            echo $origine . "/" . $val;
                        };
                    };
                };
            };
        }
        return true;
    }

    public function loadBackupAction() {
        $file = null;
        $form = $this->createForm(new LoadBackupType(), $file);

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $data = file_get_contents($form['fileName']->getData());
                $this->getDoctrine()->getManager()->getConnection()->executeUpdate($data);
            }
        }
        return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig', array('form' => $form->createView()));
    }

}