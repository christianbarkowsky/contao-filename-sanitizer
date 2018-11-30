<?php

/*
 * filename sanitizer extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Christian Barkowsky
 * @author     Christian Barkowsky <https://christianbarkowsky.de>
 * @license    LGPL-3.0-or-later
 * @link       https://github.com/christianbarkowsky/contao-filename-sanitizer
 */

$GLOBALS['BE_MOD']['system']['files']['sanitizer'] = ['ChristianBarkowsky\Sanitizer\Backend', 'runSanitizer'];
