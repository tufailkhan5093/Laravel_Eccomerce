


<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form wire:submit.prevent="placeOrder()">
            <div class="row">

                <div class="col-md-12">

                    <div class="wrap-address-billing">
                        <h3 class="box-title">Billing Address</h3>
                        <div class="billing-address">
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input wire:model="firstname"  type="text" name="fname" value="" placeholder="Your name">
                                 @error('firstname')<span class="text-danger">{{$message}}</span>@enderror   
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input wire:model="lastname"  type="text" name="lname" value="" placeholder="Your last name">
                                @error('lastname')<span class="text-danger">{{$message}}</span>@enderror   
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input wire:model="email"  type="email" name="email" value="" placeholder="Type your email">
                                @error('email')<span class="text-danger">{{$message}}</span>@enderror   
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input wire:model="mobile"  type="number" name="phone" value="" placeholder="10 digits format">
                                @error('mobile')<span class="text-danger">{{$message}}</span>@enderror   
                            </p>
                            <p class="row-in-form">
                                <label for="add">Line 1:</label>
                                <input wire:model="line1"  type="text" name="add" value="" placeholder="Line 1">
                                @error('line1')<span class="text-danger">{{$message}}</span>@enderror   
                            </p>

                            <p class="row-in-form">
                                <label for="add">Line 2:</label>
                                <input wire:model="line2"  type="text" name="add" value="" placeholder="Line 2">
                                @error('line2')<span class="text-danger">{{$message}}</span>@enderror
                            </p>

                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input wire:model="country"  type="text" name="country" value="" placeholder="United States">
                                @error('country')<span class="text-danger">{{$message}}</span>@enderror
                            </p>

                            <p class="row-in-form">
                                <label for="country">Province<span>*</span></label>
                                <input wire:model="province"  type="text" name="country" value="" placeholder="United States">
                            </p>

                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input wire:model="city"  type="text" name="city" value="" placeholder="City name">
                                @error('city')<span class="text-danger">{{$message}}</span>@enderror
                            </p>

                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input wire:model="zipcode"  type="number" name="zip-code" value="" placeholder="Your postal code">
                                @error('zipcode')<span class="text-danger">{{$message}}</span>@enderror
                            </p>
                           
                            <p class="row-in-form fill-wife">
                               
                                <label class="checkbox-field">
                                    <input wire:model="ship_to_different" name="different-add" id="different-add" value="1" type="checkbox">
                                    <span>Ship to a different address?</span>
                                </label>
                            </p>
                        </div>
                    </div>

                </div>
           

                @if($ship_to_different)
                
                <div class="col-md-12">

                    <div class="wrap-address-billing">
                        <h3 class="box-title">Shipping Address</h3>
                        <div class="billing-address">
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input wire:model="s_firstname"  type="text" name="fname" value="" placeholder="Your name">
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input wire:model="s_lastname"  type="text" name="lname" value="" placeholder="Your last name">
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input wire:model="s_email"  type="email" name="email" value="" placeholder="Type your email">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input wire:model="s_mobile"  type="number" name="phone" value="" placeholder="10 digits format">
                            </p>
                            <p class="row-in-form">
                                <label for="add">line 1:</label>
                                <input wire:model="s_line1"  type="text" name="add" value="" placeholder="Line 1">
                            </p>

                            <p class="row-in-form">
                                <label for="add">line 2:</label>
                                <input wire:model="s_line2"  type="text" name="add" value="" placeholder="LIne 2">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input wire:model="s_country"  type="text" name="country" value="" placeholder="Country">
                            </p>

                            <p class="row-in-form">
                                <label for="country">Province<span>*</span></label>
                                <input wire:model="s_province"  type="text" name="country" value="" placeholder="Province">
                            </p>

                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input wire:model="s_zipcode"  type="number" name="zip-code" value="" placeholder="Your postal code">
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input wire:model="s_city"  type="text" name="city" value="" placeholder="City name">
                            </p>
                          
                        </div>
                    </div>

                </div>

                @endif
            </div>
          
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">

                <h4>Payment Method</h4>

                @if($paymentmode == 'card')
                   <div class="wrap-address-billing">
                   @if(Session::has('stripe_error'))

                    <div class="alert alert-danger">{{Session::get('stripe_error')}}</div
                   @endif
                         <p class="row-in-form">
                                <label for="zip-code">Cart No</label>
                                <input wire:model="card_no"  type="text" name="zip-code" value="" placeholder="Card No">
                        </p>


                         <p class="row-in-form">
                                <label for="zip-code">Expiry Month</label>
                                <input wire:model="month"  type="text" name="month" value="" placeholder="Expiry Month">
                        </p>


                         <p class="row-in-form">
                                <label for="zip-code">Expiry Year</label>
                                <input wire:model="year"  type="text" name="year" value="" placeholder="Expiry Year">
                        </p>


                         <p class="row-in-form">
                                <label for="zip-code">CVC</label>
                                <input wire:model="cvc"  type="password" name="cvc" value="" placeholder="CVC">
                        </p>
                   <div>
                @endif
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-bank" value="cod" type="radio" wire:model="paymentmode">
                            <span>Cash on Delivery</span>
                            <span class="payment-desc">Order Now Pay on Delivery</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-visa" value="card" type="radio" wire:model="paymentmode">
                            <span>Credit / Debit Card</span>
                            <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio" wire:model="paymentmode">
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                        @error('paymentmode')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    @if(Session::has('checkout'))
                    <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">${{Session::get('checkout')['total']}}</span></p>
                    @endif
                    <button type="submit" class="btn btn-medium">Place order now</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Shipping method</h4>
                    <p class="summary-info"><span class="title">Flat Rate</span></p>
                    <p class="summary-info"><span class="title">Fixed $0</span></p>
                   
                </div>
            </div>
        </form>

          
        </div><!--end main content area-->
    </div><!--end container-->

</main>