<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\openWheather;

$app->get('/', function (Request $request, Response $response) {

    // fetch all rows as collection
    $city_name = $this->db->table('favourites')->select('city_name')->get()->toArray();

    $ow = new openWheather();

    $favourites = $ow->searchByIds(array_column($city_name, 'city_name'));

    $viewData = [
        'favourites' => $favourites
    ];


    return $this->get('view')->render($response, 'home.twig', $viewData);
})->setName('home');

$app->post('/city', function (Request $request, Response $response) {

    $ow = new openWheather();

    $weather = $ow->searchByName($request->getParam('city'));

    $viewData = [
        'weather' => $weather
    ];

    return $this->get('view')->render($response, 'city.twig', $viewData);

})->setName('city');

$app->get('/city/{city}', function (Request $request, Response $response) {

    $ow = new openWheather();

    $weather = $ow->searchByName($request->getAttribute('city'));

    $viewData = [
        'weather' => $weather
    ];

    return $this->get('view')->render($response, 'city.twig', $viewData);

})->setName('city');

$app->get('/city/add/{city_name}', function (Request $request, Response $response) {

    try{
        $this->db->table('favourites')->insert(['city_name' => $request->getAttribute('city_name')]);
    }catch (Exception $e){
        $viewData = [
            'message' => $e
        ];
        return $this->get('view')->render($response, 'error.twig', $viewData);
    }

    return $this->response->withRedirect('/');
});

$app->get('/city/remove/{city_name}', function (Request $request, Response $response) {

    try{
        $this->db->table('favourites')->where('city_name', '=', $request->getAttribute('city_name'))->delete();
    }catch (Exception $e){
        $viewData = [
            'mesasge' => $e
        ];
        return $this->get('view')->render($response, 'error.twig', $viewData);
    }

    return $this->response->withRedirect('/');
});
