(function( window, undefined ){
    window.Checkout = {
        _Stripe: null,
        _StripeElements: null,
        _StripeStyle: {
            base: {
                fontWeight: 400,
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                lineHeight: '1.4',
                color: '#555',
                backgroundColor: '#fff',
                '::placeholder': {
                    color: '#888',
                },
            },
            invalid: {
                color: '#eb1c26',
            }
        },

        _CardElement: null,
        _CardExpiration: null,
        _CardCvv: null,

        _FirstNameElement: null,
        _MiddleNameElement: null,
        _LastNameElement: null,
        _EmailAddressElement: null,
        _EmailAddressVerificationElement: null,
        _PhoneNumberElement: null,

        _BillingAddressElement: null,
        _BillingAptElement: null,
        _BillingCityElement: null,
        _BillingStateElement: null,
        _BillingZipElement: null,

        _ShippingAddressElement: null,
        _ShippingAptElement: null,
        _ShippingCityElement: null,
        _ShippingStateElement: null,
        _ShippingZipElement: null,

        _StripeErrorContainer: null,
        _PersonalErrorContainer: null,
        _BillingErrorContainer: null,
        _ShippingErrorContainer: null,
        _PaymentForm: null,

        Initialize: function(){
            /** Setup Stripe */
            this._Stripe = Stripe('pk_live_51JWRdIFQVRu14XNu7O1Bm0vVux1HdTEU0lscQGIWByozGf3audkAinxb5WvaEgUVVSqTkED7QK1946bDwXqOAbk200wlCMYhHB');
            this._StripeElements = this._Stripe.elements();
            /** Bind the stripe elements */
            this._CardElement = this._StripeElements.create('cardNumber', {'style': self._StripeStyle});
            this._CardElement.mount('#card_number');
            this._CardExpiration = this._StripeElements.create('cardExpiry', {'style': self._StripeStyle});
            this._CardExpiration.mount('#expiration_date');
            this._CardCvv = this._StripeElements.create('cardCvc', {'style': self._StripeStyle});
            this._CardCvv.mount('#cvv');

            this._FirstNameElement = document.getElementById('first_name');
            this._MiddleNameElement = document.getElementById('middle_name');
            this._LastNameElement = document.getElementById('last_name');
            this._EmailAddressElement = document.getElementById('email_address');
            this._EmailAddressVerificationElement = document.getElementById('email_address_verification');
            this._PhoneNumberElement = document.getElementById('phone_number');

            this._BillingAddressElement = document.getElementById('billing_address_1');
            this._BillingAptElement = document.getElementById('billing_address_2');
            this._BillingCityElement = document.getElementById('billing_city');
            this._BillingStateElement = document.getElementById('billing_state');
            this._BillingZipElement = document.getElementById('billing_zip');

            this._ShippingAddressElement = document.getElementById('shipping_address_1');
            this._ShippingAptElement = document.getElementById('shipping_address_2');
            this._ShippingCityElement = document.getElementById('shipping_city');
            this._ShippingStateElement = document.getElementById('shipping_state');
            this._ShippingZipElement = document.getElementById('shipping_zip');

            this._PaymentForm = document.getElementById('paymentForm');

            /** Define the error containers */
            this._StripeErrorContainer = document.getElementById('stripe_errors');
            this._PersonalErrorContainer = document.getElementById('personal_errors');
            this._BillingErrorContainer = document.getElementById('billing_errors');
            this._ShippingErrorContainer = document.getElementById('shipping_errors');

            /** Bind the event listeners. */
            this._PaymentForm.addEventListener('submit', this.OnSubmitClick.bind(this));
            this._CardElement.addEventListener('change', this.OnCardElementChange.bind(this));

        },
        OnCardElementChange: function(event){
            if(event.error)
            {
                this.DisplayError(event.error.message, this._StripeErrorContainer);
            }
            else {
                this._StripeErrorContainer.innerHTML = "";
            }

        },
        OnSubmitClick: function(event){
            event.preventDefault();
            if(this.IsValidFormInput())
            {
                this.CreateStripeToken();
            }
        },
        SubmitForm: function(){
            this._PaymentForm.submit();
        },
        IsValidFormInput: function(){
            this.ClearAllErrors();
            if(this._FirstNameElement.value === "")
            {
                this.DisplayError("First name is required!", this._PersonalErrorContainer);
                return false;
            }
            if(this._LastNameElement.value === "")
            {
                this.DisplayError("Last name is required!", this._PersonalErrorContainer);
                return false;
            }
            if(this._EmailAddressElement.value === "")
            {
                this.DisplayError("Email Address is required!", this._PersonalErrorContainer)
                return false;
            }
            if(this._EmailAddressVerificationElement.value === "")
            {
                this.DisplayError("Verify Email Address is required!", this._PersonalErrorContainer);
                return false;
            }
            if(this._EmailAddressElement.value.toLowerCase() !== this._EmailAddressVerificationElement.value.toLowerCase())
            {
                this.DisplayError("Email address and verification email address must match!", this._PersonalErrorContainer);
                return false;
            }
            /** Sanitize the phone number */
            let phoneNumber = this._PhoneNumberElement.value
            phoneNumber = phoneNumber.replace(/\D/g,'');
            this._PhoneNumberElement.value = phoneNumber;
            if(phoneNumber === "")
            {
                this.DisplayError("Phone number is required", this._PersonalErrorContainer);
                return false;
            }
            if(phoneNumber.length !== 10)
            {
                this.DisplayError("Phone number must be exactly 10 digits!", this._PersonalErrorContainer);
                return false;
            }
            if(this._BillingAddressElement.value === "")
            {
                this.DisplayError("Address is required!", this._BillingErrorContainer);
                return false;
            }
            if(this._BillingCityElement.value === "")
            {
                this.DisplayError("City is required!", this._BillingErrorContainer);
                return false;
            }
            if(this._BillingStateElement.value === "")
            {
                this.DisplayError("Please select a state!", this._BillingErrorContainer);
                return false;
            }
            /** Sanitize billing zip code */
            let billingZipCode = this._BillingZipElement.value
            billingZipCode = billingZipCode.replace(/\D/g,'');
            this._BillingZipElement.value = billingZipCode;
            if(billingZipCode.length !== 5)
            {
                this.DisplayError("Zip code must be exactly 5 digits!", this._BillingErrorContainer);
                return false;
            }
            if(this._ShippingAddressElement.value === "")
            {
                this.DisplayError("Address is required!", this._ShippingErrorContainer);
                return false;
            }
            if(this._ShippingCityElement.value === "")
            {
                this.DisplayError("City is required!", this._ShippingErrorContainer);
                return false;
            }
            if(this._ShippingStateElement.value === "")
            {
                this.DisplayError("Please select a state!", this._ShippingErrorContainer);
                return false;
            }
            /** Sanitize shipping zip code */
            let shippingZipCode = this._ShippingZipElement.value
            shippingZipCode = shippingZipCode.replace(/\D/g,'');
            this._ShippingZipElement.value = shippingZipCode;
            if(shippingZipCode.length !== 5)
            {
                this.DisplayError("Zip code must be exactly 5 digits!", this._ShippingErrorContainer);
                return false;
            }
            return true;
        },
        CreateStripeToken: function(){
            this._Stripe.createToken(this._CardElement).then(this.CreateStripeTokenHandler.bind(this));
        },
        CreateStripeTokenHandler: function(event){
            if(event.error)
            {
                this.DisplayError(event.error.message, this._StripeErrorContainer);
            } else {
                this.AddHiddenStripeToken(event.token);
                this.SubmitForm();
            }
        },
        AddHiddenStripeToken: function(token){
            let hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripe_token');
            hiddenInput.setAttribute('value', token.id);
            this._PaymentForm.appendChild(hiddenInput);
        },
        DisplayError: function(errorMessage, errorTarget){
            errorTarget.innerHTML =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                '  ' + errorMessage +'\n' +
                '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '    <span aria-hidden="true">&times;</span>\n' +
                '  </button>\n' +
                '</div>';
        },
        ClearAllErrors: function(){
            this._StripeErrorContainer.innerHTML = "";
            this._PersonalErrorContainer.innerHTML = "";
            this._BillingErrorContainer.innerHTML = "";
            this._ShippingErrorContainer.innerHTML = "";
        }
    };
    window.Checkout.Initialize();
})(window);