<?php
header('Content-Type:  application/xml');

  $optional_headers = null;
  $url='https://user:password@url/rest/tag/list?includeInheritedTags=True';
  $data='<taggablereference domain="Measurement" obid="126095"/>';
  
  $params = array(
              "ssl" =>array(
                  "verify_peer"=>false,
                  "verify_peer_name"=>false,
              ),
              'http' => array(
                  'method' => 'POST',
                  'content' => $data,
                  'header'=> "Content-Type: application/xml\r\n"
                  //с куками
                  /*'header'=> "Content-Type: application/xml\r\n" . 
                              "Cookie: JSESSIONID=xgDZK8y97ee8FuOu69lHRpdaKNuU3gC_j3lKAO8k.stablenetapp; PHPSESSID=hfgk1bn7ou2sd41svhs036ppip; JSESSIONIDSSO=2XHojnfc2mfH6qtmyR79SCE-hgndO93zqnqlSHhs; JSESSIONID=oa3lzN9LyTOQ-Kdc27R4MN6h0tKfXdDyy7X9t-tq.stablenetapp\r\n"*/

            ));
  $ctx = stream_context_create($params);
  $fp = fopen($url, 'r', false, $ctx);
  $contents = stream_get_contents($fp);
  fclose($fp);
  //echo $contents;

  $xml = simplexml_load_string($contents);
  echo $xml->asXML();
  //var_dump($xml);
  

  //fpassthru($fp);
  //var_dump($fp);