<?php
namespace Walmart\middleware;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use Walmart\Utils;
use phpseclib\Crypt\Random;

class AuthSubscriber implements SubscriberInterface
{
    public function getEvents()
    {
        return [
            // need to attach before request
            'before'   => ['addAuthHeaders', RequestEvents::PREPARE_REQUEST],
        ];
    }

    public function addAuthHeaders(BeforeEvent $event)
    {
        /*
         * Get Consumer ID and Private Key from auth and then unset it
         */
        $auth = $event->getClient()->getDefaultOption('auth');
        if ($auth === null) {
            throw new \Exception('Http client is missing \'auth\' parameters', 1466965269);
        }

        list($clientId, $clientSecret, $token) = $auth;

        $event->getClient()->setDefaultOption('auth', null);

        /*
         * Get Request URL, method, and timestamp to calculate signature
         */
        $requestUrl = $event->getRequest()->getUrl();

        //decode url back to normal to nextCursor issue. automatic url encoding
        $requestUrl = rawurldecode($requestUrl);
        $event->getRequest()->setUrl($requestUrl);

        // Deprecated code starts here
        // $requestMethod = $event->getRequest()->getMethod();
        // $timestamp = Utils::getMilliseconds();
        // $signature = Signature::calculateSignature($consumerId, $privateKey, $requestUrl, $requestMethod, $timestamp);
        // Deprecated code ends here
        
        // Code for v3 starts here
        $authorization = base64_encode(sprintf('%s:%s', $clientId, $clientSecret));

        /*
         * Add required headers to request
         */
        $headers = [
            'Authorization'         => 'Basic ' . $authorization,
            'WM_SVC.NAME'           => 'Walmart Marketplace',
            'WM_QOS.CORRELATION_ID' => base64_encode(Random::string(16)),
            'WM_SEC.ACCESS_TOKEN'   => $token,
        ];

        // Code for v3 end here
        $currentHeaders = $event->getRequest()->getHeaders();
        unset($currentHeaders['Authorization']);
        $updatedHeaders = array_merge($currentHeaders, $headers);
        $event->getRequest()->setHeaders($updatedHeaders);
    }

}
