<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");
    use TheMysteryMarket\Page\FrontEnd\FrontEndBase;

    /**
     * This is the initial page object a customer will be taken to when visiting the site.
     */
    class TermsAndConditions extends FrontEndBase
    {
        /**
         * Constructor method for the basic Lander page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: Privacy Policy")
                ->SetDescription("Landing Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/lander.php")
                ->SetOgDescription("Landing Page")
                ->SetBodyClass("terms-conditions-page")
                ->SetBodyHTML(
                    $this->GenerateHeader() .
                    '<main>' .
                    $this->GeneratePage().
                    '</main>' .
                    $this->GenerateFooter()
                );
        }

        private function GeneratePage(): string
        {
            return '
            <div class="content-section section-alt-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class=" text-capitalize font-weight-bold">Terms and Conditions</h2>
								<h5 class="font-weight-regular">Last updated: September 17, 2021</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="inner-container">

<p>Please read these terms and conditions carefully before using Our Service.</p>
<h1>Interpretation and Definitions</h1>
<h2>Interpretation</h2>
<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
<h2>Definitions</h2>
<p>For the purposes of these Terms and Conditions:</p>
<ul>
<li>
<p><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</p>
</li>
<li>
<p><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</p>
</li>
<li>
<p><strong>Country</strong> refers to: California,  United States</p>
</li>
<li>
<p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Binary Solutions LLC, Temecula, CA 92592.</p>
</li>
<li>
<p><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
</li>
<li>
<p><strong>Goods</strong> refer to the items offered for sale on the Service.</p>
</li>
<li>
<p><strong>Orders</strong> mean a request by You to purchase Goods from Us.</p>
</li>
<li>
<p><strong>Service</strong> refers to the Website.</p>
</li>
<li>
<p><strong>Subscriptions</strong> refer to the services or access to the Service offered on a subscription basis by the Company to You.</p>
</li>
<li>
<p><strong>Terms and Conditions</strong> (also referred as &quot;Terms&quot;) mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service.</p>
</li>
<li>
<p><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</p>
</li>
<li>
<p><strong>Website</strong> refers to The Mystery Market, accessible from <a href="https://www.themysterymarket.com" rel="external nofollow noopener" target="_blank">https://www.themysterymarket.com</a></p>
</li>
<li>
<p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
</li>
</ul>
<h1>Acknowledgment</h1>
<p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
<p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>
<p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.</p>
<p>You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>
<p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>
<h1>Placing Orders for Goods</h1>
<p>By placing an Order for Goods through the Service, You warrant that You are legally capable of entering into binding contracts.</p>
<h2>Your Information</h2>
<p>If You wish to place an Order for Goods available on the Service, You may be asked to supply certain information relevant to Your Order including, without limitation, Your name, Your email, Your phone number, Your credit card number, the expiration date of Your credit card, Your billing address, and Your shipping information.</p>
<p>You represent and warrant that: (i) You have the legal right to use any credit or debit card(s) or other payment method(s) in connection with any Order; and that (ii) the information You supply to us is true, correct and complete.</p>
<p>By submitting such information, You grant us the right to provide the information to payment processing third parties for purposes of facilitating the completion of Your Order.</p>
<h2>Order Cancellation</h2>
<p>We reserve the right to refuse or cancel Your Order at any time for certain reasons including but not limited to:</p>
<ul>
<li>Goods availability</li>
<li>Errors in the description or prices for Goods</li>
<li>Errors in Your Order</li>
</ul>
<p>We reserve the right to refuse or cancel Your Order if fraud or an unauthorized or illegal transaction is suspected.</p>
<h3>Your Order Cancellation Rights</h3>
<p>Any Goods you purchase can only be returned in accordance with these Terms and Conditions and Our Returns Policy.</p>
<p>Our Returns Policy forms a part of these Terms and Conditions. Please read our Returns Policy to learn more about your right to cancel Your Order.</p>
<p>Your right to cancel an Order only applies to Goods that are returned in the same condition as You received them. You should also include all of the products instructions, documents and wrappings. Goods that are damaged or not in the same condition as You received them or which are worn simply beyond opening the original packaging will not be refunded. You should therefore take reasonable care of the purchased Goods while they are in Your possession.</p>
<p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.</p>
<p>You will not have any right to cancel an Order for the supply of any of the following Goods:</p>
<ul>
<li>The supply of Goods made to Your specifications or clearly personalized.</li>
<li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.</li>
<li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.</li>
<li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.</li>
<li>The supply of digital content which is not supplied on a tangible medium if the performance has begun with Your prior express consent and You have acknowledged Your loss of cancellation right.</li>
</ul>
<h2>Availability, Errors and Inaccuracies</h2>
<p>We are constantly updating Our offerings of Goods on the Service. The Goods available on Our Service may be mispriced, described inaccurately, or unavailable, and We may experience delays in updating information regarding our Goods on the Service and in Our advertising on other websites.</p>
<p>We cannot and do not guarantee the accuracy or completeness of any information, including prices, product images, specifications, availability, and services. We reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice.</p>
<h2>Prices Policy</h2>
<p>The Company reserves the right to revise its prices at any time prior to accepting an Order.</p>
<p>The prices quoted may be revised by the Company subsequent to accepting an Order in the event of any occurrence affecting delivery caused by government action, variation in customs duties, increased shipping charges, higher foreign exchange costs and any other matter beyond the control of the Company. In that event, You will have the right to cancel Your Order.</p>
<h2>Payments</h2>
<p>All Goods purchased are subject to a one-time payment. Payment can be made through various payment methods we have available, such as Visa, MasterCard, Affinity Card, American Express cards or online payment methods (PayPal, for example).</p>
<p>Payment cards (credit cards or debit cards) are subject to validation checks and authorization by Your card issuer. If we do not receive the required authorization, We will not be liable for any delay or non-delivery of Your Order.</p>
<h1>Subscriptions</h1>
<h2>Subscription period</h2>
<p>The Service or some parts of the Service are available only with a paid Subscription. You will be billed in advance on a recurring and periodic basis (such as daily, weekly, monthly or annually), depending on the type of Subscription plan you select when purchasing the Subscription.</p>
<p>At the end of each period, Your Subscription will automatically renew under the exact same conditions unless You cancel it or the Company cancels it.</p>
<h2>Subscription cancellations</h2>
<p>You may cancel Your Subscription renewal either through Your Account settings page or by contacting the Company.
You will not receive a refund for the fees You already paid for Your current Subscription period and You will be able to access the Service until the end of Your current Subscription period.</p>
<h2>Billing</h2>
<p>You shall provide the Company with accurate and complete billing information including full name, address, state, zip code, telephone number, and a valid payment method information.</p>
<p>Should automatic billing fail to occur for any reason, the Company will issue an electronic invoice indicating that you must proceed manually, within a certain deadline date, with the full payment corresponding to the billing period as indicated on the invoice.</p>
<h2>Fee Changes</h2>
<p>The Company, in its sole discretion and at any time, may modify the Subscription fees. Any Subscription fee change will become effective at the end of the then-current Subscription period.</p>
<p>The Company will provide You with reasonable prior notice of any change in Subscription fees to give You an opportunity to terminate Your Subscription before such change becomes effective.</p>
<p>Your continued use of the Service after the Subscription fee change comes into effect constitutes Your agreement to pay the modified Subscription fee amount.</p>
<h2>Refunds</h2>
<p>Except when required by law, paid Subscription fees are non-refundable.</p>
<p>Certain refund requests for Subscriptions may be considered by the Company on a case-by-case basis and granted at the sole discretion of the Company.</p>
<h1>User Accounts</h1>
<p>When You create an account with Us, You must provide Us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of Your account on Our Service.</p>
<p>You are responsible for safeguarding the password that You use to access the Service and for any activities or actions under Your password, whether Your password is with Our Service or a Third-Party Social Media Service.</p>
<p>You agree not to disclose Your password to any third party. You must notify Us immediately upon becoming aware of any breach of security or unauthorized use of Your account.</p>
<p>You may not use as a username the name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of another person or entity other than You without appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.</p>
<h1>Links to Other Websites</h1>
<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by the Company.</p>
<p>The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>
<p>We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services that You visit.</p>
<h1>Termination</h1>
<p>We may terminate or suspend Your Account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>
<p>Upon termination, Your right to use the Service will cease immediately. If You wish to terminate Your Account, You may simply discontinue using the Service.</p>
<h1>Limitation of Liability</h1>
<p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven\'t purchased anything through the Service.</p>
<p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
<p>Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party\'s liability will be limited to the greatest extent permitted by law.</p>
<h1>&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h1>
<p>The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>
<p>Without limiting the foregoing, neither the Company nor any of the company\'s provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
<p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>
<h1>Governing Law</h1>
<p>The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
<h1>Disputes Resolution</h1>
<p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>
<h1>For European Union (EU) Users</h1>
<p>If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which you are resident in.</p>
<h1>United States Federal Government End Use Provisions</h1>
<p>If You are a U.S. federal government end user, our Service is a &quot;Commercial Item&quot; as that term is defined at 48 C.F.R. §2.101.</p>
<h1>United States Legal Compliance</h1>
<p>You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
<h1>Severability and Waiver</h1>
<h2>Severability</h2>
<p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>
<h2>Waiver</h2>
<p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Terms shall not effect a party\'s ability to exercise such right or require such performance at any time thereafter nor shall be the waiver of a breach constitute a waiver of any subsequent breach.</p>
<h1>Translation Interpretation</h1>
<p>These Terms and Conditions may have been translated if We have made them available to You on our Service.
You agree that the original English text shall prevail in the case of a dispute.</p>
<h1>Changes to These Terms and Conditions</h1>
<p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days\' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
<p>By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.</p>
<h1>Contact Us</h1>
<p>If you have any questions about these Terms and Conditions, You can contact us:</p>
<ul>
<li>
<p>By email: webmaster@themysterymarket.com</p>
</li>
<li>
<p>By phone number: (928) 583-2032</p>
</li>
</ul>
							
							
							</div>
						</div>
					</div>
				</div>
			</div>';
        }
    }
}