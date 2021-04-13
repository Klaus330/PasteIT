<?php


namespace app\core;


class Session
{
    protected const FLASH_KEY = "flash_messages";

    public function __construct()
    {
        session_start();
        $this->markFlashMessagesAsRemoved();
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }


    private function markFlashMessagesAsRemoved()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if (is_array($flashMessage)) {
                $flashMessage["remove"] = true;
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }


    public function __destruct()
    {
        $this->removeFlashMessages();
    }

    /**
     * @return mixed
     */
    private function removeFlashMessages()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}