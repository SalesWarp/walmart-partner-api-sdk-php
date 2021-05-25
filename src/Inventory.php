<?php
namespace Walmart;

/**
 * Partial Walmart API client implemented with Guzzle.
 *
 * @method array get(array $config = [])
 */
class Inventory extends BaseClient
{
    /**
     * @param array $config
     * @param string $env
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/inventory.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $env
        );

    }

    /**
     * @param array $inventory
     * @return array
     * @throws \Exception
     */
    public function update($inventory)
    {

        if ( ! is_array($inventory)) {
            throw new \Exception('Inventory must be an array', 1470529303);
        }

        if ( ! isset($inventory['inventory']['sku'])) {
            throw new \Exception("The element ['inventory']['sku'] must be set", 1470529425);
        }

        return $this->updateInventory([
            'sku' => $inventory['inventory']['sku'],
            'inventory' => json_encode($inventory),
        ]);

    }

    /**
     * @param array $items
     * @return array
     * @throws \Exception
     */
    public function bulk($items)
    {
        if ( ! is_array($items)) {
            throw new \Exception('Items is not an array', 14663491774);
        }

        return $this->bulkUpdate([
            'file' => json_encode($items),
        ]);
    }
}