@include('layouts.home.header')
<div class="content-wrapper  js-content-wrapper">


    <section data-anim="fade" class="breadcrumbs ">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <div class="breadcrumbs__content">

                        <div class="breadcrumbs__item ">
                            <a href="#">Home</a>
                        </div>


                    </div>
                </div>
            </div>
    </section>


    <section class="page-header -type-1">
        <div class="container">
            <div class="page-header__content">
                <div class="row justify-center text-center">
                    <div class="col-auto">
                        <div data-anim="slide-up delay-1">

                            <h1 class="page-header__title">Shop Checkout</h1>

                        </div>

                        <div data-anim="slide-up delay-2">

                            <p class="page-header__text">We’re on a mission to deliver engaging, curated courses at a
                                reasonable price.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="layout-pt-md layout-pb-lg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                    <div class="bg-white border-light rounded-8 bg-light-4 p-4 mb-30">
                        <h5 class="text-22 fw-600 text-center mb-30">Your Order</h5>

                        <div class="d-flex justify-content-between mb-2 fw-500 text-dark-1">
                            <span>Product</span>
                            <span>Subtotal</span>
                        </div>
                        @foreach ($cartItems as $item)
                            <div class="border-top-dark pt-15 d-flex justify-content-between text-grey mb-2">
                                <span>{{ $item->course->title }}</span>
                                <span>${{ $item->course->price }}</span>
                            </div>
                        @endforeach



                        <div class="border-top-dark pt-15 d-flex justify-content-between fw-600 text-dark-1">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-white border-light rounded-8 bg-light-4 p-4">
                        <h5 class="text-22 fw-600 text-center mb-30">Payment</h5>


                        <div class="d-flex justify-content-start mb-20">
                            <div class="form-radio d-flex items-center">
                                <div class="radio">
                                    <input type="radio" name="radio" checked="checked">
                                    <div class="radio__mark">
                                        <div class="radio__icon"></div>
                                    </div>
                                </div>
                                <h5 class="ml-10 text-15 lh-1 text-dark-1 mb-0 ">Stripe</h5>
                            </div>
                        </div>
                        <form id="payment-form" action="{{ route('create.payment') }}" method="POST">
                            @csrf
                            <div id="card-element"
                                class="text-16 lh-1 fw-500 text-dark-1 mb-10 border px-3 py-4 mt-4 rounded">
                            </div>
                            <input type="hidden" name="stripeToken" id="stripe-token">

                            <button type="submit" class="button -md -purple-1 text-white col-12 mt-30">
                                Place Order
                            </button>
                        </form>

                        <div id="payment-message" class="mt-3 text-center text-success fw-600"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // prevent normal submission

            const {
                token,
                error
            } = await stripe.createToken(card);

            if (error) {
                alert(error.message);
            } else {
                document.getElementById('stripe-token').value = token.id;
                form.submit();
            }
        });
    </script>
    @include('layouts.home.footer')
