@extends('layouts.client')

{{-- sessstion: thường dùng với layout là chính --}}
@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3>home sidebar</h3>
@endsection

@section('content')
    <h1>Trang chủ</h1>
    @include('clients.contents.slide')
    @include('clients.contents.about')

    @env('production')
    <p>Moi truong dev</p>
    @elseenv('test')
    <p>Moi truong test</p>
@else
    <p>Khong phai moi truong dev</p>
    @endenv

    <x-inputs.alert type="danger" :content="$SuccessAlert" />
    {{-- <x-inputs.button />
    <x-forms.button /> --}}
    <p><img src="https://cdn-amz.woka.io/images/I/71ssFtpyEGL.SS456.jpg" alt="rundam"></p>
    <p>
        <a href="{{ route('download-image') . '?image=https://cdn-amz.woka.io/images/I/71ssFtpyEGL.SS456.jpg' }}"
            class="btn btn-primary">Downlaod ảnh
        </a>
    </p>

    <p>
        <a href="{{ route('download-image-in') . '?image=' . public_path('storage/z4979793168747_859e83320bf3c41d737e1acddde019d4.jpg') }}"
            class="btn btn-primary">Downlaod ảnh(Tải ảnh trong nội bộ source)
        </a>
    </p>

    <p>
        <a href="{{ route('download-doc') . '?file=' . public_path('storage/demo-pdf.pdf') }}"
            class="btn btn-primary">Downlaod tài liệu
        </a>
    </p>
@endsection

@section('css')
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('js')
@endsection
