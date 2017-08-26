<?php
  require '../application/libraries/bca-finhacks-2017.phar';

  try {
    // Using the library to do API request
    $builder = new \Bca\Api\Sdk\BusinessBanking\BusinessBankingApiConfigBuilder();
    $builder->baseApiUri('https://api.finhacks.id');
    $builder->baseOAuth2Uri('https://api.finhacks.id');
    $builder->clientId('563f6545-65ee-4a73-80c1-9e7fd3660151');
    $builder->clientSecret('f69ca776-b884-4f82-800d-9e85eed61a08');
    $builder->apiKey('96950593-6d36-4d2b-923a-70afb26584ab');
    $builder->apiSecret('1913f606-dfde-425a-a995-ebe38f20f732');
    $builder->origin('182.16.165.88');
    $builder->corporateID('finhacks13');
    
    $config = $builder->build();
    
    $businessBankingApi = new \Bca\Api\Sdk\BusinessBanking\BusinessBankingApi($config);

    $response = $businessBankingApi->getBalance(['8220000053']);
    
    $result = array();
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

    echo json_encode($result);
  } catch (\Bca\Api\Sdk\Common\Exceptions\ApiRequestException $e) {
    // the API response with non 2xx http status code
    echo $e->getBody()->getErrorCode();
    echo $e->getBody()->getErrorMessage()->getEnglish();
    echo $e->getBody()->getErrorMessage()->getIndonesian();
  }
?>