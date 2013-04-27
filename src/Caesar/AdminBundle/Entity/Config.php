<?php

namespace Caesar\AdminBundle\Entity;

class Config {

    private static $AUTHORS = 'authors_webmining_key';
    private static $PUBLISHER = 'publisher_webmining_key';
    private static $PUBLISHED_DATE = 'publishedDate_webmining_key';
    private static $LANGUAGE = 'language_webmining_key';
    private static $DESCRIPTION = 'description_webmining_key';
    private static $PAGE_COUNT = 'pageCount_webmining_key';
    private static $CATEGORIES = 'categories_webmining_key';
    private static $GOOGLE_BOOKS_WEBMINING = 'google_books_webmining';
    private static $ACTIVATED_WEBMINING = 'active_webmining';
    private static $GOOGLE_BOOKS_URL = 'google_books_url';
    private static $RESOURCE_SKELETON = 'resource_skeleton';

    private static function getParameter($container, $parameter) {
        try {
            return $container->getParameter($parameter);
        } catch (Exception $e) {
            return "";
        }
    }

    public static function isGoogleBooksWebmining($container) {
        return self::getParameter($container, self::$GOOGLE_BOOKS_WEBMINING) == true;
    }

    public static function isWebminingModuleActivated($container) {
        return self::getParameter($container, self::$ACTIVATED_WEBMINING) == true;
    }

    public static function getGoogleBooksURL($container) {
        return self::getParameter($container, self::$GOOGLE_BOOKS_URL);
    }

    public static function getCategoriesKey($container) {
        return self::getParameter($container, self::$CATEGORIES);
    }

    public static function getResourceSkeleton($container) {
        return self::getParameter($container, self::$RESOURCE_SKELETON);
    }

    public static function getAuthorsKey($container) {
        return self::getParameter($container, self::$AUTHORS);
    }

    public static function getPublisherKey($container) {
        return self::getParameter($container, self::$PUBLISHER);
    }

    public static function getPublishedDateKey($container) {
        return self::getParameter($container, self::$PUBLISHED_DATE);
    }

    public static function getLanguageKey($container) {
        return self::getParameter($container, self::$LANGUAGE);
    }

    public static function getDescriptionKey($container) {
        return self::getParameter($container, self::$DESCRIPTION);
    }

    public static function getPageCountKey($container) {
        return self::getParameter($container, self::$PAGE_COUNT);
    }

}