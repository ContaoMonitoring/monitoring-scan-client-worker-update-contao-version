<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Monitoring',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Monitoring\MonitoringScanClientWorkerUpdateContaoVersion' => 'system/modules/MonitoringScanClientWorkerUpdateContaoVersion/classes/MonitoringScanClientWorkerUpdateContaoVersion.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_systemUpdateHistory' => 'system/modules/MonitoringScanClientWorkerUpdateContaoVersion/templates/backend',
));
