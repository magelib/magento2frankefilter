1.1.9 (21/12/2016)
=============
**This release requires Magento 2.1.0 at least.**
* Improvements
    * PI void using instructions/void API.
    * PI refund using own API.
    * Add index on sagepaysuite_token table.
* Bug fixes
    * Validation is failed. PI transactions go through even if Magento JS validation fails.
    * Uncaught TypeError: Unable to process binding if: hasSsCardType
    * PI on admin lets you enter cc number with spaces.
    * Magento minification minifies PI external files and 404s.
    * Fraud on order view Not enough information. Undefined property: stdClass::$fraudscreenrecommendation.
    * PI integration customer email not sent.

1.1.8 (28/10/2016)
=============
**This release requires Magento 2.1.0 at least.**
* Improvements
    * Enable disable form and pi on moto, different config.
    * Add CardHolder to FORM requests for ReD validation.
    * Add index on sagepaysuite_token table.
* Bug fixes
    * Remove reference to legacy code Mage::logException.
    * Redirect to Sage Pay on server integration when on mobile.
    * Validate moto order when using pi before submitting to sagepay.
    * Sage Pay Logo loading via HTTPS everywhere now.
    * Sage Pay PI does not show a progress indicator once the place order button is pressed.
    * Don't show "My Saved Credit Cards" link on My Account if not enabled.
    * BasketXML fixes specially for PayPal.
    * Fixed many issues with frontend orders, changed requests to webapis.
    * Fix logo disappearing on checkout.
    * Fix moto order stuck in pending_payment status.
    * Fix cancelled orders in pi frontend when 3D secure is not Authenticated.
    * Specific ACL on admin controllers.
    * Many performance and standards compliance improvements.

1.1.7 (18/08/2016)
=============
**This release requires Magento 2.1.0 at least.**
* Improvements
    * Coding standards for Magento Marketplace.
* Bug fixes
    * Basket display issue, decimal places.
    * MOTO customer create account for PI integration fixed.

1.1.6.0 (12/07/2016)
=============
**This release requires Magento 2.1.0 at least.**
* Improvements
    * Change PI wording for Direct.
* Bug fixes
    * Order with custom option=file with SERVER integration was not working.
    * MOTO fixes.

1.1.5.2 (28/06/2016)
=============
* Bug fixes
    * Billing address not updated from checkout.

1.1.5 (09/05/2016)
=============
* New Features
    * License and Reporting credentials validated in config.
* Bug fixes
    * Compilation error with fraud helper in version 2.0.4.
    * Filename of fraud grid in admin with lowercase letter.

1.1.4 (01/04/2016)
=============
* New Features
    * Tokens Report in backend.
    * Fraud Report in backend.
    * Fraud score automations.
    * Unit-testing coverage of 80%.
    * Basket in all requests, XML and Sage50 compatible.
    * Currency configuration options.
    * Transaction details can now be synced from Sage Pay API from backend.
    * REPEAT MOTO integration.
    * FORM MOTO integration.
    * Euro Payments now supported with SERVER integration.
* Improvements
    * Max tokens per customer limitation (3).
    * Paypal "processing payment" page.
    * SERVER nice and shinny "slide" modal mode.
    * Translations backbone.
    * SERVER VPS hash validation.
    * Recover quote when end user clicks on back button after order was pre saved.
* Bug fixes
    * Various fixes to meet magento2 coding standarts.

1.1.2 (01/02/2016)
=============
* New Features
    * PayPal integration (frontend).
    * Cancel Pening payments CRON.
    * Fraud report CRON.
    * Token list in frontend customer area.
    * Unit tests additions.
* Bug fixes
    * Virtual products state address error.

1.1.0 (15/01/2016)
=============
* New Features
    * SERVER integration (frontend)
    * PI integration (backend)
    * Token integration for SERVER
    * 3D Secure for all integrations
    * Auth & Capture, Defer and Authentication payment actions for all integrations

1.0.6 (15/12/2015)
=============
* New Features
    * FORM integration (frontend)
    * PI integration (frontend)
    * Online Refunds
