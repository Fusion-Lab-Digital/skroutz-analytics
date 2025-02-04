<?php
/**
 * Copyright (c) 2025 Fusion Lab G.P
 * Website: https://fusionlab.gr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace FusionLab\SkroutzAnalytics\Block;

use FusionLab\SkroutzAnalytics\Model\ConfigProvider;
use Magento\Csp\Helper\CspNonceProvider;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Psr\Log\LoggerInterface;

class Success extends AbstractSkroutz
{

    protected $_template = 'FusionLab_SkroutzAnalytics::success.phtml';

    private CollectionFactory $salesOrderCollection;

    private LoggerInterface $logger;

    private ?string $productIdentifier;

    /**
     * @param CollectionFactory $salesOrderCollection
     * @param LoggerInterface $logger
     * @param ConfigProvider $configProvider
     * @param CspNonceProvider $cspNonceProvider
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CollectionFactory $salesOrderCollection,
        LoggerInterface $logger,
        ConfigProvider $configProvider,
        CspNonceProvider $cspNonceProvider,
        Template\Context $context,
        array $data = []
    ) {
        $this->salesOrderCollection = $salesOrderCollection;
        $this->logger = $logger;
        $this->productIdentifier = $configProvider->getProductIdentifier();
        parent::__construct($configProvider, $cspNonceProvider, $context, $data);
    }

    /**
     * @return array
     */
    public function getOrdersTrackingData(): array
    {
        $result = [];
        $orderIds = $this->getOrderIds(); // Set from observer.
        if (empty($orderIds) || !is_array($orderIds)) {
            return $result;
        }

        $collection = $this->salesOrderCollection->create();
        $collection->addFieldToFilter('entity_id', ['in' => $orderIds]);

        /** @var OrderInterface $order */
        foreach ($collection as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $result['products'][] = [
                    'name' => addslashes($item->getName()),
                    'order_id' => $order->getIncrementId(),
                    'price' => $item->getPrice(),
                    'product_id' => $this->getProductIdentifier($item),
                    'quantity' => (float) $item->getQtyOrdered(),
                ];
            }
            $result['orders'][] = [
                'order_id' => $order->getIncrementId(),
                'paid_by' => $this->getPaidBy($order),
                'paid_by_descr' => $this->getPaidByDescription($order),
                'revenue' => $order->getBaseGrandTotal(),
                'shipping' => $order->getShippingAmount(),
                'tax' => $order->getTaxAmount(),
            ];
        }//end foreach
        return $result;
    }

    /**
     * @param OrderItemInterface $item
     * @return string
     */
    private function getProductIdentifier(OrderItemInterface $item): string
    {
        if ($this->productIdentifier === 'sku') {
            return $item->getSku();
        }
        return (string) $item->getProductId();
    }

    /**
     * @param OrderInterface $order
     * @return string
     */
    private function getPaidBy(OrderInterface $order): string
    {
        $result = '';

        try {
            $result = $order->getPayment()->getMethodInstance()->getTitle();
        } catch (LocalizedException $e) {
            $this->logger->critical($e);
        }

        return $result;
    }

    /**
     * @param OrderInterface $order
     * @return string
     */
    private function getPaidByDescription(OrderInterface $order): string
    {
        $result = '';

        if ($order->getPayment()) {
            $result = $order->getPayment()->getMethod();
        }

        return $result;
    }
}
