@extends('layouts.app')

@section('title', 'Privacy Policy | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="How {{ config('company.brand') }} collects, uses, and protects your personal data when you use our platform or browse our site." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Privacy Policy – {{ config('company.brand') }}
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Last updated: March 2026
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 prose prose-lg prose-slate text-[var(--color-text-muted)]">
            <p class="lead text-xl text-[var(--color-text-main)] font-medium">
                {{ config('company.brand') }} is a digital platform owned and operated by SuGanta International (“Company”, “we”, “our”, or “us”). This Privacy Policy describes how SuGanta International collects, processes, stores, uses, and protects personal data of individuals who access or use the website <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer" class="font-semibold">www.dywix.com</a> and related services (collectively referred to as the “Platform”).
            </p>

            <p>
                This Privacy Policy is intended to comply with applicable data protection laws, including:
            </p>
            <ul>
                <li><strong>Digital Personal Data Protection Act, 2023 (India)</strong></li>
                <li><strong>General Data Protection Regulation (GDPR) (EU Regulation 2016/679)</strong></li>
                <li>Other applicable international privacy regulations.</li>
            </ul>

            <p>
                By accessing or using the {{ config('company.brand') }} Platform, you acknowledge that you have read and understood this Privacy Policy and consent to the processing of your personal data in accordance with the terms described herein.
            </p>

            <h3>1. Data Fiduciary / Data Controller</h3>
            <p>
                For the purposes of applicable data protection laws:
            </p>
            <p>
                SuGanta International acts as the <strong>Data Fiduciary (under the DPDP Act)</strong> and the <strong>Data Controller (under GDPR)</strong> responsible for determining how personal data is collected, used, and processed through the {{ config('company.brand') }} Platform.
            </p>
            <p>
                <strong>Platform:</strong> {{ config('company.brand') }}<br>
                <strong>Operated By:</strong> SuGanta International<br>
                <strong>Website:</strong> <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">https://www.dywix.com</a>
            </p>

            <h3>2. Categories of Personal Data Collected</h3>
            <p>
                {{ config('company.brand') }} may collect the following categories of personal data when users interact with the Platform.
            </p>

            <h4>2.1 Information Provided by Users</h4>
            <p>
                Personal information voluntarily provided by users may include:
            </p>
            <ul>
                <li>Full name</li>
                <li>Email address</li>
                <li>Phone number</li>
                <li>Address or location information</li>
                <li>Account registration details</li>
                <li>Information submitted through contact forms, support requests, or service inquiries</li>
            </ul>
            <p>
                This data is collected only when users voluntarily provide it.
            </p>

            <h4>2.2 Automatically Collected Information</h4>
            <p>
                When users access the Platform, certain technical data may be automatically collected, including:
            </p>
            <ul>
                <li>IP address</li>
                <li>Device type and operating system</li>
                <li>Browser type and version</li>
                <li>Pages visited and navigation patterns</li>
                <li>Date and time of access</li>
                <li>Referring URLs</li>
            </ul>
            <p>
                This information helps improve website performance, security, and analytics.
            </p>

            <h4>2.3 Cookies and Tracking Data</h4>
            <p>
                {{ config('company.brand') }} may collect data through cookies, analytics tools, and similar technologies used to enhance user experience and analyze traffic.
            </p>

            <h3>3. Legal Basis for Processing (GDPR Compliance)</h3>
            <p>
                Under GDPR, personal data is processed based on one or more of the following lawful bases:
            </p>
            <ul>
                <li><strong>User Consent</strong> – when users voluntarily provide information or agree to cookie usage</li>
                <li><strong>Performance of a Contract</strong> – when processing is necessary to provide services requested by users</li>
                <li><strong>Legitimate Interests</strong> – for improving platform functionality, security, and analytics</li>
                <li><strong>Legal Obligations</strong> – when data processing is required to comply with applicable laws</li>
            </ul>
            <p>
                Where required, users will be asked to provide explicit consent before certain types of data processing.
            </p>

            <h3>4. Purpose of Data Processing</h3>
            <p>
                Personal data collected through {{ config('company.brand') }} may be used for the following purposes:
            </p>
            <ul>
                <li>To operate and maintain the {{ config('company.brand') }} Platform</li>
                <li>To provide services and respond to user inquiries</li>
                <li>To improve website functionality and user experience</li>
                <li>To analyze platform usage and service performance</li>
                <li>To communicate service updates, notifications, and support responses</li>
                <li>To prevent fraud, misuse, or unauthorized access</li>
                <li>To comply with legal or regulatory obligations</li>
            </ul>
            <p>
                Personal data will only be processed for legitimate and lawful purposes.
            </p>

            <h3>5. Data Storage and Retention</h3>
            <p>
                SuGanta International retains personal data <strong>only for as long as necessary</strong> to fulfill the purposes outlined in this Privacy Policy or to comply with legal obligations.
            </p>
            <p>
                Retention periods may depend on:
            </p>
            <ul>
                <li>Duration of service usage</li>
                <li>Legal or regulatory requirements</li>
                <li>Operational necessity</li>
            </ul>
            <p>
                Once personal data is no longer required, reasonable steps will be taken to securely delete or anonymize the information.
            </p>

            <h3>6. Data Sharing and Disclosure</h3>
            <p>
                {{ config('company.brand') }} does <strong>not sell or rent personal data</strong> to third parties.
            </p>
            <p>
                Personal data may be shared under the following circumstances:
            </p>
            <ul>
                <li>With trusted service providers assisting in platform operations</li>
                <li>With payment processors, hosting providers, or analytics platforms</li>
                <li>When required by law, court orders, or regulatory authorities</li>
                <li>To protect the rights, property, or safety of {{ config('company.brand') }}, SuGanta International, or users</li>
                <li>During business restructuring, merger, or acquisition</li>
            </ul>
            <p>
                All third-party service providers are expected to maintain appropriate confidentiality and data protection standards.
            </p>

            <h3>7. International Data Transfers (GDPR)</h3>
            <p>
                If users access the {{ config('company.brand') }} Platform from outside India, their personal data may be transferred and processed in <strong>India or other jurisdictions</strong> where our service providers operate.
            </p>
            <p>
                Where required under GDPR, appropriate safeguards will be implemented for international data transfers, including:
            </p>
            <ul>
                <li>Standard Contractual Clauses (SCCs)</li>
                <li>Contractual data protection agreements</li>
                <li>Compliance with applicable data protection frameworks</li>
            </ul>

            <h3>8. Data Security Measures</h3>
            <p>
                SuGanta International implements appropriate <strong>technical and organizational measures</strong> to protect personal data from unauthorized access, disclosure, alteration, or destruction.
            </p>
            <p>
                Security measures may include:
            </p>
            <ul>
                <li>Secure hosting environments</li>
                <li>Encryption protocols where applicable</li>
                <li>Access control and authentication systems</li>
                <li>Internal data protection policies</li>
                <li>Monitoring systems for security threats</li>
            </ul>
            <p>
                While reasonable security measures are implemented, no internet-based platform can guarantee absolute security.
            </p>

            <h3>9. Rights of Users (Data Principals / Data Subjects)</h3>
            <p>
                Under the <strong>DPDP Act and GDPR</strong>, users may have certain rights regarding their personal data.
            </p>
            <p>
                These rights may include:
            </p>
            <ul>
                <li><strong>Right to Access</strong> – Users may request access to the personal data held about them.</li>
                <li><strong>Right to Correction</strong> – Users may request correction or updating of inaccurate or incomplete personal information.</li>
                <li><strong>Right to Erasure</strong> – Users may request deletion of personal data where legally permissible.</li>
                <li><strong>Right to Withdraw Consent</strong> – Users may withdraw previously given consent for data processing.</li>
                <li><strong>Right to Data Portability (GDPR)</strong> – Users may request transfer of their data in a structured and machine-readable format where applicable.</li>
                <li><strong>Right to Restrict Processing</strong> – Users may request limitation of certain processing activities.</li>
            </ul>
            <p>
                Requests may be submitted through the contact details provided below.
            </p>

            <h3>10. Children's Data Protection</h3>
            <p>
                The {{ config('company.brand') }} Platform is <strong>not intended for individuals under the age of 13 years</strong>.
            </p>
            <p>
                SuGanta International does not knowingly collect personal data from children without verifiable parental consent. If such data is discovered, it will be deleted promptly.
            </p>

            <h3>11. Cookies and Analytics</h3>
            <p>
                {{ config('company.brand') }} may use cookies and analytics tools such as web analytics platforms to understand website traffic and user behavior.
            </p>
            <p>
                Users may manage or disable cookies through their browser settings. Disabling cookies may impact certain features of the Platform.
            </p>

            <h3>12. External Websites</h3>
            <p>
                The {{ config('company.brand') }} Platform may contain links to external websites or services that are not operated by SuGanta International.
            </p>
            <p>
                We are not responsible for the privacy practices, content, or policies of third-party websites. Users should review the privacy policies of those websites separately.
            </p>

            <h3>13. Grievance Redressal (DPDP Compliance)</h3>
            <p>
                In accordance with the <strong>Digital Personal Data Protection Act, 2023</strong>, users may contact the designated grievance officer for concerns related to personal data processing.
            </p>
            <p>
                <strong>Grievance Officer</strong><br>
                SuGanta International<br>
                Website: <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">https://www.dywix.com</a>
            </p>
            <p>
                Requests or complaints related to personal data will be reviewed and addressed within a reasonable timeframe in accordance with applicable laws.
            </p>

            <h3>14. Updates to this Privacy Policy</h3>
            <p>
                SuGanta International reserves the right to update or modify this Privacy Policy at any time.
            </p>
            <p>
                Any updates will be published on this page along with the revised “Last Updated” date. Continued use of the Platform after updates constitutes acceptance of the revised policy.
            </p>

            <h3>15. Contact Information</h3>
            <p>
                For questions, data requests, or privacy concerns, users may contact:
            </p>
            <p>
                <strong>SuGanta International</strong><br>
                Operator of {{ config('company.brand') }} Platform<br>
                Website: <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">https://www.dywix.com</a>
            </p>
            <p>
                You may also contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a> for data access, correction, or deletion requests.
            </p>

            <hr class="my-12 border-[var(--color-border-subtle)]">

            <p class="text-sm">
                By using this site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our site.
            </p>
        </div>
    </section>
@endsection
