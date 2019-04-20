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
                            @endphp
                            <tr @if($current_key == 4) class="other-color" @endif>
                                <th scope="row">{{ $current_key }}</th>
                                <td>
                                    <img class="img-fluid img-thumbnail thumbnail" height="200"
                                         src="{{$design->getThumbUrl()}}"
                                         alt="Thumbnail" data-url="{{$design->getFullUrl()}}">
                                </td>
                                <td>{{$design->getTitle()}}</td>
                                <td><span class="price">{{$design->getPrice()}}</span></td>
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
        })
    </script>
@endpush
