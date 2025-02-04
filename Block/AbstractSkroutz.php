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
use Magento\Framework\View\Element\Template;

abstract class AbstractSkroutz extends Template
{

    protected ConfigProvider $configProvider;

    private CspNonceProvider $cspNonceProvider;

    /**
     * @param ConfigProvider $configProvider
     * @param CspNonceProvider $cspNonceProvider
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        ConfigProvider $configProvider,
        CspNonceProvider $cspNonceProvider,
        Template\Context $context,
        array $data = []
    ) {
        $this->configProvider = $configProvider;
        $this->cspNonceProvider = $cspNonceProvider;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCspNonce(): string
    {
        return $this->cspNonceProvider->generateNonce();
    }
}
