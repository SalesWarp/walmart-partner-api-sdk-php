<?php
namespace Walmart;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Partial Walmart API client implemented with Guzzle.
 *
 * @method  array list(array $config = [])
 * @method array get(array $config = [])
 * @method array acknowledge(array $config = [])
 */
class Order extends BaseClient
{
    const STATUS_CREATED = 'Created';
    const STATUS_ACKNOWLEDGED = 'Acknowledged';
    const STATUS_SHIPPED = 'Shipped';
    const STATUS_CANCELLED = 'Cancelled';

    const CANCEL_REASON = 'CUSTOMER_REQUESTED_SELLER_TO_CANCEL';

    public $wmConsumerChannelType;

    /**
     * @param array $config
     * @param string $env
     * @throws \Exception
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        if ( ! isset($config['wmConsumerChannelType'])) {
            throw new \Exception('wmConsumerChannelType is required in configuration for Order APIs', 1467486702);
        }

        $this->wmConsumerChannelType = $config['wmConsumerChannelType'];

        // Apply some defaults.
        $config = array_merge_recursive($config, [
            'description_path' => __DIR__ . '/descriptions/order.php',
            'http_client_options' => [
                'defaults' => [
                    'headers' => [
                        'WM_CONSUMER.CHANNEL.TYPE' => $this->wmConsumerChannelType,
                    ],
                ],
            ],
        ]);

        // Create the client.
        parent::__construct(
            $config,
            $env
        );

    }

    public function __call($name, array $arguments)
    {
        /*
         * Overriding call to list() since I cannot define a method with the same name as a reserved keyword.
         */
        if ($name === 'list') {
            return $this->listAll($arguments[0]);
        }
        return parent::__call($name, $arguments);
    }

    /**
     * List released orders
     * @param array $config
     * @return array
     * @throws \Exception
     */
    public function listReleased(array $config = [])
    {
        try {
            return $this->privateListReleased($config);
        } catch (\Exception $e) {
            if ($e instanceof RequestException) {
                /*
                 * ListReleased and List return 404 error if no results are found, even for successful API calls,
                 * So if result status is 404, transform to 200 with empty results.
                 */
                /** @var ResponseInterface $response */
                $response = $e->getResponse();
                if (strval($response->getStatusCode()) === '404') {
                    return [
                        'statusCode' => 200,
                        'list' => [
                            'meta' => [
                                'totalCount' => 0
                            ]
                        ],
                        'elements' => []
                    ];
                }
                throw $e;
            } else {
                throw $e;
            }
        }
    }

    /**
     * List all orders
     * @param array $config
     * @return array
     * @throws \Exception
     */
    public function listAll(array $config = [])
    {
        try {
            return $this->privateList($config);
        } catch (\Exception $e) {
            if ($e instanceof RequestException) {
                /*
                 * ListReleased and List return 404 error if no results are found, even for successful API calls,
                 * So if result status is 404, transform to 200 with empty results.
                 */
                /** @var ResponseInterface $response */
                $response = $e->getResponse();
                if (strval($response->getStatusCode()) === '404') {
                    return [
                        'statusCode' => 200,
                        'list' => [
                            'meta' => [
                                'totalCount' => 0
                            ]
                        ],
                        'elements' => []
                    ];
                }
                throw $e;
            } else {
                throw $e;
            }
        }
    }


    /**
     * Cancel an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function cancel($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480746);
        }

        return $this->cancelOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => json_encode($order),
        ]);
    }

    /**
     * Ship an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function ship($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480750);
        }

        return $this->shipOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => json_encode($order),
        ]);
    }

    /**
     * Refund an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function refund($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480783);
        }

        return $this->refundOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => json_encode($order),
        ]);
    }
}