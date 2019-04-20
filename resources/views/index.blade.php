@extends('layouts.main')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
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
                                                <td><span class="price postcard-price">{{ $design->getPrice() }}</span></td>
                                            </tr>
                                            <tr style="font-size: 0.75rem;">
                                                <th>Envelope</th>
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
        $(".thumbnail").on('click', function (event) {
            const win = window.open('/pdf?url=' + btoa($(event.target).data('url')), '_blank');
            win.focus();
        });
        $(function () {
            $.each($('.design-row'), function(index, item) {
                $.ajax({
                    url: '/design/prices',
                    data: {
                        design_id: $(item).data('design'),
                    },
                    success: function (data) {
                        const postcard_price = $(item).find('.postcard-price').html();
                        $(item).find('.envelope-price').html(data);
                        $(item).find('.total-price').html(parseFloat(data) + parseFloat(postcard_price));
                        $(item).find('.loading-curtain').fadeOut();
                    }
                })
            });
        });
    </script>
@endpush
