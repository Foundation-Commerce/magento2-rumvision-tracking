# FoundationCommerce RumVision Tracking

Integrates the RumVision real user monitoring (RUM) tracking script into all frontend pages. The script is configurable via the Magento admin panel and can be enabled/disabled per store view. The inline script is CSP compliant using Hyvä's `HyvaCsp` helper.

## Installation

The module is located at:
```
app/code/FoundationCommerce/RumvisionTracking/
```

After installation or updates, run:
```bash
php bin/magento module:enable FoundationCommerce_RumvisionTracking
php bin/magento setup:upgrade
php bin/magento cache:flush
```

## Configuration

Navigate to: **Stores > Configuration > Foundation Commerce > RumVision Tracking**

### General Settings

- **Enable RumVision Tracking**: Turn the tracking script on/off
- **RumVision Site ID**: Your RumVision site ID (found in your RumVision dashboard, e.g. `RUM-66DC162C53`)
- **Domain Name**: The domain name passed to the RumVision tracking script (e.g. `example.com`)

The tracking script will only render on the frontend when the module is enabled and both a site ID and domain name are configured.

## How It Works

When enabled, the module injects the RumVision JavaScript tracking snippet before the closing `</body>` tag on all frontend pages. The script loads asynchronously and does not block page rendering.

The inline script uses Hyvä's `HyvaCsp::registerInlineScript()` for Content Security Policy compliance. When full page cache is enabled, a SHA-256 hash of the script is added to the CSP header. When FPC is disabled, a nonce attribute is injected on the script tag instead.

## Module Structure

```
app/code/FoundationCommerce/RumvisionTracking/
├── Model/
│   └── Config.php              # Configuration accessor
├── ViewModel/
│   └── TrackingScript.php      # ViewModel for the tracking template
├── etc/
│   ├── acl.xml                 # Admin ACL resource
│   ├── adminhtml/
│   │   └── system.xml          # Admin configuration fields
│   ├── config.xml              # Default configuration values
│   └── module.xml              # Module declaration
├── view/
│   └── frontend/
│       ├── layout/
│       │   └── default.xml     # Layout injection on all pages
│       └── templates/
│           └── tracking-script.phtml  # Tracking script template
├── composer.json
├── README.md
└── registration.php
```

## Troubleshooting

- **Script not appearing**: Verify the module is enabled and both a site ID and domain name are set. Flush cache with `php bin/magento cache:flush`.
- **CSP errors in browser console**: Ensure the Hyvä theme module is installed and up to date. The `HyvaCsp` helper handles nonce/hash injection automatically.
- **Script on wrong pages**: The script is injected on all frontend pages via `default.xml`. To restrict it, modify the layout XML.
- **Check module status**: `php bin/magento module:status FoundationCommerce_RumvisionTracking`
