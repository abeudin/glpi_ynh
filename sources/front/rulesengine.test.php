<?php
/*
 * @version $Id: rulesengine.test.php 22657 2014-02-12 16:17:54Z moyo $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2014 by the INDEPNET Development Team.

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

/** @file
* @brief
*/

if (!defined('GLPI_ROOT')) {
   include ('../inc/includes.php');
}

Session::checkCentralAccess();

if (isset($_POST["sub_type"])) {
   $sub_type = $_POST["sub_type"];
} else if (isset($_GET["sub_type"])) {
   $sub_type = $_GET["sub_type"];
} else {
   $sub_type = 0;
}

$rulecollection = RuleCollection::getClassByType($sub_type);
if ($rulecollection->isRuleRecursive()) {
   $rulecollection->setEntity($_SESSION['glpiactive_entity']);
}
$rulecollection->checkGlobal('r');

if (!strpos($_SERVER['PHP_SELF'],"popup")) {
   Html::header(__('Setup'),$_SERVER['PHP_SELF'],"config","display");
}

// Need for RuleEngines
foreach ($_POST as $key => $val) {
   $_POST[$key] = stripslashes($_POST[$key]);
}
$input = $rulecollection->showRulesEnginePreviewCriteriasForm($_SERVER['PHP_SELF'], $_POST);

if (isset($_POST["test_all_rules"])) {
   //Unset values that must not be processed by the rule
   unset($_POST["sub_type"]);
   unset($_POST["test_all_rules"]);

   echo "<br>";
   $rulecollection->showRulesEnginePreviewResultsForm($_SERVER['PHP_SELF'], $_POST);
}

if (!strpos($_SERVER['PHP_SELF'],"popup")) {
   Html::footer();
}
?>