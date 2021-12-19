<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.js_maxlength.php 78605 2021-07-05 14:54:45Z rjsmelo $

/**
 * \brief Smarty {js_maxlength} function handler
 *
 * Creates javascript to add 'maxlength' functionality to a <textbox>
 * Usage:
 * {js_maxlength textarea=[string] maxlength=[int]}
 *
 * TODO would be great if it worked with array arguments
 *
 */

function smarty_function_js_maxlength($params, $smarty)
{
    extract($params); // textarea=string maxlength=num

    echo "\n<script type=\"text/javascript\">\n";
    echo "<!--\n";

    echo "function verifyForm(f){\n";
    echo " var rtn=true;\n";
    echo "  if ( f.$textarea.value.length > $maxlength ) {\n";
    echo "    alert('" . tra("The text is") . " ' + (f.$textarea.value.length - $maxlength) + ' " . tra("character(s) too long - please edit it.") . "');\n";
    echo "    rtn = false;\n";
    echo "  }\n";
    echo "  return rtn;\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n";
}
