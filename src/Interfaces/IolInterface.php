<?php

namespace Cirote\Estrategias\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class IolInterface
{
	const URL_LOGIN = 'https://api.invertironline.com/token';

	const CACHE_NAME = 'iol_token';

	private $cliente;

	private $token;

	public function __construct()
	{
		$this->cliente = new \GuzzleHttp\Client();
	}

    public function __invoke()
    {
    	dd(
    		$this->getAcciones()
    	);
    }

    public function getAcciones()
    {
    	return $this->getPanel('acciones', 'Merval');
	}

    private function getCalls()
    {
    	return $this->getPanel('opciones', 'Calls');
	}

    private function getPuts()
    {
    	return $this->getPanel('opciones', 'Puts');
	}

    public function getOpciones()
    {
    	return $this->getPanel('opciones', 'Todas');
	}

    private function getPanel($tipoActivo, $panel)
    {
    	$parametros = [
		    'headers' => [
		        'Authorization' => 'Bearer ' . $this->getTokenDeAcceso()
		    ],
		    'form_params' => [
		        'panelCotizacion.instrumento' => $tipoActivo,
		        'panelCotizacion.panel' => $panel,
		        'panelCotizacion.pais' => 'argentina',
		        'api_key' => $this->getTokenDeAcceso()
			]
        ];

		$url = "https://api.invertironline.com/api/v2/Cotizaciones/{$tipoActivo}/{$panel}/argentina";

		$response = $this->cliente->get($url, $parametros);

		if ($response->getStatusCode() == 200)
		{
			return json_decode((string) $response->getBody(), true)['titulos'];
		}

		dd("Error leyendo informacion del panel [{$panel}]");
	}

    private function getTokenDeAcceso()
    {
    	if ($this->tokenDeAccesoVencido())
    	{
    		Cache::forget(static::CACHE_NAME);
    	}

		return $this->getDatosToken()['access_token'];
	}

    private function renovarTokenDeAcceso()
    {
    	if ($this->tokenDeRenovacionVencido())
    	{
    		Cache::forget(static::CACHE_NAME);
    	}

		Cache::forget(static::CACHE_NAME);
	}

    private function tokenDeAccesoVencido()
    {
		return $this->getFechaDeExpiracion()->lessThan(Carbon::now());
	}

    private function getTokenDeRenovacion()
    {
		return $this->getDatosToken()['refresh_token'];
	}

    private function tokenDeRenovacionVencido()
    {
		return $this->getFechaDeExpiracionDelTokenDeRenovacion()->lessThan(Carbon::now());
	}

    private function getFechaDeEmision()
    {
    	return $this->getFecha(".issued");
    }

    private function getFechaDeExpiracion()
    {
    	return $this->getFecha(".expires");
    }

    private function getFechaDeExpiracionDelTokenDeRenovacion()
    {
    	return $this->getFecha(".refreshexpires");
    }

    private function getFecha($campo)
    {
    	return Carbon::createFromFormat(Carbon::RFC7231_FORMAT, $this->getDatosToken()[$campo]);
    }

    private function getDatosToken()
    {
		$t = cache()->remember(static::CACHE_NAME, 10 * 60 * 60, function () 
		{
		    return $this->login();
		});

    	return $this->token = json_decode($t, true);
    }

	private function login()
	{
		$parametros = [
		    'headers' => [
		        'Content-Type' => 'application/x-www-form-urlencoded',
		    ],
		    'form_params' => [
		        'username' => env('IOL_USER'),
		        'password' => env('IOL_PASSWORD'),
		        'grant_type' => 'password'
			]
        ];

		$response = $this->cliente->post(static::URL_LOGIN, $parametros);

		if ($response->getStatusCode() == 200)
		{
			return (string) $response->getBody();
		}

		dd('Error en IOL API');
	}
}