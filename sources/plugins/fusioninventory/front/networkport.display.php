<?php
/*
 * @version $Id: networkport.display.php 18999 2012-07-25 07:18:31Z webmyster $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2012 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Walid Nouh
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('GLPI_ROOT')) {
   include ("../../../inc/includes.php");
}

// Manage for networkport display in networkequipment (glpi or fusion view
if (isset($_POST['selectview'])) {
   $_SESSION['plugin_fusioninventory_networkportview'] = $_POST['selectview'];
   Html::back();
}

if (isset($_POST["itemtype"])) {
   $itemtype = $_POST["itemtype"];
} else if (isset($_GET["itemtype"])) {
   $itemtype = $_GET["itemtype"];
} else {
   $itemtype = 0;
}

Session::checkRight('networking', READ);
Session::checkRight('internet', READ);
PluginFusioninventoryNetworkPort::showDislayOptions($itemtype);
Html::ajaxFooter();
?>
