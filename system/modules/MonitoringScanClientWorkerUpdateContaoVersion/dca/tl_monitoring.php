<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2018 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2018-2018
 * @author     Cliff Parnitzky
 * @package    MonitoringScanClientWorkerUpdateContaoVersion
 * @license    LGPL
 */

/**
 * Modify fields
 */
$GLOBALS['TL_DCA']['tl_monitoring']['fields']['system']['eval']['tl_class'] = $GLOBALS['TL_DCA']['tl_monitoring']['fields']['system']['eval']['tl_class'] . ' wizard';
$GLOBALS['TL_DCA']['tl_monitoring']['fields']['system']['wizard'][] = array('tl_monitoring_MonitoringScanClientWorkerUpdateContaoVersion', 'showSystemUpdateHistory');

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_monitoring']['fields']['systemUpdateHistory'] = array
(
    'sql'                     => "blob NULL"
);

/**
 * Class tl_monitoring_MonitoringScanClientWorkerUpdateContaoVersion
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2018-2018
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_monitoring_MonitoringScanClientWorkerUpdateContaoVersion extends Backend
{
  /**
   * Default constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Return the link for showing the system update history
   *
   * @param DataContainer $dc
   *
   * @return string
   */
  public function showSystemUpdateHistory(DataContainer $dc)
  {
    $arrSystemUpdateHistory = deserialize($dc->activeRecord->systemUpdateHistory, true);
    if (empty($arrSystemUpdateHistory))
    {
      return ' ' . Image::getHtml('system/modules/MonitoringScanClientWorkerUpdateContaoVersion/assets/icon_systemUpdateHistory_.png', specialchars($GLOBALS['TL_LANG']['tl_monitoring']['systemUpdateHistory_buttonInactive']), 'title="' . specialchars($GLOBALS['TL_LANG']['tl_monitoring']['systemUpdateHistory_buttonInactive']) . '" style="margin-left: 2px;margin-top: 2px;vertical-align:top;cursor:not-allowed"') . '</a>';
    }
    
    /** @var \BackendTemplate|object $objTemplate */
    $objTemplate = new \BackendTemplate('be_systemUpdateHistory');
    $objTemplate->systemUpdateHistory = $arrSystemUpdateHistory;

    return ' <a title="' . specialchars($GLOBALS['TL_LANG']['tl_monitoring']['systemUpdateHistory_buttonActive']) . '" onclick="Backend.getScrollOffset();Backend.openModalWindow(768, \'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['tl_monitoring']['systemUpdateHistory_dialogTitle'])) . '\',\'' . specialchars(str_replace(array("'", "\r\n", "\n", "\r"), array("\\'", "", "", "", ""), $objTemplate->parse())) . '\');return false">' . Image::getHtml('system/modules/MonitoringScanClientWorkerUpdateContaoVersion/assets/icon_systemUpdateHistory.png', specialchars($GLOBALS['TL_LANG']['tl_monitoring']['systemUpdateHistory_buttonActive']), 'style="margin-left: 2px;margin-top: 2px;vertical-align:top;cursor:pointer"') . '</a>';
  }
}

?>