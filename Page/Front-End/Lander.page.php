<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");

    /**
     * This is the initial page object a customer will be taken to when visiting the site.
     */
    class Lander extends FrontEndBase
    {

        /** Testimonials */
        private const TestimonialTitle = "What Our Customers Say";
        private const Testimonials = [
            [
                'thumbnail' => 'Image/Front-End/Review_1.png',
                'review' => 'The box I got had a laser hair remover that I was looking to purchase! It’s an amazing surprise. I sold the earbuds, camera, and solar lights for almost the retail cost because the products are brand new. My box paid for itself, so I got the hair remover I wanted for free!',
                'name' => 'Helen M.'
            ], [
                'thumbnail' => 'Image/Front-End/Review_2.png',
                'review' => 'Cool box! Surprised that it came with actual electronics items, not just a bunch of phone cases and chargers. Got a gaming headset, a projector, a mini drone and a few Christmas stocking gifts. Kept what I wanted and gifted the rest.',
                'name' => 'Peter I.'
            ], [
                'thumbnail' => 'Image/Front-End/Review_3.png',
                'review' => 'This was a last-minute gift for my dad’s birthday. I called in and asked them to expedite my order. My dad got his box in 3 days and was thrilled! He got air purifier, video recorder, projector, keyboard set, and some string lights. I just ordered one for myself! Looking forward to it!',
                'name' => 'T H.'
            ], [
                'thumbnail' => 'Image/Front-End/Review_4.png',
                'review' => 'I’ve been ordering from them for 4 months. I love that everything is brand new and practical, no phone cases or stuff that are hard to resell. I actively resell on eBay and offerup, so I keep those I need and resell the rest. So far, I made my money back and got to keep some awesome gadgets.',
                'name' => 'Laurie Y.'
            ]
        ];
        /** Frequently Asked Questions */
        private const FAQTitle = 'HAVE QUESTIONS? LOOK HERE.';
        private const FAQDescription = 'Here is a list of the most common questions asked about buying from <br />The Mystery Market!';
        private const FAQs = [
            [
                'q' => 'How do you determine retail value?',
                'a' => 'We determine retail value by finding the product on a big retail website such as Target, Best Buy, 
                WalMart or Amazon. Each product in your box will contain a print out clearly showing the price on the 
                retailers website.'
            ],
            [
                'q' => 'How do I know the value of each item?',
                'a' => 'Each product in the box will contain a print out clearly showing price on a big retailers web site 
                such as Target, Best Buy, WalMart or Amazon.'
            ],
            [
                'q' => 'What condition are the products in?',
                'a' => 'All products will be delivered in like-new condition. This means that the products will be 
                un-damaged, 100% working and in the original packaging. Some packaging may be damaged.'
            ],
            [
                'q' => 'When will I get my mystery box?',
                'a' => 'We ship the same day or next business day after you place an order. Typically, you will receive your mystery box 2-5 days after our carrier picks up the packages. '
            ],
            [
                'q' => 'What if I receive some items that I don’t need?',
                'a' => 'All items in our mystery box are brand new. They are resell ready and giftable. You may resell the items to cover the cost of box or gift them to your friends and families.'
            ],
            [
                'q' => 'Is the value of the box guaranteed?',
                'a' => 'Yes! This is a risk-free mystery box. You are guaranteed to receive at least double the value of the box. For a $100 mystery box, you will receive $200+ worth of merchandise.'
            ]
        ];

        /**
         * Constructor method for the basic Lander page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("Landing Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/lander.php")
                ->SetOgDescription("Landing Page")
                ->AddStyleSheet("CSS/Front-End/Funnel.css")
                ->SetBodyHTML(
                    $this->GenerateHeader().
                                '<main>'.
                                    $this->GenerateHeroSection().
                                    $this->GenerateBenefitsSection().
                                    $this->GenerateImproveSection().
                                    $this->GenerateCtaSection().
                                    //$this->GenerateChiropractorSection().
                                    $this->GenerateTreatmentSection().
                                    $this->GenerateTestimonialSection().
                                    $this->GenerateFAQSection().
                                    $this->GenerateBottomCtaSection().
                                '</main>'.
                            $this->GenerateFooter()
                    );
        }

        private function CallToActionButton(string $lineOne ='Unlock $200 Plus Electronics For $100', string $lineTwo = 'While supplies last'): string
        {
            return '
            <a href="index.php?event=LanderToUpsell" class="callToAction btn btn-lg btn"> 
                <i class="fa fa-cart-plus fa-3x pull-left"></i>
                '.$lineOne.'<br />'.$lineTwo.'
            </a>';
        }

        private function GenerateHeroSection(): string
        {
            return '
            <section class="hero-section">
				<div class="container">
					<div class="row">
						<div class="col-12 col-xl-8 text-center">
							<h1 class="text-uppercase text-blue font-weight-bold mb-0" style="font-size: 61px;">Welcome Shoppers</h1>
							<p>
							    The Mystery Market is Southern California\'s leading wholesale liquidation company for resellers. Our no-risk electronics boxes are in high demand, because you are guaranteed to receive merchandise worth at least twice the amount that you pay for the box. All items are hand-picked, only brand new merchandise ready for resell are chosen.
                            </p>
							'.$this->CallToActionButton().'
						</div>
						
					</div>
				</div>
			</section>';
        }

        private function GenerateBenefitsSection(): string
        {
            return '
            <section class="benefits-section">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class="font-weight-bold text-yellow">Why Buy Mystery Boxes From Us</h2>
								<h5 class="text-white font-weight-regular">We only put unused, brand-new items in our boxes. When we get truckloads of merchandise from retailers, our team patiently sorts through each and every item. Items that are heavily used or damaged beyond repair will be disposed of. Those that are gently used or missing packaging will be set aside for our mixed condition lots. Only products that are brand new, in original packaging, and retail ready are selected to be shipped out in our Mystery Boxes. </h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="inner-container left-container">
								<figure class="text-center"> <img src="Image/Front-End/Banner_2.png" alt="100% Natural" class="img-fluid"> </figure>
								<div class="content text-center px-4">
									<h5 class="text-uppercase text-yellow font-weight-bold">100% BRAND NEW</h5>
									<p class="text-white mb-0">Only brand-new items are chosen for our mystery box!</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="inner-container center-container">
								<figure class="text-center"> <img src="Image/Front-End/Banner_3.png" alt="Rapid Relief" class="img-fluid"> </figure>
								<div class="content text-center px-4">
									<h5 class="text-uppercase text-yellow font-weight-bold">NO-RISK AND FUN</h5>
									<p class="text-white mb-0">We guarantee the value of the goods is worth double what you pay for the box!</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="inner-container right-container">
								<figure class="text-center"> <img src="Image/Front-End/Banner_4.png" alt="Covered Visits" class="img-fluid"> </figure>
								<div class="content text-center px-4">
									<h5 class="text-uppercase text-yellow font-weight-bold">RESELLABLE AND GIFTABLE</h5>
									<p class="text-white mb-0">Treat yourself with awesome fun gadgets; gift them to your friends; or resell them to make money!</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateImproveSection(): string
        {
            return '
            <section class="improve-section section-spacer">
				<div class="container">
					<div class="row">
						<div class="col-12 order-2 order-lg-1 col-lg-6 mt-5 mt-lg-0">
							<div class="inner-container left-container">
								<ul>
									<li>
										<span class="d-flex align-items-start">
											<img src="Image/Front-End/Icon_1.svg" alt="IMPROVE YOUR POSTURE" class="img-fluid">
											<span class="d-flex flex-column">
												<h3 class="text-uppercase ">GUARANTEED <span class="text-blue font-weight-bold">VALUE</span></h3>
												<p>When you buy from us, you are NOT gambling with your money. We offer 100% chance of doubling what you pay for the box. It is a safe investment for buyers.</p>
											</span>
										</span>
									</li>
									<li>
										<span class="d-flex align-items-start">
											<img src="Image/Front-End/Icon_2.svg" alt="IMPROVE YOUR HEALTH" class="img-fluid">
											<span class="d-flex flex-column">
												<h3 class="text-uppercase ">GUARANTEED <span class="text-blue font-weight-bold">ELECTRONICS</span></h3>
												<p>Tired of opening your box and finding a bunch of phone cases that don’t even fit your phone? We guarantee absolutely NO phone cases in our box! Our boxes only contain items that are actually electronics – products that require electricity to operate. If it doesn’t use electricity, it doesn’t go in our box!</p>
											</span>
										</span>
									</li>
									<li>
										<span class="d-flex align-items-start">
											<img src="Image/Front-End/Icon_3.svg" alt="IMPROVE YOUR LIFE" class="img-fluid">
											<span class="d-flex flex-column">
												<h3 class="text-uppercase ">GUARANTEED <span class="text-blue font-weight-bold">NEVER USED</span></h3>
												<p>We understand that you don’t want to open a package and see someone’s hair sticking to the product, or find earwax on a pair of earbuds that you are about to put on. Therefore, we only select brand-new, un-used and un-opened merchandise for you!</p>
											</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-12 order-1 order-lg-2 col-lg-6">
							<div class="inner-container right-container">
								<figure class="text-center mb-0"> <img src="Image/Front-End/Banner_5.png" alt="IMPROVE YOUR LIFE" class="img-fluid"> </figure>
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateCtaSection(): string
        {
            return '
            <section class="cta-section">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title mx-auto">
								<h2 class="text-capitalize text-black font-weight-bold d-inline-block position-relative">Shop Smart At <span class="text-underline">The Mystery Market</span></h2>
								<h5 class="text-black font-weight-regular mx-auto">Why pay full price when you can pay half or less? Our contracts with retail stores let us purchase merchandise in large quantity at a discounted rate. We pick the goods that are in brand-new condition, and pass the savings on to you.</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="inner-container text-center">
								'.$this->CallToActionButton().'
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateChiropractorSection(): string
        {
            return '
            <section class="chiropractor-section section-alt-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class=" text-capitalize font-weight-bold">Chiropractors: Fundamental Beliefs and Goals</h2>
								<h5 class="font-weight-regular">Lorem ipsum dolor sit amet, consectetur <span class="font-weight-bold text-underline">adipiscing elit. Sed non enim lectus.</span> Aenean ex, <span class="font-weight-bold text-underline">condimentum in neque et,</span> scelerisque fringilla elit. Vestibulum massa quam</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-7">
							<div class="inner-container left-container">
								<video width="100%" height="auto" poster="Asset/img/home-05.png" controls>
									<source src="https://webdevproof.com/click-funnel-videos/video.mp4" type="video/mp4">
									<source src="https://webdevproof.com/click-funnel-videos/video.webm" type="video/webm">
								</video>
							</div>
						</div>
						<div class="col-12 col-lg-5 mt-4 mt-lg-0">
							<div class="inner-container right-container">
								<p>Sed mattis mi a pharetra venenatis. In vestibulum, nibh nec finibus cursus, enim sem molestie eros, et ultricies enim arcu vel tellus. Ut imperdiet nec finibus cursus, enim sem molestie eros, et ultricies enim arcu vel tellus. Ut imperdiet 
								</p>
								<ul class="mb-0 custom-list-arrow">
									<li>Ut tempus turpis quis diam egestas rutrum.</li>
									<li>Aenean non semper lorem.</li>
									<li>Aliquam bibendum ex vulputate</li>
									<li>Tortor posuere, nec auctor ipsum auctor</li>
									<li>sed, porta mauris. In aliquet</li>
									<li>sed ultricies erat est id</li>
								</ul>
							</div>
						</div>
						<div class="col-12">
							<p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet tincidunt ante, quis eleifend arcu. Cras ut facilisis dui. Vivamus congue, massa id luctus convallis, mauris leo faucibus metus, efficitur vestibulum lectus sem eget eros. Praesent tincidunt nulla ac tellus dignissim, aliquam blandit orci tristique. Quisque feugiat, massa ac vehicula convallis, libero lorem imperdiet ligula, a convallis odio arcu vitae tortor. In feugiat risus ac purus euismod feugiat. Donec a pharetra metus.</p>
							<p class="mb-4">Proin placerat vestibulum aliquet. Donec ac sagittis urna, eu vestibulum augue. Nunc gravida sollicitudin dolor condimentum faucibus. Donec commodo nulla eu efficitur maximus. Vivamus eget massa congue, sagittis magna at, placerat magna.</p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="inner-container certificate border">
								<div class="row">
									<div class="col-12 col-lg-5">
										<div class="left-container">
											<figure class="text-center mb-0">
												<img src="Asset/img/certificate.png" alt="John Doe" class="img-fluid"> 
											</figure>
											<div class="caption bg-blue text-center">
												<h3 class="font-weight-bold text-white">
													John Doe
												</h3>
												<p class="text-white mb-0">
													Board Certified Chiropractor
												</p>
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-7 mt-4 mt-lg-0">
										<div class="right-container">
											<p>Sed mattis mi a pharetra venenatis. In vestibulum, nibh nec finibus cursus, enim sem molestie eros, et ultricies enim arcu vel tellus. Ut imperdiet nec finibus cursus, enim sem molestie eros, et ultricies enim arcu vel tellus. Ut imperdiet 
											</p>
											<ul class="mb-0 custom-list-blue">
												<li><strong>Qualified:</strong> Certified Chiropractors with 70+ years total experience...</li>
												<li><strong>Effective:</strong>​ High quality treatments trigger rapid healing...</li>
												<li><strong>Safe:</strong> Proper procedures used to minimize future damage...</li>
												<li><strong>​Trusted:</strong> Recommended by hundreds of happy clients...</li>
												<li><strong>​Local:</strong> Local: Healing [Boise] area residents for 40+ years...</li>
												<li><strong>​Preferred Provider:</strong> ​Preferred Provider: Working with insurance companies to reduce or eliminate your out of pocket costs...</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</section>';
        }

        private function GenerateTreatmentSection(): string
        {
            return '
            <section class="treatment-section section-alt-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class=" text-capitalize font-weight-bold">More Ways To Enjoy Your Mystery Box</h2>
								<h5 class="font-weight-regular">Don’t you want to know what’s inside your mystery box? Claim your offer to unlock the mystery!</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-3">
							<div class="inner-container item-single">
								<figure class="text-center mb-0"> <img src="Image/Front-End/Banner_7.png" alt="100% Natural" class="img-fluid"> </figure>
								<div class="content text-center">
									<h5 class="text-uppercase font-weight-bold">TREAT YOURSELF</h5>
									<p>You deserve a nice surprise! Treat yourself with this awesome gift for any occasion.</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="inner-container item-single">
								<figure class="text-center mb-0"> <img src="Image/Front-End/Banner_8.png" alt="Rapid Relief" class="img-fluid"> </figure>
								<div class="content text-center">
									<h5 class="text-uppercase font-weight-bold">TREAT YOUR FRIEND</h5>
									<p>Got anyone special you wish to surprise? We’ve got you covered.</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="inner-container item-single">
								<figure class="text-center mb-0"> <img src="Image/Front-End/Banner_9.png" alt="Covered Visits" class="img-fluid"> </figure>
								<div class="content text-center">
									<h5 class="text-uppercase font-weight-bold">TREAT YOUR FAMILY</h5>
									<p>On a budget but want to give your family something nice? We have the solution.</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="inner-container item-single">
								<figure class="text-center mb-0"> <img src="Image/Front-End/Banner_10.png" alt="Covered Visits" class="img-fluid"> </figure>
								<div class="content text-center">
									<h5 class="text-uppercase font-weight-bold">RESELL FOR CASH</h5>
									<p>Reselling is a thriving business during the pandemic. If something doesn’t suit you, resell for cash.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col">
							<div class="inner-container text-center bottom-content">
								<h3 class="text-uppercase text-blue font-weight-bold mb-4">
									BEGIN RELIEVING YOUR PAIN TODAY
								</h3>
								'.$this->CallToActionButton().'
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateTestimonialSection(): string
        {
            $returnString = '
            <section class="testimonial-section section-equal-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class="text-capitalize font-weight-bold mb-0">'.self::TestimonialTitle.'</h2>
							</div>
						</div>
					</div>';
            $index = 0;
            foreach(self::Testimonials as $testimonial)
            {
                if($index == 0 || $index == 2)
                {
                    $returnString .= '<div class="row">';
                }
                $returnString .= '
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-0">
                    <div class="item-single d-flex flex-column flex-md-row">
                        <figure class="mb-0 flex-shrink-0">
                            <img src="'.$testimonial['thumbnail'].'" alt="'.$testimonial['name'].'" class="w-100">
                        </figure>
                        <div class="content">
                            <p class="font-italic">'.$testimonial['review'].'</p>
                            <h3 class="text-uppercase font-weight-bold mb-0">'.$testimonial['name'].'</h3>
                        </div>
                    </div>
                </div>
                ';
                if($index == 1 || $index == 3)
                {
                    $returnString .= '</div>';
                }
                $index++;
            }
			return $returnString.'
                 </div>
			</section>';
        }

        private function GenerateFAQSection(): string
        {
            $returnString = '
            <section class="faq-section section-alt-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class="text-uppercase font-weight-bold">'.self::FAQTitle.'</h2>
								<h5 class="font-weight-regular">'.self::FAQDescription.'</h5>
							</div>
						</div>
						<div class="col-12">
							<div class="accordion">';
            $index = 1;
            foreach(self::FAQs as $faq)
            {
                $returnString .= '
                <div class="accordion-section">
                    <a class="accordion-section-title '.($index==1?'active':'').' " href="#accordion-'.$index.'">'.$faq['q'].'</a>
                    <div id="accordion-'.$index.'" class="accordion-section-content '.($index==1?'open':'').'" '.($index==1?'style="display: block;"':'').'>
                        <p>'.$faq['a'].'</p>
                    </div>
                </div>';
                $index++;
            }
            return $returnString.'	
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateBottomCtaSection(): string
        {
            return '
            <section class="bottom-cta-section">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title mx-auto">
								<h2 class="text-capitalize text-black font-weight-bold">Are you ready to spread the holiday cheer?</span></h2>
								<p class="text-black mt-4 mb-0">Our mystery box is perfect for stocking up presents for the holiday. Each item is hand-picked from truckloads of goods. Only those that are brand new, and in near perfect packaging are chosen for you.
This is the best way to shop for holiday gifts that won’t break the bank.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="inner-container text-center">
								'.$this->CallToActionButton().'
							</div>
						</div>
					</div>
				</div>
			</section>';
        }
    }
}