<?php

namespace App\Helpers;

class SessionHelper
{
    private function __construct()
    {
    }


    /**
     * Set a flash message in the session.
     *
     * @param string $key The key for the flash message.
     * @param string $message The flash message to set.
     * @return void
     */
    public static function setFlashMessage(string $key, $message): void
    {
        $_SESSION[$key] = $message;
    }    

    /**
     * Get a flash message from the session and then remove it.
     *
     * @param string $key The key for the flash message.
     * @return string|null The flash message, or null if not set.
     */
    public static function getFlashMessage(string $key): ?string
    {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $message;
        } else {
            return null;
        }
    }
}
