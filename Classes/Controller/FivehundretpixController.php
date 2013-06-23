<?php
namespace TYPO3\Fivehundretpix\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package bsauser
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FivehundretpixController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	private $five00Px;

	function __construct(){
		require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath("fivehundretpix")."Classes/Api/Five00PxPubClient.php");
		// API options
		$options = array(
			'key' => 'rz5QRsX4naJhxpTdvIw5DJdTCkgicJive9KMiRWR',
			'secret' => '',
		);

		// Initialize Cient
		$this->five00Px = \TYPO3\Fivehundretpix\Api\Five00PxPubClient::factory($options);
	}



	public function userAction(){
		// Search Params for the Photo
		$params = array (
			"feature" => "user",
			'username'	=> 'thephpjo',
			'rpp'	=> 15,
			"image_size"	=> 3,
		);

		// Do the API call
		try {
			$photos = $this->five00Px->api('photos', $params);
		} catch(Exception $e) {
			$this->flashMessageContainer->add('Error in call ' . $e->getMessage());
		}


		$this->view->assign("photos",$photos->photos);
	}
}