@include('layouts.home.header')



<div class="content-wrapper  js-content-wrapper">


    <section data-anim="fade" class="breadcrumbs ">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <div class="breadcrumbs__content">

                        <div class="breadcrumbs__item ">
                            <a href="{{ url('/') }}">Home</a>
                        </div>

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

                            <h1 class="page-header__title">Shop Cart</h1>

                        </div>

                        <div data-anim="slide-up delay-2">

                            <p class="page-header__text">We’re on a mission to deliver engaging, curated
                                courses at a reasonable price.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="layout-pt-md layout-pb-lg">
        <div class="container">
            <div class="row justify-end">
                <div class="col-12">
                    <div class="px-30 pr-60 py-25 rounded-8 bg-light-6 md:d-none">
                        <div class="row justify-between">
                            <div class="col-md-4">
                                <div class="fw-500 text-purple-1">Product</div>
                            </div>
                            <div class="col-md-2">
                                <div class="fw-500 text-purple-1">Price</div>
                            </div>


                            <div class="col-md-1">
                                <div class="d-flex justify-end">
                                    <div class="fw-500 text-purple-1">Remove</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-30 pr-60 md:px-0">

                        @forelse ($cartItems as $item)
                            <div
                                class="row y-gap-20 justify-between items-center pt-30 pb-30 border-bottom-light cart-item">
                                <!-- 🖼 Course Thumbnail & Name -->
                                <div class="col-md-4">
                                    <div class="d-flex items-center">
                                        <div class="size-100 bg-image rounded-8 js-lazy"
                                            style="background-image: url('{{ $item->course->thumbnail ? asset('storage/' . $item->course->thumbnail) : asset('assets/img/coursesCards/1.png') }}'); background-size: cover; background-position: center;">
                                        </div>
                                        <div class="fw-500 text-dark-1 ml-30">
                                            {{ $item->course->title }}
                                        </div>
                                    </div>
                                </div>

                                <!-- 💵 Course Price -->
                                <div class="col-md-2 md:mt-15">
                                    <div>
                                        <div class="shopCart-products__title d-none md:d-block mb-10">
                                            Price
                                        </div>
                                        <p>${{ $item->course->price ?? 'Free' }}</p>
                                    </div>
                                </div>

                                <!-- ❌ Delete Icon -->
                                <div class="col-md-1">
                                    <div class="md:d-none d-flex justify-end">
                                        <i class="icon text-red-500 cursor-pointer remove-cart-item"
                                            data-id="{{ $item->id }}" data-feather="x" title="Remove from cart"></i>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-gray-500 text-lg font-medium">🛒 Your cart is empty</p>
                            </div>
                        @endforelse

                    </div>


                </div>

                <div class="col-xl-4 col-lg-5 layout-pt-lg">
                    <div class="py-30 bg-light-4 rounded-8 border-light">
                        <h5 class="px-30 text-20 fw-500">
                            Cart Totals
                        </h5>



                        <div class="d-flex justify-between px-30 item border-top-dark">
                            <div class="pt-15 fw-500 text-dark-1">Total</div>
                            <div class="pt-15 fw-500 text-dark-1 cart-total">${{ number_format($total, 2) }}</div>
                        </div>
                    </div>

                    <a href="{{ route('student.view.checkout') }}"
                        class="button -md -purple-1 text-white col-12 mt-30">Proceed
                        to checkout</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).on('click', '.remove-cart-item', function(e) {
            e.preventDefault();

            const itemId = $(this).data('id');
            const $itemRow = $(this).closest('.cart-item');

            $.ajax({
                url: `/student/remove/cart/${itemId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // ✅ Remove from DOM
                        $itemRow.fadeOut(400, function() {
                            $(this).remove();
                            updateCartTotal();
                            checkEmptyCart();
                        });

                        showSuccessMessage(response.message);
                    } else {
                        showErrorMessage(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showErrorMessage('Something went wrong while removing from cart.');
                }
            });
        });

        function updateCartTotal() {
            let total = 0;

            $('.cart-item-price').each(function() {
                const price = parseFloat($(this).data('price')) || 0;
                total += price;
            });

            $('.cart-total').text(`$${total.toFixed(2)}`);
        }
    </script>
    @include('layouts.home.footer')
