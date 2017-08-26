<?php
  require '../application/libraries/bca-finhacks-2017.phar';

  $result = array();
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

    $payload = new \Bca\Api\Sdk\BusinessBanking\Models\Requests\TransferPayload();
    $payload->setSourceAccountNumber($_GET['source']);
    // $payload->setTransactionID('00000004');
    $payload->setTransactionDate(date('Y-m-d'));
    $payload->setReferenceID('12345/PO/2017');
    $payload->setCurrencyCode('IDR');
    $payload->setAmount($_GET['amount']);
    $payload->setBeneficiaryAccountNumber($_GET['destination']);
    $payload->setRemark1(':');
    // $payload->setRemark2('Online Transfer');
    
    $response = $businessBankingApi->transferFund($payload);
    
    $result = array(
      'TransactionID'=> $response->getTransactionID(),
      'TransactionDate'=> $response->getTransactionDate(),
      'ReferenceID'=> $response->getReferenceID(),
      'Status'=> $response->getStatus()
    );
  } catch (\Bca\Api\Sdk\Common\Exceptions\ApiRequestException $e) {
    // the API response with non 2xx http status code
    $result = array(
      'ErrorCode' => $e->getBody()->getErrorCode(),
      'English' => $e->getBody()->getErrorMessage()->getEnglish(),
      'Indonesian' => $e->getBody()->getErrorMessage()->getIndonesian()
    );
  }
  
  echo json_encode($result);
?>
