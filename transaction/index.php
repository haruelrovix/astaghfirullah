<?php
  require '../libraries/bca-finhacks-2017.phar';

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

    $params = new \Bca\Api\Sdk\BusinessBanking\Models\Requests\StatementParams();
    $startDate = $_GET['start'];
    if(!$startDate) {
      $startDate = '2017-08-20';
    }
    $endDate = $_GET['end'];
    if(!$endDate) {
      $endDate = '2017-08-28';
    }
    $params->setStartDate($startDate);
    $params->setEndDate($endDate);

    $accountNumber = $_GET['account'];
    $response = $businessBankingApi->getStatement($accountNumber, $params);

    $transactions = array();
    foreach ($response->getData() as $data) {
      $item = array(
        'TransactionDate' => $data->getTransactionDate(),
        'BranchCode' => $data->getBranchCode(),
        'TransactionType' => $data->getTransactionType(),
        'TransactionAmount' => $data->getTransactionAmount(),
        'TransactionName' => $data->getTransactionName(),
        'Trailer' => $data->getTrailer()
      );
      array_push($transactions, $item);
    }

    $result = array(
      'StartDate' => $response->getStartDate(),
      'EndDate' => $response->getEndDate(),
      'Currency' => $response->getCurrency(),
      'StartBalance' => $response->getStartBalance(),
      'Data' => $transactions
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
