<?php

/*
 * filename sanitizer extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Christian Barkowsky
 * @author     Christian Barkowsky <https://christianbarkowsky.de>
 * @license    LGPL-3.0-or-later
 * @link       https://github.com/christianbarkowsky/contao-filename-sanitizer
 */

\Contao\ClassLoader::addNamespace('ChristianBarkowsky');

ClassLoader::addClasses([
    'ChristianBarkowsky\Sanitizer\Backend' => 'system/modules/sanitizer/classes/Backend.php',
    'ChristianBarkowsky\Sanitizer\Sanitizer' => 'system/modules/sanitizer/classes/Sanitizer.php',
]);
