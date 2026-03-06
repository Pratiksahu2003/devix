@extends('layouts.app')

@section('title', 'Terms & Conditions | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Terms and conditions for using the {{ config('company.brand') }} platform and related services." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Terms and Conditions – {{ config('company.brand') }}
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Last updated: March 2026
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 prose prose-lg prose-slate text-[var(--color-text-muted)]">
            <p class="lead text-xl text-[var(--color-text-main)] font-medium">
                These Terms and Conditions (“Terms”) govern the access to and use of the website <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">www.dywix.com</a> and related services provided through the {{ config('company.brand') }} platform (the “Platform”). {{ config('company.brand') }} is a digital platform owned, developed, and operated by SuGanta International (“Company”, “we”, “our”, or “us”).
            </p>
            <p>
                By accessing or using the Platform, you agree to comply with and be bound by these Terms. If you do not agree with these Terms, you must discontinue use of the Platform immediately.
            </p>

            <h3>1. Definitions</h3>
            <p>For the purposes of these Terms:</p>
            <ul>
                <li><strong>“Platform”</strong> refers to the {{ config('company.brand') }} website, services, software, content, and related digital infrastructure.</li>
                <li><strong>“User”</strong> refers to any individual or entity accessing or using the Platform.</li>
                <li><strong>“Content”</strong> includes text, images, graphics, videos, data, software, or any material available on the Platform.</li>
                <li><strong>“Services”</strong> refers to any digital features, tools, or services provided through {{ config('company.brand') }}.</li>
            </ul>

            <h3>2. Ownership and Operation</h3>
            <p>
                {{ config('company.brand') }} is fully owned and operated by SuGanta International, which retains exclusive rights to manage, operate, maintain, and modify the Platform.
            </p>
            <p>
                All infrastructure, technology, and services associated with the {{ config('company.brand') }} Platform are under the control and responsibility of SuGanta International.
            </p>

            <h3>3. Acceptance of Terms</h3>
            <p>By accessing the Platform, users confirm that:</p>
            <ul>
                <li>They have read and understood these Terms.</li>
                <li>They agree to comply with all applicable laws and regulations while using the Platform.</li>
                <li>They accept these Terms as a legally binding agreement between themselves and SuGanta International.</li>
            </ul>

            <h3>4. Eligibility</h3>
            <p>Users must meet the following eligibility requirements:</p>
            <ul>
                <li>Be <strong>at least 18 years of age</strong>, or have parental/guardian consent.</li>
                <li>Have the legal authority to enter into a binding agreement.</li>
                <li>Not be restricted from using online services under applicable laws.</li>
            </ul>
            <p>
                SuGanta International reserves the right to restrict or terminate access if eligibility requirements are not met.
            </p>

            <h3>5. User Accounts (If Applicable)</h3>
            <p>
                Certain features of the {{ config('company.brand') }} Platform may require users to create an account.
            </p>
            <p>Users agree that:</p>
            <ul>
                <li>Information provided during registration must be accurate and complete.</li>
                <li>Login credentials must be kept confidential.</li>
                <li>Users are responsible for all activity occurring under their account.</li>
            </ul>
            <p>
                SuGanta International reserves the right to suspend or terminate accounts if fraudulent or suspicious activity is detected.
            </p>

            <h3>6. Acceptable Use Policy</h3>
            <p>Users agree not to use the Platform for any activity that:</p>
            <ul>
                <li>Violates applicable laws or regulations</li>
                <li>Infringes on intellectual property rights</li>
                <li>Distributes malicious software or harmful code</li>
                <li>Harasses, abuses, or harms other users</li>
                <li>Attempts to gain unauthorized access to systems or databases</li>
                <li>Interferes with the normal operation or security of the Platform</li>
            </ul>
            <p>Any violation of this policy may result in immediate termination of access.</p>

            <h3>7. User-Generated Content</h3>
            <p>
                If users submit or upload any content to the Platform, they grant SuGanta International a non-exclusive, worldwide, royalty-free license to use, reproduce, display, and distribute such content for the purpose of operating the Platform.
            </p>
            <p>Users represent and warrant that:</p>
            <ul>
                <li>They own the rights to the content submitted.</li>
                <li>The content does not violate any law or third-party rights.</li>
            </ul>
            <p>
                SuGanta International reserves the right to remove any content deemed inappropriate or unlawful.
            </p>

            <h3>8. Intellectual Property Rights</h3>
            <p>
                All intellectual property associated with the {{ config('company.brand') }} Platform—including but not limited to:
            </p>
            <ul>
                <li>Logos and trademarks</li>
                <li>Website design and layout</li>
                <li>Software and technology</li>
                <li>Images, graphics, text, and multimedia content</li>
            </ul>
            <p>
                are owned by SuGanta International or its licensors and protected by intellectual property laws.
            </p>
            <p>
                Users may not reproduce, distribute, modify, or commercially exploit any Platform content without prior written consent.
            </p>

            <h3>9. Service Modifications</h3>
            <p>SuGanta International reserves the right to:</p>
            <ul>
                <li>Modify or discontinue services</li>
                <li>Update platform features</li>
                <li>Restrict access to certain areas of the Platform</li>
                <li>Change pricing or service models (if applicable)</li>
            </ul>
            <p>These changes may occur without prior notice where necessary.</p>

            <h3>10. Platform Availability</h3>
            <p>
                The Platform is provided on an <strong>“as available” basis</strong>.
            </p>
            <p>
                SuGanta International does not guarantee uninterrupted or error-free access to the Platform. Service interruptions may occur due to:
            </p>
            <ul>
                <li>Maintenance or upgrades</li>
                <li>Technical failures</li>
                <li>Cybersecurity incidents</li>
                <li>Events beyond our control</li>
            </ul>
            <p>We shall not be liable for temporary service disruptions.</p>

            <h3>11. Third-Party Services</h3>
            <p>
                {{ config('company.brand') }} may integrate or provide links to third-party services, tools, or websites.
            </p>
            <p>
                These services are governed by their own terms and privacy policies. SuGanta International does not control or assume responsibility for the actions, policies, or content of third-party providers.
            </p>

            <h3>12. Disclaimer of Warranties</h3>
            <p>
                The {{ config('company.brand') }} Platform and all associated services are provided <strong>“as is” and “as available”</strong> without warranties of any kind.
            </p>
            <p>
                SuGanta International does not warrant that:
            </p>
            <ul>
                <li>The Platform will be uninterrupted or error-free</li>
                <li>Information provided on the Platform is always accurate or complete</li>
                <li>The Platform will be free from viruses or harmful components</li>
            </ul>
            <p>Users access the Platform at their own risk.</p>

            <h3>13. Limitation of Liability</h3>
            <p>
                To the fullest extent permitted by law, SuGanta International shall not be liable for any:
            </p>
            <ul>
                <li>Direct or indirect damages</li>
                <li>Loss of profits or business opportunities</li>
                <li>Data loss or system damage</li>
                <li>Service interruptions or technical failures</li>
            </ul>
            <p>arising from the use or inability to use the {{ config('company.brand') }} Platform.</p>

            <h3>14. Indemnification</h3>
            <p>
                Users agree to indemnify and hold harmless SuGanta International, its directors, employees, affiliates, and partners from any claims, liabilities, damages, or expenses arising from:
            </p>
            <ul>
                <li>Violation of these Terms</li>
                <li>Misuse of the Platform</li>
                <li>Infringement of intellectual property rights</li>
                <li>Violation of applicable laws</li>
            </ul>

            <h3>15. Privacy and Data Protection</h3>
            <p>
                Use of the {{ config('company.brand') }} Platform is subject to our <a href="{{ route('pages.privacy') }}">Privacy Policy</a>, which outlines how personal data is collected, processed, and protected in accordance with:
            </p>
            <ul>
                <li>India Digital Personal Data Protection Act, 2023</li>
                <li>GDPR (EU General Data Protection Regulation)</li>
            </ul>
            <p>Users are encouraged to review the Privacy Policy for more details.</p>

            <h3>16. Suspension and Termination</h3>
            <p>
                SuGanta International reserves the right to suspend or terminate access to the Platform if:
            </p>
            <ul>
                <li>Users violate these Terms</li>
                <li>Fraudulent or illegal activity is detected</li>
                <li>Continued use poses a risk to platform security</li>
            </ul>
            <p>Termination may occur without prior notice in certain circumstances.</p>

            <h3>17. Force Majeure</h3>
            <p>
                SuGanta International shall not be held liable for failure or delay in performing obligations due to events beyond reasonable control, including but not limited to:
            </p>
            <ul>
                <li>Natural disasters</li>
                <li>Cyber attacks</li>
                <li>Government actions or regulations</li>
                <li>Internet outages</li>
                <li>Labor disputes</li>
            </ul>

            <h3>18. Governing Law</h3>
            <p>
                These Terms shall be governed by and interpreted in accordance with the <strong>laws of India</strong>.
            </p>
            <p>
                Any disputes arising from the use of the {{ config('company.brand') }} Platform shall fall under the jurisdiction of the <strong>courts of India</strong>, unless otherwise required by applicable law.
            </p>

            <h3>19. Dispute Resolution</h3>
            <p>
                In the event of any dispute arising from these Terms or use of the Platform, parties agree to attempt resolution through <strong>good-faith negotiations</strong> before initiating formal legal proceedings.
            </p>

            <h3>20. Severability</h3>
            <p>
                If any provision of these Terms is found to be invalid or unenforceable, the remaining provisions shall remain in full force and effect.
            </p>

            <h3>21. Entire Agreement</h3>
            <p>
                These Terms constitute the <strong>entire agreement</strong> between users and SuGanta International regarding the use of the {{ config('company.brand') }} Platform and supersede any prior agreements or understandings.
            </p>

            <h3>22. Changes to Terms</h3>
            <p>
                SuGanta International reserves the right to modify or update these Terms at any time.
            </p>
            <p>
                Updated Terms will be published on this page with a revised <strong>Last Updated date</strong>. Continued use of the Platform after such updates constitutes acceptance of the revised Terms.
            </p>

            <h3>23. Contact Information</h3>
            <p>
                For any questions regarding these Terms and Conditions, users may contact:
            </p>
            <p>
                <strong>SuGanta International</strong><br>
                Operator of the {{ config('company.brand') }} Platform<br>
                Website: <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">https://www.dywix.com</a>
            </p>

            <hr class="my-12 border-[var(--color-border-subtle)]">

            <p class="text-sm">
                If you have any questions about these Terms, please contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a>.
            </p>
        </div>
    </section>
@endsection
