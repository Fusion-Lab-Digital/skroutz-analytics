<a href="https://fusionlab.gr?utm_source=github&utm_medium=skroutz_analytics&utm_campaign=module" target="_blank">
<img align="center" width="250" height="100" src="https://fusionlab.gr/fusion-lab-logo-neg-cropped.svg"/>
</a>

# Fusion Lab - Skroutz Analytics Extension

![Magento 2](https://img.shields.io/badge/Magento-2.4.x-orange.svg) ![License](https://img.shields.io/badge/license-Apache2.0-blue.svg)

## 📌 Overview
**Fusion Lab Skroutz Analytics Extension** integrates [Skourtz](https://www.skroutz.gr/), with your Magento 2 store.

## ⚡ Features
- Compatible with **Magento 2.4.x**.
- Adds [Skroutz Analytics](https://developer.skroutz.gr/analytics/) Support.
- Compatible with [Content Security Policy (CSP)](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP).
- Multi Website / Storeview Support.

## 🛠️ Installation

### Install via Composer 2.x
We recommend to install this module via a compatible version of [Composer 2.x](https://getcomposer.org/download/) for your Magento 2 Installtion.

See your [Magento 2 Requirements here](https://experienceleague.adobe.com/en/docs/commerce-operations/installation-guide/system-requirements). 
```bash
composer require fusionlab-digital/skroutz-analytics
php bin/magento module:enable FusionLab_SkroutzAnalytics
php bin/magento setup:upgrade
php bin/magento s:d:c
php bin/magento s:s:d {Your Themes}
php bin/magento cache:flush
```

### Manual Installation (not recommended)
1. This module has a dependency to [FusionLab_Core](https://github.com/Fusion-Lab-Digital/m2.core) which you must first install. See the github page for installation instructions.
2. Download the module and extract it into `app/code/FusionLab/SkroutzAnalytics`
3. Run the following Magento CLI commands:
```bash
php bin/magento module:enable FusionLab_SkroutzAnalytics FusionLab_Core
php bin/magento setup:upgrade
php bin/magento s:d:c
php bin/magento s:s:d {Your Themes}
php bin/magento cache:flush
```

### How to Update.
```bash
composer update fusionlab-digital/skroutz-analytics
php bin/magento setup:upgrade
php bin/magento s:d:c
php bin/magento s:s:d {Your Themes}
php bin/magento cache:flush
```

## 🚀 Setup
Open the Admin and navigate to <b>Menu -> FusionLab -> Skroutz</b>

1. Enable the Module
2. Add your Skroutz Account Id
3. Select product identifier (sku or id) for the products.


## ⚙️ Configuration Documentation
| Field                                       | Area             | Documentation
|---------------------------------------------|------------------|-|
| Enable Module?                              | General Settings | Enables or Disables the functionality of the module.
| Skroutz Analytics Id      | General Settings | Your Skroutz Account Id. This is provided from Skroutz.
| Product Identifier		                         | General Settings | Will be used in the prodcut_id property in checkout success page. Should match the values on your XML export.


## 📄 License

This module is licensed under the Apache 2.0 License. See [LICENSE](LICENSE) for details.

## 📩 Support

For any issues, feature requests, or inquiries, please open an issue on [GitHub Issues](https://github.com/Fusion-Lab-Digital/m2.core/issues), contact us at info@fusionlab.gr, or visit our website at [fusionlab.gr](https://fusionlab.gr/?utm_source=github&utm_medium=skroutz_analytics&utm_campaign=module) for more information.
