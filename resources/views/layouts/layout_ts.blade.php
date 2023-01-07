<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-old.css') }}" rel="stylesheet">
    <!-- Favicons -->
    <link rel="shortcut icon" href="https://typeskip.ai/assets/frontend/img/favicon.ico">
    <link rel="icon" href="https://typeskip.ai/assets/frontend/img/favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
{{--    <link rel="stylesheet" href="/{{mix('ts/css/app.css')}}">--}}
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <script type="text/javascript">
        var base_url = "{{ url('/').'/' }}";
    </script>
    <title>@yield('title', 'TypeSkip - Generating Great Content')</title>
    @yield('head')
</head>
<body>
@hasSection('header')
    @yield('header')
@else
@endif


@yield('content')

@hasSection('footer')
    @yield('footer')
@else
    <!--********************************************************
    Footer
    /********************************************************-->
    <footer class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-section">
                        <div class="left-side">
                            <img src="{{asset('/ts/images/logo.svg')}}" alt="logo" />
                            <p class="copyright">Your AI assistant that writes better copy</p>
                        </div>
                        <div class="center footer-links">
                            <div class="box one">
                                <a href="/privacy" target="_blank">Privacy Policy</a>
                            </div>
                            <div class="box three">
                            <a href="/terms" target="_blank">Terms & Conditions</a>
                            </div>
                        </div>
                        <div class="right-side">
                            <h4>Get In Touch</h4>
                            <div class="social-icons">
                                {{--<a href="https://twitter.com/typeskip" target="_blank">
                                    <img src="{{asset('/ts/images/fb.svg')}}" alt="fb" />
                                </a>--}}
                                <a href="https://twitter.com/typeskip" target="_blank">
                                    <img src="{{asset('/ts/images/twitter.svg')}}" alt="twitter" />
                                </a>
                                <a href="https://www.linkedin.com/company/typeskip" target="_blank">
                                    <img src="{{asset('/ts/images/linkden.svg')}}" alt="linkden" />
                                </a>
                                <a href="https://www.instagram.com/typeskip.ai/" target="_blank">
                                    <img src="{{asset('/ts/images/instagram.svg')}}" alt="instagram" />
                                </a>
                            </div>
                            <p class="heart-text">
                    <span class="mw-txt">
                    Made With
                    <span class="heart"><img src="{{asset('/ts/images/heart.svg')}}" alt="heart"/></span> by
                        <a class="mw-link" href="https://twitter.com/RealBasilKhan" target="_blank">@RealBasilKhan</a>
                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row collapse" id="privatePolice">
                <div class="section privacy-banner">
                    <div class="container-fluid">
                        <h1>Privacy Policy</h1>
                        <p class="subpara">Attio takes the security of your data and our infrastructure very seriously. We are committed to providing an environment that is safe, secure, and available to all of our customers all the time.
                        </p>
                    </div>
                </div>

                <div class="section privacy-content">
                    <div class="container-fluid">
                        <div class="index-content-columns w-row">
                            <div id="sticky-anchor"></div>
                            <div class="column-index hide-on-mobile w-col w-col-4 animated" id="sticky" data-wow-delay="1s" data-wow-duration="1s" style="height:2rem">
                                <div class="w-dyn-list">
                                    <div role="list" class="w-dyn-items">

                                        <div role="listitem" class="p3 index-link w-dyn-item"><a href="/legal/privacy" aria-current="page" class="p3 index-link w--current">Privacy Policy</a></div>
                                        <div role="listitem" class="p3 index-link w-dyn-item"><a href="/legal/terms-and-conditions" class="p3 index-link">Terms and Conditions</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="column-content w-col w-col-8">
                                <div class="rich-text w-richtext">
                                    <h2 class="mt-0">1. Introduction</h2>
                                    <p>This Privacy Policy sets out how We, Attio Limited, previously F Stack Limited and also trading as Attio, whose registered office is at Office 25.3, 25 Easton Street, London, WC1X 0DS, England collect and process your personal data and explains your rights in relation to your personal data. If you have any questions about this Privacy Policy or wish to exercise any of your rights in relation to your personal data, you can contact us at this address or by email to support@attio.com. Our preferred contact method is email.</p>
                                    <p>This Privacy Policy affects your legal rights and obligations so please read it carefully. If you do not agree to be bound by this Privacy Policy, please do not provide your personal data to us or request that your employer does not do so.</p>
                                    <p>We may update this Privacy Policy from time to time at our discretion and in particular to reflect any changes in applicable laws. If we do so, and the changes substantially affect your rights or obligations, we shall notify you if we have your email address. Otherwise, you are responsible for regularly reviewing this Privacy Policy so that you are aware of any changes to it.</p>
                                    <p>We may need to collect your personal data because you provide it to us, or because your employer is our client and wishes to set up an account for you to access our platform. In such circumstances, we are the <strong>controller</strong> of your personal data.</p>
                                    <p>Or, we may receive your personal data within our platform because one of our clients has uploaded your details within their account on our platform. In such circumstances, we are the <strong>processor</strong> of your personal data and we shall only process your personal data in accordance with the client’s instructions.</p>
                                    <h2>2. What personal data do we collect and from whom ?</h2>
                                    <p>By <em>personal data</em> we mean identifiable information about you, such as your name, email address, gender, date of birth, mobile and home telephone number and your IP address.</p>
                                    <p>We may obtain <em>special categories</em> of personal data about you if you or a client chooses to provide such data to us. Special categories of personal data are data about your race or ethnic origin, political opinions, religious or philosophical beliefs, trade union membership genetic data, biometric data, data concerning health or sex life or sexual orientation.</p>
                                    <h3>2.1 Data you provide to us</h3>
                                    <p>From time to time you may provide to us personal data. This may be because you wish to:</p>
                                    <ul role="list">
                                        <li>use our website</li>
                                        <li>use our mobile app</li>
                                        <li>apply for a job with us;</li>
                                        <li>provide services to us;</li>
                                        <li>subscribe to receive product update e-mails from us; or</li>
                                        <li>otherwise contact us including with queries, comments or complaints.</li>
                                    </ul>
                                    <p>You may provide personal data to us directly, or to us through our social media platforms.</p>
                                    <p>We shall process all such personal data in accordance with this Privacy Policy. Certain personal data is mandatory to be provided to us in order that we can fulfil your request for example to provide services to you and we shall make this clear to you at the point of collection of the personal data.</p>
                                    <p>All personal data that you provide to us must be true, complete and accurate. At our request, you shall promptly provide evidence of your identity. If you provide us with inaccurate or false data, and we suspect or identify fraud, we will record this and we may also report this. When you contact us by email or post, we may keep a record of the correspondence and we may also record any telephone call we have with you.</p>
                                    <h3>2.2 Data we automatically collect about you</h3>
                                    <p>When you use our website or use our mobile app, we automatically collect and store information about your device and your activities. This information could include:</p>
                                    <ul role="list">
                                        <li>technical information about your device such as type of device, web browser or operating system;</li>
                                        <li>your preferences and settings such as time zone and language; and</li>
                                        <li>how long you used the website / app and which services and features you used.</li>
                                    </ul>
                                    <p>Some of this information is collected using cookies and similar tracking technologies. If you want to find out more about the types of cookies we use, why, and how you can control them, please see our Cookies Policy.</p>
                                    <h3>2.3 Type of data we automatically collect from connected Google Services</h3>
                                    <p>You may choose the option to log in with Google or share access to Gmail, Google Calendar and/or Google Drive in order to access this information from within the Attio application. When you do so we automatically collect and store Google user data:</p>
                                    <ul role="list">
                                        <li>Profile</li>
                                        <li>Name</li>
                                        <li>Email address</li>
                                        <li>E-Mails (content, attachments and meta data)</li>
                                        <li>Calendar</li>
                                        <li>Files</li>
                                    </ul>
                                    <h3>2.4 Data we receive from others</h3>
                                    <p>As set out above, your employer may from time to time provide personal data to us that relates to you so that you can create an account on our platform or one of our suppliers may send us personal data which we upload into our platform.</p>
                                    <p>We may also receive personal data about you from our payment providers and our website security service partners, particularly if there is any misuse of the platform including the introduction of viruses or other malicious software.</p>
                                    <p>If you apply for a job with us, we may receive personal data about you from your previous employer or other reference.</p>
                                    <h2>3. Lawful use of your personal data</h2>
                                    <p>We will only use your personal data where we have a lawful basis to do so. The lawful purposes that we rely on under this Privacy Policy are:</p>
                                    <ul role="list">
                                        <li>consent (where you choose to provide it and never for data from connected Google Services);</li>
                                        <li>performance of our contract with you;</li>
                                        <li>compliance with legal requirements; and</li>
                                        <li>legitimate interests. When we refer to legitimate interests we mean our legitimate business interests in the normal running of our business which do not materially impact your rights, freedom or interests.</li>
                                    </ul>
                                    <p>We will only use your personal data where we have a lawful basis to do so. How we use your personal data depends on why we have collected it:</p>
                                    <h3>3.1 Using data from your employer who uses Attio</h3>
                                    <p>If we have received your personal data because you are employed at a company that uses Attio as its CRM we will process your personal data to perform any contract we have entered into with your employer or in relation to any steps we take at the request of your employer prior to entering into a contract. Typically, this includes creating a user account for you so that you can access the Attio application.</p>
                                    <h3>3.2 Using data from connected Google Services</h3>
                                    <p>If we have received your personal data because you have chosen to <strong>Sign in with Google</strong> we will process your personal data to perform any contract we have entered into with your employer or in relation to any steps we take at the request of your employer prior to entering into a contract. In particular, this includes providing you with access to the Attio application.</p>
                                    <p>Attio is providing a customer relationship management (CRM) and task management application aimed at business customers. If we have received personal data because you have chosen to connect your Google Drive, Google Calendar and/or your Gmail account we will collect your data from this service in order to enhance the email, file and contact management experience and improve your productivity when using the Attio application. In particular, this includes access to your Google user data from within in the Attio application where you can view your data in the relevant context of a CRM software application and manage your professional relationships.</p>
                                    <p><strong>Additional Limits on Use of Your Google User Data:</strong></p>
                                    <p>Notwithstanding anything else in this Privacy Policy, if you provide us with access to data from connected Google services, our use of that data will be subject to these additional restrictions:</p>
                                    <ul role="list">
                                        <li>We will only use access to data from a connected Google Service to provide our Attio web and mobile CRM and task management application that allows users to read, process and write emails, access their Google Drive files and calendar. Furthermore, our use of data is limited to providing or improving user-facing features that are prominent in the requesting application’s user interface.</li>
                                        <li>We will not transfer this data to others unless doing so is necessary to provide and improve features that are prominent in the user interface, comply with applicable law, or as part of a merger, acquisition, or sale of assets.</li>
                                        <li>We will never use Google User data for serving advertisements, including retargeting, personalized, or interest-based advertising.</li>
                                        <li>We will not allow humans to read this data unless we have your affirmative agreement for specific messages, doing so is necessary for security purposes such as investigating abuse, to comply with applicable law, or for our internal operations and even then only when the data have been aggregated and anonymized.</li>
                                        <li>Attio’s use of information received, and Attio’s transfer of information to any other app, from Google APIs will adhere to Google’s Limited Use Requirements.</li>
                                    </ul>
                                    <h3>3.3 Using data you uploaded or entered into the Attio application</h3>
                                    <p>If we have received your personal data because you uploaded it to our platform, we shall process that personal data for our legitimate interests and on your instructions.</p>
                                    <h3>3.4 Using data for our legitimate interests</h3>
                                    <p>We may also use your personal data for our legitimate interests, including dealing with any customer services you require, for regulatory and legal purposes (for example anti-money laundering and fraud prevention purposes), for audit purposes and to contact you about changes to this Privacy Policy.</p>
                                    <h3>3.5 Using data to provide Product Update E-Mails</h3>
                                    <p>You may consent to receive product update email messages from us. You can choose to no longer receive marketing emails from us by contacting us or clicking unsubscribe in the email. Please note that it may take us a few days to update our records to reflect your request.</p>
                                    <p>If you ask us to remove you from our product update mailing list, we shall keep a record of your name and email address to ensure that we do not send to you anymore product update information. We shall also continue to send you information relating to your use of our services if your employer has an account with us.</p>
                                    <h3>3.6 Using data to improve our service</h3>
                                    <p>We also analyze data usage of our platform, and use that information to improve our services and platform for our legitimate interests. Please see our Cookies Policy for detailed information.</p>
                                    <h3>3.7 Using data to process job applications</h3>
                                    <p>If you apply for a job with us, we shall use the personal data you provide to process your application and respond to you according.</p>
                                    <h2>4. Who do we share your data with?</h2>
                                    <p>For our legitimate interests, we may share your personal data with any service providers, sub-contractors and agents that we may appoint to perform functions on our behalf and in accordance with our instructions, including payment providers, IT service providers, accountants, auditors and lawyers. We shall provide our service providers, sub-contractors and agents only with such of your personal data as they need to provide the service for us and if we stop using their services, we shall request that they delete your personal data or make it anonymous within their systems.</p>
                                    <p>In order to comply with our legal obligations, under certain circumstances we may have to disclose your personal data under applicable laws and/or regulations, for example, as part of anti-money laundering processes or to protect a third party's rights, property, or safety.</p>
                                    <p>For our legitimate interests, we may also share your personal data in connection with, or during negotiations of, any merger, sale of assets, consolidation or restructuring, financing, or acquisition of all or a portion of our business by or into another company in which case we will send a notice to our users.</p>
                                    <h2>5. Where we hold and process your personal data</h2>
                                    <p>Some or all of your personal data may be stored or transferred outside of the European Economic Area (the <strong>EEA</strong> ) for any reason, including for example, if our email server is located in a country outside the EEA or if any of our service providers are based outside of the EEA.</p>
                                    <p>Where your personal data is transferred outside the EEA, it will only be transferred to countries that have been identified as providing adequate protection for EEA data or to a third party where we have approved transfer mechanisms in place to protect your personal data – i.e., by entering into the European Commission's <a href="https://ec.europa.eu/info/law/law-topic/data-protection/data-transfers-outside-eu/model-contracts-transfer-personal-data-third-countries_en">Standard Contract Clauses</a>, or by ensuring the entity is <a href="https://www.privacyshield.gov/welcome">Privacy Shield certified</a> (for transfers to US-based third parties).</p>
                                    <p>Please contact us on the email address set out in clause 10 if you require further information on the specific mechanism that we use when transferring your personal data outside of the EEA under this paragraph.</p>
                                    <h2>6. Security</h2>
                                    <p>We shall process your personal data in a manner that ensures appropriate security of the personal data, including protection against unauthorized or unlawful processing and against accidental loss, destruction or damage. We do this by using appropriate technical or organizational measures, for example, all information you provide to us is stored on our secure servers and our employees are required to comply with all applicable data protection laws.</p>
                                    <p>If you are our client and you wish to send to us personal data to host on our platform, we shall both comply with our Information Transfer Policy.</p>
                                    <p>Notwithstanding the above, you acknowledge that no system can be completely secure. Therefore, although we take these steps to secure your personal data, we do not promise that your personal data will always remain completely secure. If there is a security breach, we will do all that we can as soon as we can to stop the breach and minimize the loss of any data.</p>
                                    <h2>7. Your rights</h2>
                                    <p>You have a number of rights under applicable data protection legislation. Some of these rights are complex, and not all of the details have been included below. Further information can be found <a href="https://ico.org.uk/your-data-matters/">here</a>.</p>
                                    <ul role="list">
                                        <li>Right of access: You have the right to obtain from us a copy of the personal data that we hold for you.</li>
                                        <li>Right to rectification: You can require us to correct errors in the personal data that we process for you if it is inaccurate, incomplete or out of date.</li>
                                        <li>Right to portability: You can request that we transfer your personal data to another service provider.</li>
                                        <li>Right to restriction of processing: In certain circumstances, you have the right to require that we restrict the processing of your personal information.</li>
                                        <li>Right to be forgotten: You also have the right at any time to require that we delete the personal data that we hold for you, where it is no longer necessary for us to hold it. However, whilst we respect your right to be forgotten, we may still retain your personal data in accordance with applicable laws.</li>
                                        <li>Right to stop receiving marketing information: You can ask us to stop sending you information about our services, but please note we shall continue to contact you in relation to any matters relating to your report.</li>
                                    </ul>
                                    <p>We reserve the right to charge an administrative fee if your request in relation to your rights is manifestly unfounded or excessive.</p>
                                    <p>We may need to request specific information from you to help us to confirm your identity and ensure your right to access your personal data or to exercise any other right. We may also contact you to ask you for further information in relation to your request so we can deal with it promptly.</p>
                                    <p>If we are a processor of your data (and our client is the controller) we shall only process your personal data as instructed by our client. You will need to contact our client directly if you wish to exercise your rights in relation to the data processed on our platform. If you do contact us directly, we will notify our client as soon as reasonably practical and assist our client as the controller by taking appropriate measures to enable the fulfillment of our obligations to you.</p>
                                    <p>If you have any complaints in relation to this Privacy Policy or otherwise in relation to our processing of your personal data, please tell us. We shall review and investigate your complaint and try to get back to you within a reasonable time. You can also contact the Information Commissioner, see <a href="http://www.ico.org.uk/">www.ico.org.uk</a> or if you are based outside of the United Kingdom, please contact your local regulatory authority.</p>
                                    <h2>8. Retention of personal data</h2>
                                    <p>We will retain personal data in accordance with applicable laws.</p>
                                    <p>If we have received your personal data because you are an employee of a client, we shall retain your personal data until we no longer work with your employer, except where we are required to retain personal data for a particular period of time to comply with legal, auditory or statutory requirements, including requirements of HMRC in respect of financial documents.</p>
                                    <p>If we have your personal data because a client has uploaded it to our platform, we shall retain it in accordance with our client's instructions.</p>
                                    <h2>9. General</h2>
                                    <p>If any provision of this Privacy Policy is held by a court of competent jurisdiction to be invalid or unenforceable, then such provision shall be construed, as nearly as possible, to reflect the intentions of the parties and all other provisions shall remain in full force and effect.</p>
                                    <p>This Privacy Policy shall be governed by and construed in accordance with the law of England and Wales, and you agree to submit to the exclusive jurisdiction of the English Courts.</p>
                                    <h2>10. How to Contact Us</h2>
                                    <p>You can contact us with any questions or comments about your Personal Data, this Policy or any other privacy related enquiries by emailing support@attio.com.</p>
                                    <p>Last updated: April 2020</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="bottom-bar-line section">
    </div>
@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://typeskip.ai/assets/frontend/js/custom-google-animation.js"></script>
<script src="{{asset('ts/js/wow.min.js')}}"></script>
<script src="{{asset('assets/custom/js/user.js') }}"></script>
<script src="{{asset('js/paywithstripe.js')}}"></script>
{{--<script src="/{{mix('js/app.js')}}"></script>--}}
<script src="{{asset('ts/js/app.js')}}"></script>
<script src="//code.tidio.co/rftuxxddgmhuhvmvv96t2rwkksspyi45.js" async></script>

@stack('body-scripts')
</body>
</html>

