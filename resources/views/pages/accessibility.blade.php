@extends('layouts.app')

@section('title', 'Accessibility Statement | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Our commitment to making {{ config('company.brand') }} accessible to all. Digital accessibility, WCAG alignment, and assistance for users with disabilities." />
@endsection

@section('content')
    <section class="legal-hero py-8 lg:py-10 border-b border-border-subtle">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-brand-lens-blue/10 text-brand-lens-blue mb-3" aria-hidden="true">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-text-main sm:text-3xl">
                Accessibility Statement
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
                    At {{ config('company.brand') }}, we believe the internet should be accessible to everyone. Our goal is to create a digital platform that can be easily used by all visitors, including individuals with disabilities. We are committed to improving the usability, accessibility, and inclusivity of our website so that every user can explore {{ config('company.brand') }} services without barriers.
                </p>
                <p>
                    {{ config('company.brand') }} is a digital platform operated by SuGanta International, and we continuously work to ensure that our website <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">www.dywix.com</a> provides a comfortable and accessible browsing experience for all users, regardless of their abilities, technology, or environment.
                </p>

                <h2>Our Commitment to Accessibility</h2>
                <p>
                    Accessibility is an essential part of building a responsible digital platform. At {{ config('company.brand') }}, we strive to ensure that our website design, content, and navigation remain accessible to people with a wide range of abilities.
                </p>
                <p>Our accessibility efforts focus on helping users who may experience challenges related to:</p>
                <ul>
                    <li>Visual impairments</li>
                    <li>Hearing impairments</li>
                    <li>Motor or mobility limitations</li>
                    <li>Cognitive or learning disabilities</li>
                    <li>Temporary disabilities or device limitations</li>
                </ul>
                <p>
                    By prioritizing accessibility, we aim to make {{ config('company.brand') }} a platform where creators, professionals, brands, and visitors can access information and services without unnecessary restrictions.
                </p>

                <h2>Accessibility Standards and Guidelines</h2>
                <p>
                    {{ config('company.brand') }} aims to follow widely recognized web accessibility standards and best practices. Our efforts are guided by the principles of the <strong>Web Content Accessibility Guidelines (WCAG)</strong> developed by the <strong>World Wide Web Consortium (W3C)</strong>.
                </p>
                <p>
                    {{ config('company.brand') }} endeavors to align its website accessibility practices with <strong>WCAG 2.1 Level AA</strong>, which provides internationally recognized standards for making web content more accessible to people with disabilities.
                </p>
                <p>These guidelines help websites become:</p>
                <ul>
                    <li><strong>Perceivable</strong> – Information is presented in ways users can understand.</li>
                    <li><strong>Operable</strong> – Navigation and functionality can be used with different devices and assistive technologies.</li>
                    <li><strong>Understandable</strong> – Content is structured clearly and logically.</li>
                    <li><strong>Robust</strong> – The website works across different browsers, devices, and assistive technologies.</li>
                </ul>
                <p>We regularly review our website features to align with modern accessibility recommendations and improve the overall user experience.</p>

                <h2>Accessibility Features Available on {{ config('company.brand') }}</h2>
                <p>To support accessibility, the {{ config('company.brand') }} platform includes several usability features designed to assist different types of users.</p>
                <ul>
                    <li><strong>Keyboard Navigation:</strong> Users can navigate key sections using keyboard commands without requiring a mouse.</li>
                    <li><strong>Structured Content and Clear Headings:</strong> Pages are organized with proper headings and logical structures for screen readers and assistive technologies.</li>
                    <li><strong>Alternative Text for Images:</strong> Images and visual content include alternative descriptions where appropriate.</li>
                    <li><strong>Responsive Design:</strong> The platform works across different screen sizes and devices, including desktops, tablets, and mobile phones.</li>
                    <li><strong>Readable Typography:</strong> Clear fonts, appropriate spacing, and readable text sizes improve content clarity.</li>
                    <li><strong>Consistent Navigation:</strong> Predictable navigation structures help users locate information easily.</li>
                    <li><strong>Assistive Technology Compatibility:</strong> We strive to ensure compatibility with screen readers, voice navigation tools, keyboard-only browsing, and mobile accessibility features. Performance may vary depending on browser versions, operating systems, or device settings.</li>
                </ul>

                <h2>Compliance with the Digital Personal Data Protection Act, 2023</h2>
                <p>
                    {{ config('company.brand') }} operates under SuGanta International and is committed to complying with applicable laws governing digital services, accessibility, and data protection.
                </p>
                <p>
                    In accordance with the <strong>Digital Personal Data Protection Act, 2023 (India)</strong>, {{ config('company.brand') }} strives to ensure that digital services remain transparent, responsible, and accessible to users while maintaining appropriate safeguards for personal data. Although the DPDP Act primarily addresses personal data protection, {{ config('company.brand') }} recognizes that accessible digital interfaces contribute to responsible digital governance and user empowerment.
                </p>

                <h2>Accessibility Audit and Monitoring</h2>
                <p>
                    {{ config('company.brand') }} periodically reviews and evaluates its website to identify and address potential accessibility barriers. These evaluations may involve a combination of <strong>automated accessibility tools, manual testing, and usability reviews</strong>.
                </p>
                <p>Accessibility audits may examine:</p>
                <ul>
                    <li>Page structure and semantic HTML</li>
                    <li>Keyboard navigation functionality</li>
                    <li>Alternative text and media descriptions</li>
                    <li>Color contrast and readability</li>
                    <li>Compatibility with assistive technologies</li>
                </ul>
                <p>{{ config('company.brand') }} may update its accessibility practices and evaluation methods as web technologies and standards evolve.</p>

                <h2>Ongoing Accessibility Improvements</h2>
                <p>Accessibility is not a one-time effort. {{ config('company.brand') }} continuously monitors and improves the accessibility of our platform. Our ongoing efforts include:</p>
                <ul>
                    <li>Regular website usability reviews</li>
                    <li>Accessibility testing during feature updates</li>
                    <li>Continuous improvement of website structure and navigation</li>
                    <li>Updates to ensure compatibility with evolving web technologies</li>
                </ul>
                <p>As our platform grows, we remain committed to identifying and resolving accessibility barriers wherever possible.</p>

                <h2>Third-Party Content and Limitations</h2>
                <p>Some parts of the {{ config('company.brand') }} website may include content, tools, or services provided by <strong>third-party platforms or service providers</strong>. While {{ config('company.brand') }} encourages accessibility standards across all integrations, we do not exercise full control over the accessibility practices of external services. Certain third-party features may not always meet the same accessibility standards as the {{ config('company.brand') }} platform.</p>
                <p>Users who experience accessibility challenges related to third-party content are encouraged to notify us so that we can review potential solutions where feasible.</p>

                <h2>Limitation of Liability</h2>
                <p>{{ config('company.brand') }} makes reasonable efforts to ensure that its website remains accessible and usable in accordance with recognized accessibility standards. However, accessibility compatibility may vary depending on browser configurations, device capabilities, operating systems, assistive technologies, or third-party integrations.</p>
                <p>{{ config('company.brand') }} does not guarantee that every element of the website will always be fully compliant with all accessibility requirements in every technological environment. {{ config('company.brand') }} shall not be held liable for temporary accessibility limitations, technical interruptions, or compatibility issues that arise due to factors beyond its reasonable control.</p>
                <p>Nothing in this Accessibility Statement shall be interpreted as creating legally enforceable rights beyond those required under applicable law.</p>

                <h2>Accessibility Feedback and Support</h2>
                <p>We welcome feedback from users regarding the accessibility of our website. If you encounter any difficulty while accessing {{ config('company.brand') }} content or services, please let us know. Your feedback helps us improve our platform and create a better experience for all users.</p>
                <p>Users may contact us to report:</p>
                <ul>
                    <li>Accessibility barriers</li>
                    <li>Navigation difficulties</li>
                    <li>Screen reader compatibility issues</li>
                    <li>Suggestions for improving website usability</li>
                </ul>
                <p>Our team will make reasonable efforts to review accessibility concerns and respond accordingly.</p>

                <h2>Accessibility and Inclusive Digital Experience</h2>
                <p>At {{ config('company.brand') }}, accessibility goes beyond technical compliance. It reflects our commitment to building a platform that respects diversity and promotes equal access to digital opportunities. We believe that inclusive design benefits everyone — creators, brands, businesses, and visitors alike.</p>
                <p>By continuously improving accessibility standards, {{ config('company.brand') }} aims to ensure that everyone can participate in the digital ecosystem without unnecessary limitations.</p>

                <h2>Accessibility Assistance Program</h2>
                <p>{{ config('company.brand') }} is committed to ensuring that all users are able to access the information, services, and digital experiences provided through the website <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">www.dywix.com</a>. As part of this commitment, {{ config('company.brand') }} maintains an <strong>Accessibility Assistance Program</strong> designed to provide support to users who may experience difficulties accessing certain content or features on the platform.</p>
                <p>The purpose of this program is to offer reasonable assistance to users with disabilities or accessibility needs who may encounter barriers while interacting with the {{ config('company.brand') }} website.</p>

                <h3>Requesting Accessibility Assistance</h3>
                <p>If a user experiences difficulty accessing any part of the {{ config('company.brand') }} website, including content, navigation, or interactive features, they may request assistance through our support channels. Examples include:</p>
                <ul>
                    <li>Difficulty accessing website content using assistive technologies</li>
                    <li>Issues navigating website features through keyboard-only controls</li>
                    <li>Challenges interpreting visual or multimedia content</li>
                    <li>Problems accessing specific information or services on the platform</li>
                </ul>
                <p>Upon receiving a request, {{ config('company.brand') }} will make reasonable efforts to review the accessibility concern and provide appropriate assistance where possible.</p>

                <h3>Types of Assistance That May Be Provided</h3>
                <p>Depending on the nature of the request, {{ config('company.brand') }} may provide assistance through various means, including:</p>
                <ul>
                    <li>Providing alternative access to requested information</li>
                    <li>Offering guidance on how to navigate specific sections of the website</li>
                    <li>Reviewing reported accessibility barriers for potential correction</li>
                    <li>Improving website functionality based on accessibility feedback</li>
                </ul>
                <p>While {{ config('company.brand') }} will endeavor to assist users wherever reasonably possible, the type and scope of assistance may depend on technical feasibility and operational considerations.</p>

                <h3>Response Time</h3>
                <p>{{ config('company.brand') }} aims to review accessibility assistance requests within a <strong>reasonable timeframe</strong> after receiving user feedback. The company will make reasonable efforts to investigate the issue and respond with appropriate guidance or solutions where feasible. Response times may vary depending on the complexity of the concern or the technical nature of the request.</p>

                <h3>Commitment to Continuous Accessibility Support</h3>
                <p>The Accessibility Assistance Program forms part of {{ config('company.brand') }}'s broader commitment to maintaining an inclusive and accessible digital environment. User feedback received through this program helps {{ config('company.brand') }} identify accessibility barriers and prioritize improvements across the platform. We encourage users to report accessibility challenges so that the website can continue evolving toward a more inclusive digital experience.</p>

                <h2>Contact for Accessibility Assistance</h2>
                <p>Users who require accessibility assistance or wish to report accessibility concerns may contact {{ config('company.brand') }} through:</p>
                <p>
                    <strong>Website:</strong> <a href="https://www.dywix.com" target="_blank" rel="noopener noreferrer">www.dywix.com</a><br>
                    <strong>Email:</strong> <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a>
                </p>
                <p>{{ config('company.brand') }} values accessibility feedback and will make reasonable efforts to assist users and improve accessibility across its digital services.</p>
            </div>
        </div>
    </section>
@endsection
