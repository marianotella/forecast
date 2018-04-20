<?php
/**
 * Created by PhpStorm.
 * User: mtellaeche
 * Date: 19/04/18
 * Time: 11:41
 */

namespace App;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;


class openWheather
{
    protected $own;

    /**
     * openWheather constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->owm = new OpenWeatherMap('5660a233b8792be95c5e75b3c93d1de4');
    }


    public function searchByName($str){
        try {
            $weather = $this->owm->getWeather($str, 'metric', 'es');
        } catch(OWMException $e) {
            echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
        } catch(\Exception $e) {
            echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
        }

        return $weather;
    }

    public function searchByIds(array $array){
        $weather = [];
        foreach($array as $arr){
            try {
                $weather[] = $this->owm->getWeather($arr, 'metric', 'es');
            } catch(OWMException $e) {
                echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
            } catch(\Exception $e) {
                echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
            }

        }

        return $weather;
    }


}