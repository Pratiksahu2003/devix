@extends('layouts.app')

@section('title', 'Cookie Policy | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="How {{ config('company.brand') }} uses cookies and similar technologies when you use our platform." />
@endsection

@section('content')
    <section class="legal-hero py-8 lg:py-10 border-b border-border-subtle">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-brand-lens-blue/10 text-brand-lens-blue mb-3" aria-hidden="true">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-text-main sm:text-3xl">
                Cookie Policy
            </h1>
            <p class="mt-2 text-base text-text-muted sm:text-lg">
                {{ config('company.brand') }} · Last updated: March 2026
            </p>
        </div>
    </section>

    <section class="py-8 lg:py-10 bg-surface-muted">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="legal-content-card rounded-xl p-5 sm:p-6 legal-content">
                <p class="lead">
                    This Cookie Policy explains how {{ config('company.brand') }}, a digital platform owned and operated by SuGanta International (“Company”, “we”, “our”, or “us”), uses cookies and similar tracking technologies when users access or interact with the website <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">www.dywix.com</a> and any related services (collectively referred to as the “Platform”).
                </p>

                <p>
                    This Cookie Policy forms part of our <a href="{{ route('pages.privacy') }}">Privacy Policy</a> and should be read together with it. The Privacy Policy explains how we process personal data collected through the Platform.
                </p>
                <p>
                    By accessing or using the {{ config('company.brand') }} Platform, users acknowledge and consent to the use of cookies as described in this policy, except where consent is withdrawn or limited through browser or cookie settings.
                </p>

                <h2>1. What Are Cookies</h2>
                <p>
                    Cookies are small text files that are placed and stored on a user's device (such as a computer, tablet, or smartphone) when visiting a website. These files allow websites to recognize a user's device and store certain information related to browsing activity or preferences.
                </p>
                <p>
                    Cookies serve multiple purposes, including enabling website functionality, improving performance, remembering user preferences, and analyzing user behavior.
                </p>
                <p>Cookies may store information such as:</p>
                <ul>
                    <li>Device and browser type</li>
                    <li>Language preferences</li>
                    <li>Login session details</li>
                    <li>Website navigation behavior</li>
                    <li>User preferences and settings</li>
                    <li>Traffic analytics data</li>
                </ul>
                <p>
                    Cookies generally do not directly identify users; however, in certain circumstances they may be associated with personal data.
                </p>

                <h2>2. Legal Basis for Cookie Usage (GDPR & ePrivacy Directive)</h2>
                <p>
                    Under the <strong>General Data Protection Regulation (GDPR)</strong> and the <strong>EU ePrivacy Directive</strong>, the use of cookies must be supported by a lawful basis.
                </p>
                <p>{{ config('company.brand') }} uses cookies based on the following legal grounds:</p>
                <p>
                    <strong>Strictly Necessary Cookies</strong><br>
                    These cookies are essential for the operation of the website and do not require user consent.
                </p>
                <p>
                    <strong>Consent-Based Cookies</strong><br>
                    Cookies used for analytics, performance monitoring, marketing, or advertising purposes are deployed only after obtaining user consent where required.
                </p>
                <p>
                    Users may withdraw consent at any time by adjusting cookie preferences through their browser or platform settings.
                </p>

                <h2>3. Types of Cookies Used</h2>
                <p>{{ config('company.brand') }} may use the following categories of cookies:</p>

                <h3>3.1 Strictly Necessary Cookies</h3>
                <p>
                    These cookies are essential for the operation of the Platform and enable core functionalities such as:
                </p>
                <ul>
                    <li>Secure browsing</li>
                    <li>Page navigation</li>
                    <li>Access to protected areas</li>
                    <li>Session management</li>
                    <li>Fraud prevention and security</li>
                </ul>
                <p>Without these cookies, certain services may not function properly.</p>

                <h3>3.2 Performance and Analytics Cookies</h3>
                <p>
                    These cookies collect information about how users interact with the Platform in order to improve performance and usability.
                </p>
                <p>They may track:</p>
                <ul>
                    <li>Pages visited</li>
                    <li>Time spent on pages</li>
                    <li>Navigation behavior</li>
                    <li>Error logs and diagnostics</li>
                    <li>Website traffic patterns</li>
                </ul>
                <p>The information collected is typically aggregated and anonymized.</p>
                <p>Analytics tools used may include third-party services that help analyze website usage.</p>

                <h3>3.3 Functional Cookies</h3>
                <p>
                    Functional cookies enable the Platform to remember user preferences and provide enhanced functionality.
                </p>
                <p>These cookies may store:</p>
                <ul>
                    <li>Language preferences</li>
                    <li>Display settings</li>
                    <li>Login information</li>
                    <li>User interface customization</li>
                </ul>
                <p>Disabling these cookies may affect certain user experience features.</p>

                <h3>3.4 Advertising and Marketing Cookies</h3>
                <p>
                    Advertising cookies may be used to deliver relevant advertisements to users and measure the effectiveness of marketing campaigns.
                </p>
                <p>These cookies may:</p>
                <ul>
                    <li>Track browsing behavior across websites</li>
                    <li>Build interest profiles</li>
                    <li>Deliver targeted advertising content</li>
                    <li>Measure advertisement performance</li>
                </ul>
                <p>
                    These cookies may be placed by {{ config('company.brand') }} or by third-party advertising partners.
                </p>

                <h2>4. Third-Party Cookies</h2>
                <p>
                    Some cookies used on the {{ config('company.brand') }} Platform may be set by third-party service providers that support platform functionality.
                </p>
                <p>These may include:</p>
                <ul>
                    <li>Web analytics providers</li>
                    <li>Advertising networks</li>
                    <li>Social media integrations</li>
                    <li>Embedded video or content providers</li>
                    <li>Cloud hosting services</li>
                </ul>
                <p>
                    These third parties may collect and process information according to their own privacy and cookie policies. {{ config('company.brand') }} does not control how third-party providers use such information.
                </p>
                <p>Users are encouraged to review the privacy policies of third-party providers.</p>

                <h2>5. Cookie Consent Management</h2>
                <p>
                    Where required by law, {{ config('company.brand') }} may present users with a <strong>cookie consent banner</strong> or consent management interface when they first access the Platform.
                </p>
                <p>Through this interface, users may:</p>
                <ul>
                    <li>Accept all cookies</li>
                    <li>Reject non-essential cookies</li>
                    <li>Customize cookie preferences</li>
                </ul>
                <p>
                    User preferences may be stored through consent cookies that remember user choices for future visits.
                </p>
                <p>Users may update their preferences at any time through browser settings.</p>

                <h2>6. How Users Can Control Cookies</h2>
                <p>
                    Users have the right to manage and control cookies placed on their devices.
                </p>
                <p>Most browsers allow users to:</p>
                <ul>
                    <li>View cookies stored on their device</li>
                    <li>Delete existing cookies</li>
                    <li>Block certain types of cookies</li>
                    <li>Disable all cookies</li>
                </ul>
                <p>
                    These settings are typically available within the browser's <strong>Privacy or Security settings</strong>.
                </p>
                <p>
                    Please note that blocking or disabling cookies may impact the functionality and usability of the {{ config('company.brand') }} Platform.
                </p>

                <h2>7. Cookie Retention Period</h2>
                <p>
                    Cookies may remain on user devices for different durations depending on their type.
                </p>
                <p>
                    <strong>Session Cookies</strong><br>
                    Session cookies are temporary and automatically expire when the user closes their browser.
                </p>
                <p>
                    <strong>Persistent Cookies</strong><br>
                    Persistent cookies remain stored on the user's device for a defined period or until manually deleted.
                </p>
                <p>
                    The retention period of cookies depends on their specific purpose and functionality.
                </p>

                <h2>8. International Data Transfers</h2>
                <p>
                    Certain cookies or analytics services may involve the transfer of data to servers located outside the user's jurisdiction.
                </p>
                <p>
                    Where such transfers occur, {{ config('company.brand') }} will ensure that appropriate safeguards are implemented to protect personal data in accordance with applicable laws, including:
                </p>
                <ul>
                    <li>GDPR data transfer mechanisms</li>
                    <li>Contractual safeguards with service providers</li>
                    <li>Compliance with international data protection standards</li>
                </ul>

                <h2>9. User Rights</h2>
                <p>
                    Users may have certain rights regarding personal data associated with cookies under applicable laws such as the <strong>GDPR</strong> and <strong>India's Digital Personal Data Protection Act, 2023</strong>.
                </p>
                <p>These rights may include:</p>
                <ul>
                    <li>The right to access personal data</li>
                    <li>The right to request correction of inaccurate information</li>
                    <li>The right to withdraw consent for cookie usage</li>
                    <li>The right to request deletion of personal data where applicable</li>
                    <li>The right to restrict or object to certain types of processing</li>
                </ul>
                <p>Requests may be submitted using the contact information provided below.</p>

                <h2>10. Data Security</h2>
                <p>
                    SuGanta International takes reasonable administrative, technical, and organizational measures to protect information collected through cookies from unauthorized access, misuse, or disclosure.
                </p>
                <p>
                    However, due to the nature of internet technologies, no data transmission or storage system can be guaranteed to be completely secure.
                </p>

                <h2>11. Updates to This Cookie Policy</h2>
                <p>
                    SuGanta International may update this Cookie Policy from time to time in response to:
                </p>
                <ul>
                    <li>Changes in legal or regulatory requirements</li>
                    <li>Updates in technology or cookie usage practices</li>
                    <li>Platform functionality improvements</li>
                </ul>
                <p>
                    Any changes will be posted on this page with an updated <strong>Last Updated date</strong>.
                </p>
                <p>
                    Continued use of the Platform after updates indicates acceptance of the revised Cookie Policy.
                </p>

                <h2>12. Contact Information</h2>
                <p>
                    For questions or concerns regarding this Cookie Policy or the use of cookies on the {{ config('company.brand') }} Platform, users may contact:
                </p>
                <p>
                    <strong>SuGanta International</strong><br>
                    Operator of {{ config('company.brand') }} Platform<br>
                    Website: <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">https://www.dywix.com</a>
                </p>
                <p>
                    You may also contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a>.
                </p>

                <hr>

                <p class="text-sm text-text-muted">
                    For more information about how we collect and use personal data, please see our <a href="{{ route('pages.privacy') }}">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </section>
@endsection
