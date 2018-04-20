<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\openWheather;

$app->get('/', function (Request $request, Response $response) {

    // fetch all rows as collection
    $city_id = $this->db->table('favourites')->select('city_id')->get()->toArray();

    $ow = new openWheather();

    $favourites = $ow->searchByIds(array_column($city_id, 'city_id'));

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

$app->get('/city/add/{city_id}', function (Request $request, Response $response) {

    $this->db->table('favourites')->insert(['city_id' => $request->getAttribute('city_id')]);

    return $this->response->withRedirect('/');
});

$app->get('/city/remove/{city_id}', function (Request $request, Response $response) {

    $this->db->table('favourites')->where('city_id', '=', $request->getAttribute('city_id'))->delete();

    return $this->response->withRedirect('/');
});
