<?php

namespace Drupal\cnect_geocoder\Plugin\Geocoder\Provider;

use Drupal\geocoder\ProviderBase;
use function GuzzleHttp\uri_template;
use Drupal\geocoder\ProviderUsingHandlerWithAdapterBase;

/**
 * Provides a Ec Webtools Geogoder provider plugin.
 *
 * @GeocoderProvider(
 *   id = "CnectGeocoder",
 *   name = "CnectGeocoder",
 *   handler = "\OpenEuropa\Provider\WebtoolsGeocoding\WebtoolsGeocoding"
 * )
 */
class CnectGeocoder extends ProviderUsingHandlerWithAdapterBase {

  public function doGeocode($source) {

    try {
      $chars = [" ", ","];
      $query = trim(str_replace($chars, '+', $source));
      $url = "http://europa.eu/webtools/rest/geocoding/?address=" . $query;

      $request = \Drupal::httpClient()->get($url, array('headers' => array('Accept' => 'application/json')));
      $response = json_decode($request->getBody());
      $data = $response->geocodingRequestsCollection[0];

      if ($data->responseCode !== 200) {
        $args = array(
          '@code' => $response->responseCode,
          '@error' => $response->responseMessage,
        );
        $message = t('HTTP request to Webtools Geocoder API failed.\nCode: @code\nError: @error', $args);
        \Drupal::logger('ec_geocoder')->error($message);
      }

      if ($response->addressCount == 0) {
        $args = array('@status' => $data->status, '@address' => $source);
        $message = t('Webtools Geocoder API returned zero results on @address status.\nStatus: @status', $args);
        \Drupal::logger('ec_geocoder')->notice($message);
      }
      elseif (isset ($data->responseMessage) && $data->responseMessage != 'OK') {
        $args = array('@status' => $data->responseMessage);
        $message = t('Webtools Geocoder API returned bad status.\nStatus: @status', $args);
        \Drupal::logger('ec_geocoder')->warning($message);
      }

      $geometries = array();

      if (isset($data->result->features[0]->geometry->coordinates)) {
        $item = $data->result->features[0]->geometry->coordinates;
        $geom = new \Point($item[0], $item[1]);
        $geometries[] = $geom;
      }

      if (empty($geometries)) {
        return;
      }
      $geometry = array_shift($geometries);

      return $geometry;

    } catch (\Exception $e) {
      // Just rethrow the exception, the geocoder widget handles it.
      throw $e;
    }

  }

  public function doReverse($latitude, $longitude) {}

}
