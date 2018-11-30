<?php

/*
 * filename sanitizer extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2018, Christian Barkowsky
 * @author     Christian Barkowsky <https://christianbarkowsky.de>
 * @license    LGPL-3.0-or-later
 * @link       https://github.com/christianbarkowsky/contao-filename-sanitizer
 */

$GLOBALS['TL_DCA']['tl_files']['list']['operations']['sanitizer'] = [
    'label'               => &$GLOBALS['TL_LANG']['tl_files']['sanitizer'],
    'href'                => 'do=files&key=sanitizer',
    'icon'                => 'system/modules/sanitizer/assets/icon.png',
    'button_callback'     => ['tl_estao_files', 'runSanitizer']
];


class tl_estao_files extends Backend
{

    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return the sanitizer button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function runSanitizer($row, $href, $label, $title, $icon, $attributes)
    {
        if (!$this->User->hasAccess('f5', 'fop')) {
            return '';
        }

        $strDecoded = rawurldecode($row['id']);

        if (!is_dir(TL_ROOT . '/' . $strDecoded)) {
            return '';
        }

        return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title, false, true).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }
}
