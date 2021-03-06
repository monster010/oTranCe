<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Human readable byte output
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_ByteOutput extends Zend_View_Helper_Abstract
{
    /**
     * Humanize byte output
     *
     * @param int  $bytes     Bytes to represent
     * @param int  $precision Precision to use
     * @param bool $useHtml   Whether to add HTML spans of css class "explain"
     *
     * @return string|float
     */
    public function byteOutput($bytes, $precision = 2, $useHtml = true)
    {
        $unitsLong = array('Bytes', 'KiloBytes', 'MegaBytes', 'GigaBytes',
            'TeraBytes', 'PetaBytes', 'ExaBytes', 'YottaBytes');
        $unitsShort = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB');
        for ($level = 0; $bytes >= 1024; $level++) {
            $bytes /= 1024;
        }
        if (!is_numeric($bytes) || !isset($unitsShort[$level])) {
            return $bytes;
        }
        $pattern = '<span class="explain" title="%s">%s</span>';
        $suffix = sprintf($pattern, $unitsLong[$level], $unitsShort[$level]);
        if (!$useHtml) {
            $suffix = strip_tags($suffix);
        }
        $ret = sprintf("%01." . $precision . "f", round($bytes, $precision));
        return  trim($ret . ' ' . $suffix);
    }

}
