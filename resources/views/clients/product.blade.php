@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

{{-- @section('sidebar')
    @parent
    <h3>Product sidebar</h3>
@endsection --}}

@section('content')
    <h1>SẢN PHẨM</h1>
    <x-package-alert/>
    @push('scripts')
        <script>
            console.log('stack lan 2')
        </script>
    @endpush
@endsection

@section('css')
@endsection

@section('js')
@endsection

{{-- đang làm việc với stack --}}
@push('scripts')
    <script>
        console.log('stack lan 1')
    </script>
@endpush
