<!DOCTYPE html>
<html>
<body>

<?php
  require 'bca-finhacks-2017.phar';

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

    echo "Before calling $response <br>";
    $response = $businessBankingApi->getBalance(['8220000011', '8220000118','1111111111']);
    // echo $response;

    foreach ($response->getAccountDetailDataSuccess() as $data) {
      echo $data->getAccountNumber().'<br>';
      echo $data->getCurrency().'<br>';
      echo $data->getBalance().'<br>';
      echo $data->getAvailableBalance().'<br>';
      echo $data->getFloatAmount().'<br>';
      echo $data->getHoldAmount().'<br>';
      echo $data->getPlafon().'<br>';
    }

    echo '<br>';
    foreach ($response->getAccountDetailDataFailed() as $data) {
      echo $data->getEnglish().'<br>';
      echo $data->getIndonesian().'<br>';
      echo $data->getAccountNumber().'<br>';
    }

  } catch (\Bca\Api\Sdk\Common\Exceptions\ApiRequestException $e) {
    // the API response with non 2xx http status code
    echo $e->getBody()->getErrorCode();
    echo $e->getBody()->getErrorMessage()->getEnglish();
    echo $e->getBody()->getErrorMessage()->getIndonesian();
  } catch (\Bca\Api\Sdk\Common\Exceptions\OAuth2Exception $e) {
    // error during access token request
    echo $e->getMessage();
  } catch (\Bca\Api\Sdk\Common\Exceptions\HttpRequestException $e) {
    // problem with http connection
    echo $e->getMessage();
  } catch (\Bca\Api\Sdk\Common\Exceptions\JsonParsingException $e) {
    // error when parsing payload to json
    echo $e->getMessage();
  } catch (\Exception $e) {
    // something else
  }
?>

</body>
</html>