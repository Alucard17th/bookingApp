@extends('layouts.front')


@section('content')
<!-- <div class="container mt-5 my-5">
<x-paddle-button :checkout="$checkout" class="px-8 py-4">
    Buy Product
</x-paddle-button>

</div> -->
<section class="position-relative overflow-hidden p-5 mt-5" id="pricing">
    <div class="container position-relative">
        <div class="row justify-content-center price-plan">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-5">
                <div class="card position-relative shadow border-0 h-100">
                    <div class="card-body pb-0">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="m-0">Product Name:</h5>
                                    </td>
                                    <td>
                                        <h5 class="m-0">{{$product->name}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="m-0">Price:</h5>
                                    </td>
                                    <td>
                                        <h5 class="m-0">{{$product->price}} <span class="text-muted">$</span></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="m-0">Bookings:</h5>
                                    </td>
                                    <td>
                                        <h5 class="m-0">{{$product->bookings}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="m-0">Features:</h5>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 pl-0">
                                            <li class="d-flex align-items-start">
                                                <i class="ti ti-circle-check bk-orange fs-4 pe-2"></i>
                                                <span class="fs-7 text-black">{{$product->bookings}} Bookings</span>
                                            </li>
                                            @foreach(json_decode($product->features) as $key => $feature)

                                            @switch($key)

                                            @case('admin_dashboard')
                                            <li class="d-flex align-items-start">
                                                <i
                                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                                <span class="fs-7 text-black">Admin Dashboard</span>
                                            </li>
                                            @break
                                            @case('white_label')
                                            <li class="d-flex align-items-start">
                                                <i
                                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                                <span class="fs-7 text-black">White Label</span>
                                            </li>
                                            @break
                                            @case('list_in_booked_directory')
                                            <li class="d-flex align-items-start">
                                                <i
                                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                                <span class="fs-7 text-black">List in Booked</span>
                                            </li>
                                            @break
                                            @case('widget')
                                            <li class="d-flex align-items-start">
                                                <i
                                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                                <span class="fs-7 text-black">Widget</span>
                                            </li>
                                            @break
                                            @case('services_and_events_providers')
                                            <li class="d-flex align-items-start">
                                                <i class="ti ti-circle-check bk-orange fs-4 pe-2"></i>
                                                <span class="fs-7 text-black">Services/Events Providers :
                                                    {{ $feature }}</span>
                                            </li>
                                            @break
                                            @default
                                            @break
                                            @endswitch
                                            @endforeach

                                        </ul>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-5">
                <div class="card position-relative shadow border-0 h-100">
                    <div class="card-body pb-0">
                        <x-paddle-checkout :checkout="$checkout" class="w-full" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')

@endpush