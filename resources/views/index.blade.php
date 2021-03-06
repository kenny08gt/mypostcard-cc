@extends('layouts.main')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <div class="d-flex align-items-baseline">
                        <label>Select an add on (product option): </label>
                        <div class="dropdown ml-2">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                    id="productOptionDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Product option
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" onclick="changePriceOption('xxl')">XXL
                                </button>
                                <button class="dropdown-item" type="button" onclick="changePriceOption('envelope')">
                                    Envelope
                                </button>
                                <button class="dropdown-item" type="button" onclick="changePriceOption('premium')">
                                    Premium
                                </button>
                                <button class="dropdown-item" type="button" onclick="changePriceOption('xl')">XL
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($designs as $key => $design)
                            @php
                                $current_key = $key + ($page * $per_page) + 1;
                                $classes = $current_key == 4 ? 'other-color design-row' : 'design-row';
                            @endphp
                            <tr class="{{$classes}}" data-design="{{$design->getId()}}">
                                <th scope="row">{{ $current_key }}</th>
                                <td>
                                    <img class="img-fluid img-thumbnail thumbnail" height="200"
                                         src="{{$design->getThumbUrl()}}"
                                         alt="Thumbnail" data-url="{{$design->getFullUrl()}}">
                                </td>
                                <td>{{$design->getTitle()}}</td>
                                <td>
                                    <div class="position-relative">
                                        <div class="loading-curtain">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div>
                                        <table class="loading">
                                            <tbody>
                                            <tr style="font-size: 0.75rem;">
                                                <th>Postcard price</th>
                                                <td><span class="price postcard-price">{{ $design->getPrice() }}</span>
                                                </td>
                                            </tr>
                                            <tr style="font-size: 0.75rem;">
                                                <th><span class="product-option">Envelope</span></th>
                                                <td>
                                                    <span class="price envelope-price">{{ $design->getGreetingCardEnvelopePrice() }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>
                                                    <span class="price total-price">{{ ($design->getPrice() + $design->getGreetingCardEnvelopePrice()) }}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('components.pagination', ['page' => $page, 'total' => $total, 'per_page' => $per_page])
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let price_option = 'envelope';
        if (localStorage.getItem("price_option") !== null) {
            price_option = localStorage.getItem("price_option");
        }

        // Initial price load
        $(function () {
            updatePrices();
        });

        $(".thumbnail").on('click', function (event) {
            const win = window.open('/pdf?url=' + btoa($(event.target).data('url')), '_blank');
            win.focus();
        });

        function changePriceOption(option) {
            price_option = option;
            localStorage.setItem('price_option', price_option);
            updatePrices();
        }

        function updatePrices() {
            showLoadingCurtain();
            $('#productOptionDropdown').html(price_option);
            $.each($('.design-row'), function (index, item) {
                $.ajax({
                    url: '/design/prices',
                    data: {
                        design_id: $(item).data('design'),
                        add_on: price_option,
                    },
                    success: function (data) {
                        const postcard_price = $(item).find('.postcard-price').html();
                        $(item).find('.envelope-price').html(data);
                        $(item).find('.product-option').html(price_option);
                        $(item).find('.total-price').html(parseFloat(data) + parseFloat(postcard_price));
                        $(item).find('.loading-curtain').fadeOut();
                    }
                })
            });
        }

        function showLoadingCurtain() {
            $('.design-row .loading-curtain').fadeIn();
        }
    </script>
@endpush
