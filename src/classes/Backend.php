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

use Contao\Input;
use Contao\Controller;
use Contao\Backend as ContaoBackend;

class Backend extends ContaoBackend
{

    public function runSanitizer()
    {
        if (Input::get('key') != 'sanitizer') {
            return '';
        }

        Sanitizer::run(Input::get('id'));

        Controller::redirect('contao/main.php?do=files');
    }
}
