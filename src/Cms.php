<?php namespace Cswiley\Cms;

use const ARRAY_FILTER_USE_BOTH;
use Illuminate\Support\Facades\Storage;


class Cms
{
    private function getStorage()
    {
        return Storage::disk(config('cms.storage_disk', 'local'));
    }

    function all($showExtension = false)
    {
        $translations = config('cms.translations');
        $files = $this->getStorage()->files();

        // Only use .json files
        $files = array_filter($files, function ($file) {
            return !!preg_match('/\.json$/', $file);
        });

        if (!$showExtension) {
            $files = array_map(function ($n) {
                return preg_replace('/.json/', '', $n);
            }, $files);
        }

        $nameHash = array_flip($files);
        if (! empty($translations)) {
            $files    = array_filter($translations, function ($value, $key) use ($nameHash) {
                return isset($nameHash[$key]);
            }, ARRAY_FILTER_USE_BOTH);
        }
        else {
            // Auto handle translations
            $map = [];
            foreach($files as $name) {
                $map[$name] = str_replace(['-', '_'], ' ', $name);
            }

            $files = $map;
        }

        return $files;
    }

    function set($name, $data)
    {
        $file = preg_replace('/\.json/', '', $name) . '.json';
        return $this->getStorage()->put($file, $data);
    }

    function get($name)
    {
        $file = preg_replace('/\.json/', '', $name) . '.json';
        if ($this->getStorage()->exists($file)) {
            $content = $this->getStorage()->get($file);

            return json_decode($content, true);
        }

        return [];
    }
}