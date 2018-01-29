<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    MonitoringScanClientWorkerUpdateContaoVersion
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Monitoring;

/**
 * Class MonitoringScanClientWorkerUpdateContaoVersion
 *
 * Contains functions to update the system field.
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class MonitoringScanClientWorkerUpdateContaoVersion extends \Backend
{
  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Update the system field
   */
  public function updateContaoVersion($objMonitoringEntry, $response)
  {
    if (in_array("MonitoringClientSensorContao", explode(", ", $response['monitoring.client.sensors'])) && !empty($response['contao.version']))
    {
      $strSystemEntry = sprintf(\Config::get('monitoringScanClientWorkerUpdateContaoVersionFormat'), $response['contao.version']);
      if ($objMonitoringEntry->system != $strSystemEntry)
      {
        $objVersions = new \Versions('tl_monitoring', $objMonitoringEntry->id);
        $this->import('BackendUser', 'User');
        // for CRON based execution we need to set a system user
        if (empty($this->User->id) || empty($this->User->username))
        {
          $objVersions->setUserId(0);
          $objVersions->setUsername("ContaoMonitoringSystem");
        }
        $objVersions->initialize();
        
        $objMonitoringEntry->system = $strSystemEntry;
        $objMonitoringEntry->save();
        
        $objVersions->create(); 
      
        $this->logDebugMsg("Updated the system field of monitoriong entry ID " . $objMonitoringEntry->id . " to '" . $strSystemEntry . "'.", __METHOD__);
      }
    }
    else
    {
      $this->logDebugMsg("No Contao version for updating the system field of monitoriong entry ID " . $objMonitoringEntry->id . " transferred.", __METHOD__);
    }
  }
  
  /**
   * Logs the given message if the debug mode is anabled.
   */
  private function logDebugMsg($msg, $origin)
  {
    if (\Config::get('monitoringDebugMode') === TRUE)
    {
      $this->log($msg, $origin, TL_INFO);
    }
  }
}

?>