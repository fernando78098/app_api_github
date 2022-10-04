<?php

namespace App\Services;

use App\Models\Configuration;
use App\Models\Package;
use App\Models\User;
use Appstract\Opcache\Http\Middleware\Request;
use GuzzleHttp\Client as HttpClient;;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;

class GithubApiService
{
    /**
     * Boot HTTP Client
     *
     * @return \GuzzleHttp\Client
     */
    public static function bootClient()
    {
        return new HttpClient([
            'base_uri' => config('github.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Posts data to the API
     *
     * @return \StdClass
     */
    public static function getUsers()
    {
        try {
            $request = self::bootClient()->get('/users');
            $response_body = (string) $request->getBody();
            $response = json_decode($response_body);

            if (empty($response) || (isset($response->status) && $response->status === 'Erro')) {
                Log::info('Erro - Requisição: Users - Resposta: ' . $response_body);
                return false;
            }

        } catch (ServerException $e) {
            Log::emergency(
                'Error EMERGENCIAL API GitHub' . $e->getCode()
                . ' - request: ' . (string) $e->getRequest()->getBody()
                . ' - response: ' . (string) $e->getResponse()->getBody()
            );
            return false;
        } catch (RequestException $e) {
            Log::info(
                'Error API GitHub '. $e->getCode()
                . ' - request: ' . Request()->getHost()
                . ' - response: ' . Request()->getHost()
            );
            return false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return $response;
    }

    /**
     * Translates a customer model into a Tiny customer
     *
     * @param  $customer
     * @return  array
     */
    public function getUser($user)
    {
        try {
            $request = self::bootClient()->get('/users/' . $user);
            $response_body = (string) $request->getBody();
            $response = json_decode($response_body);

            if (empty($response) || (isset($response->status) && $response->status === 'Erro')) {
                Log::info('Erro - Requisição: Users - Resposta: ' . $response_body);
                return false;
            }

        } catch (ServerException $e) {
            Log::emergency(
                'Error EMERGENCIAL API GitHub' . $e->getCode()
                . ' - request: ' . (string) $e->getRequest()->getBody()
                . ' - response: ' . (string) $e->getResponse()->getBody()
            );
            return false;
        } catch (RequestException $e) {
            Log::info(
                'Error API GitHub '. $e->getCode()
                . ' - request: ' . Request()->getHost()
                . ' - response: ' . Request()->getHost()
            );
            return false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return $response;
    }
}
