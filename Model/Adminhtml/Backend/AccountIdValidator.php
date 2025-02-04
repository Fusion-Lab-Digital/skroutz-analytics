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
namespace FusionLab\SkroutzAnalytics\Model\Adminhtml\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\LocalizedException;

class AccountIdValidator extends Value
{

    /**
     * @return AccountIdValidator
     * @throws LocalizedException
     */
    public function beforeSave(): AccountIdValidator
    {
        if (!preg_match('/^SA-[A-Za-z0-9-]+$/', $this->getValue())) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Invalid Skroutz Analytics Account Id.')
            );
        }
        return parent::beforeSave();
    }
}
