<?php

/*
 * filename sanitizer extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Christian Barkowsky
 * @author     Christian Barkowsky <https://christianbarkowsky.de>
 * @license    LGPL-3.0-or-later
 * @link       https://github.com/christianbarkowsky/contao-filename-sanitizer
 */

namespace ChristianBarkowsky\Sanitizer;

use Contao\File;
use Contao\Folder;
use Contao\FilesModel;
use Ausi\SlugGenerator\SlugGenerator;

/**
 * Class Sanitizer
 * @package ChristianBarkowsky\Sanitizer
 */
class Sanitizer
{

    /**
     * @param $path
     *
     * @return bool
     *
     * @throws \Exception
     */
    public static function run($path)
    {
        $objFiles = FilesModel::findMultipleByBasepath($path);

        if (null == $objFiles) {
            return false;
        }

        while ($objFiles->next()) {
            $currentObj = $objFiles->current();

            if ($currentObj->type == 'file') {
                $objFile = new File($currentObj->path);

                if ($objFile->exists()) {
                    $strFilename = str_replace('.' . $objFile->extension, '', $objFile->name);
                    $strFolder   = str_replace($objFile->name, '', $currentObj->path);

                    $strFilename = self::sanitizeName($strFilename);

                    $path = $strFolder . $strFilename . '.' . $objFile->extension;

                    $objFile->renameTo($path);
                    $objFile->close();
                }
            }

            if ($currentObj->type == 'folder') {
                $path = $strFolder = str_replace($currentObj->name, '', $currentObj->path);

                $objFolder = new Folder($currentObj->path);

                $dirname = self::sanitizeName($objFolder->name);

                $objFolder->renameTo($path . $dirname);
            }
        }

        return true;
    }

    /**
     * @param string $filename
     * @param array $options
     *
     * @return string
     */
    public static function sanitizeName($filename, $options = [])
    {
        $generator = new SlugGenerator;

        return $generator->generate($filename, $options);
    }
}
