<?php return [
    'baseUri' => 'https://marketplace.walmartapis.com',
    'apiVersion' => 'v3',
    'operations' => [
        'PrivateListReleased' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/orders/released{+nextCursor}',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'limit' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                    'maximum' => 10,
                ],
                'createdStartDate' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'nextCursor' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'uri',
                ],

            ]
        ],
        'PrivateList' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/orders{+nextCursor}',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'sku' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'customerOrderId' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'purchaseOrderId' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'status' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'createdStartDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'createdEndDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'fromExpectedShipDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'toExpectedShipDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'limit' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                    'maximum' => 10,
                ],
                'nextCursor' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'lastModifiedStartDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'lastModifiedEndDate' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'productInfo' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'shipNodeType' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'shippingProgramType' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'replacementInfo' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'orderType' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ]
        ],
        'Get' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/orders/{purchaseOrderId}',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'purchaseOrderId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ],
        ],
        'Acknowledge' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/orders/{purchaseOrderId}/acknowledge',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'purchaseOrderId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/json',
                ],
            ],
        ],
        'CancelOrder' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/orders/{purchaseOrderId}/cancel',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/json',
                ],
                'purchaseOrderId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'order' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json',
                ],
            ],
        ],
        'ShipOrder' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/orders/{purchaseOrderId}/shipping',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/json',
                ],
                'purchaseOrderId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'order' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json',
                ],
            ],
        ],
        'RefundOrder' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/orders/{purchaseOrderId}/refund',
            'responseModel' => 'Result',
            'data' => [
                'xmlRoot' => [
                    'name' => 'orderRefund',
                ],
            ],
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'purchaseOrderId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/json',
                ],
                'order' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'body',
                ],
            ]
        ],
    ],
    'models' => [
        'Result' => [
            'type' => 'object',
            'properties' => [
                'statusCode' => ['location' => 'statusCode'],
            ],
            'additionalProperties' => [
                'location' => 'json'
            ],
        ]
    ]

];
