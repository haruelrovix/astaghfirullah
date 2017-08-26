<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require '../../../bca-finhacks-2017.phar';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Balance extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    // Get balance from account number
    function index_get() {
      $id = $this->get('id');
      $result = array();

      try {
        // Using the library to do API request
        $builder = new \Bca\Api\Sdk\BusinessBanking\BusinessBankingApiConfigBuilder();
        $builder->baseApiUri('https://api.finhacks.id');
        $builder->baseOAuth2Uri('https://api.finhacks.id');
        $builder->clientId('00a2cecf-57a9-495d-b337-05379481cea2');
        $builder->clientSecret('90f866f0-0bb1-419f-bfcc-abd3ce65d0e1');
        $builder->apiKey('1b6e44be-df70-4013-8a75-3d7abd2a8046');
        $builder->apiSecret('60766ed9-2480-4f47-ab3f-68a5a719b54d');
        $builder->origin('182.16.165.88');
        $builder->corporateID('finhacks01');

        $config = $builder->build();

        $businessBankingApi = new \Bca\Api\Sdk\BusinessBanking\BusinessBankingApi($config);

        $response = $businessBankingApi->getBalance([$id]);

        foreach ($response->getAccountDetailDataSuccess() as $data) {
          $item = array(
            'AccountNumber' => $data->getAccountNumber(),
            'Currency' => $data->getCurrency(),
            'Balance' => $data->getBalance(),
            'AvailableBalance' => $data->getAvailableBalance(),
            'FloatAmount' => $data->getFloatAmount(),
            'HoldAmount' => $data->getHoldAmount(),
            'Plafon' => $data->getPlafon()
          );
          array_push($result, $item);
        }

      } catch (\Bca\Api\Sdk\Common\Exceptions\ApiRequestException $e) {
        // the API response with non 2xx http status code
        $item = array(
          'ErrorCode' => $e->getBody()->getErrorCode(),
          'English' => $e->getBody()->getErrorMessage()->getEnglish(),
          'Indonesian' => $e->getBody()->getErrorMessage()->getIndonesian()
        );
        array_push($result, $item);
      }

      $this->response(json_encode($result), 200);
  }

}
