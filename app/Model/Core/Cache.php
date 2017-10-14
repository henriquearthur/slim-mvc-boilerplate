<?php

namespace App\Core\Model;

class Cache
{
    protected $ci;

    /**
     * Directory that cached files will be saved
     * @var string
     */
    private $dir = __DIR__ . '/../../../storage/cache/';

    /**
     * Extension of the cached files
     * @var string
     */
    private $extension = '.cache';

    /**
     * Content of files already opened by this class
     * If a file has been opened by this class, there is no reason to
     * read it from filesystem again
     * @var array
     */
    private $openedContent = [];

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    /**
     * Get path for a cache file
     * @param  string $name file name
     * @return string       file path
     */
    private function getFilePath($name)
    {
        return $this->dir . sha1($name) . $this->extension;
    }

    /**
     * Read the content of a cache file
     * @param  string           $filePath file path
     * @return stirng/boolean             content of the file or false if error
     */
    private function readFile($filePath)
    {
        if (isset($this->openedContent[$filePath])) {
            return $this->openedContent[$filePath];
        } else {
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                $this->openedContent[$filePath] = $content;

                if (!$content) {
                    $this->ci->appLogger->critical('Unable to read a cache file in ' . $filePath);

                    return false;
                }

                return $content;
            }
        }

        return false;
    }

    /**
     * Check if a saved-key is still valid
     * @param  string $name saved-key
     * @return boolean      true if valid, false if not
     */
    public function isValid($name)
    {
        $filePath = $this->getFilePath($name);
        $fileContent = $this->readFile($filePath);

        if ($fileContent !== false) {
            $content = unserialize($fileContent);

            if ($content['expiration'] >= time()) {
                return true;
            }
        }

        $this->delete($name);

        return false;
    }

    /**
     * Save a content on cache
     * @param  string        $name     saved-key
     * @param  string/array  $content  content to be cached
     * @param  integer       $expire   expiration in seconds - default to 60 seconds
     * @return boolean                 true if saved, false if not
     */
    public function save($name, $content, $expire = 60)
    {
        if (is_array($content)) {
            $content = json_encode($content);
            $json = true;
        } else {
            $json = false;
        }

        $fileContent = serialize(array('content' => $content, 'json' => $json, 'expiration' => time() + $expire));
        $filePath = $this->getFilePath($name);

        $save = file_put_contents($filePath, $fileContent);

        if (!$save) {
            $this->ci->appLogger->critical('Unable to save a cache file in ' . $filePath);
        }

        return $save;
    }

    /**
     * Get a cached content, verifying it first if exists and it's not expired
     * @param  string       $name      saved-key for a cache file
     * @return string/null             cached content
     */
    public function get($name)
    {
        $filePath = $this->getFilePath($name);
        $fileContent = $this->readFile($filePath);

        if ($fileContent !== false) {
            $content = unserialize($fileContent);

            if ($content['json']) {
                return json_decode($content['content'], true);
            }

            return $content['content'];
        }

        $this->ci->appLogger->error("Unable to retrieve cache-file content on method get() on Cache class");
        return false;
    }

    /**
     * Delete a saved-key
     * @param  string $name     saved-key
     * @return boolean          true if deleted, false if not
     */
    public function delete($name)
    {
        $filePath = $this->getFilePath($name);

        if (file_exists($filePath)) {
            $delete = unlink($filePath);

            if ($delete) {
                return true;
            }

            $this->ci->appLogger->critical('Unable to delete a cache file in ' . $filePath);
        }

        return false;
    }
}
