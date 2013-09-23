<?php
/**
 * Copyright (c) 2013, Pellaeon Lin <pellaeon@hs.ntnu.edu.tw>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */

OC_Util::checkAdminUser();
OCP\JSON::callCheck();

$filtered = preg_replace('\s*', ' ', trim($_POST['allowedDomain']));
OC_Config::setValue( 'registration_allowed_domain', $filtered);

echo 'true';
