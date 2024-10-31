=== SEON for WooCommerce ===
Contributors: seontechnologies
Donate link: http://seon.io/
Tags: security, fraud prevention, fraud
Requires at least: 4.6
Tested up to: 4.9
Stable tag: 4.9
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

SEON is an API-based fraud management solution helping merchants and payment providers radically reduce fraud loss. This extension connects your Woocommerce store to SEON using the Fraud API, which is an end-to-end solution for online fraud prevention. It involves all of our module APIs.

== Description ==

If the SEON extension is enabled every order will be processed by SEON Fraud API, collecting all relevant information about the transaction, the customer and the device that the transaction was made from. Within less than 1 second, you receive a transparent decision wheather the transaction was fraudulent or not. This classification and scoring is automatically integrated into your sales order grid. For information about our APIs, visit our website: https://seon.io/products/

= Main features =
* Transaction Monitoring: logins, signups, deposits, withdrawals
* User Management: blacklisting, whitelisting, investigation
* Real-time scoring: behavioral recognition, automatic filtering, velocity, machine Learning, 
* Analysis: dashboard, generate reports, export reports

[youtube https://www.youtube.com/watch?v=95m-U43nOgM]

== Why use SEON? == 

= Data enrichment =
During a transaction the customers' data are enriched by the SEON engine from wide-ranging open and social sources to provide a 360 degree view about the online users and transactions. SEON provides the most accurate and insightful e-mail address investigation that exists on the market by applying deep social media profiling and domain verification tools.

= Decline fraudulent transactions and grow your sales =
Online businesses are faced with fraudulent transactions on a day-to-day basis. Stolen credentials are easily obtained by fraudsters in order to conduct payment fraud. Our platform helps to mitigate the losses due to friendly fraud, stolen credit card purchases or any kind kind of online payments. We make sure that the losses are minimised and the conversion rates are maximised.

= Prevent abusers from taking advantage of your reward/loyalty programs =
Multi-accounting, promo abuse, fake contents and users are major problems across several high risk online industries. Users take advantage of promotions multiple times with numerous accounts and therefore abuse the terms of the merchant. The SEON risk platform enables merchants to easily mitigate the risk of such dishonest activities by monitoring the user-base and activities in real time.

= Know every detail about your clients and make better decisions =
The SEON risk engine enables online businesses to gain a better overview of the user-base. Our modules can provide useful additional information to the identity profile of a client. The different social media presences, device, phone number and IP related information can help make better business related decision throughout customer identification.

== Installation ==

1. Your first step is to obtain a license key to get access to our APIs. Please request a demo on our website: https://seon.io/request-demo/
1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->SEON API screen to configure the plugin. Insert your license key and enable the SEON plugin under System/SEON API. (To turn on device fingerprinting, enable the Javascript Agent)
1. After the installation in Sales Order list you will find two new columns: Seon score and Seon state. To view your transactions on SEON's administrator panel, go to Order details / Seon Transactions or visit admin.seon.io.

== Frequently Asked Questions ==

= Where do I get a license key? =

Please request a demo on our website: https://seon.io/request-demo/ 

= Is SEON API free? =

No, we offer a fully flexible pricing model based on the number of API requests per month. For mor information visit https://seon.io/pricing/

= What is Javascript Agent in the SEON API Setting? = 

It enables our JavaScript snippet, which provides in-depth analysis of the browser and device of a user and transaction. We strongly recommend to implement this agent to your site.

= Where do I see SEON API results? =

You can see the scores and states in the order list under WooCommerce/Orders page, and the full analysis is available in the SEON Transaction Details section under Edit order view.

== Screenshots ==

1. Orders
2. Transaction details
3. SEON API settings

== Changelog ==

= Update 2018-03-20 =

Service changes
* “type” attribute added to device_details Object. If the request is sent through one of our SDKs, the device_details object changes accordingly.
* Heuristic rules added to Scoring Engine.
* Flagged values added to Scoring Engine.
* Scoring Engine compare type rules now can handle IP ranges.

New admin features
* New “Raw data” tab added in order to inspect API requests and responses (Transaction Detials page).
* Customer Connections multiple datapoint selection added (Transaction Details page).
* Machine learning settings added in order to set bad and negative labels and heuristic rule data points (Settings page).
* Machine learning tab added to scoring engine (Scoring Engine page).

= Update 2018-02-28 =

Service changes
* Flagging feature added.

New admin features
* Email address, IP address and Browser Hash can be flagged from the admin panel (Transaction Detials page).
* Flagged as suspicious page added (Lists page).

== Upgrade Notice ==

= 1.0 =
This is the first version of the SEON plugin.