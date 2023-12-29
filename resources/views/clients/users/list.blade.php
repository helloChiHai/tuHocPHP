@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <h1>{{ $title }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th width="5%">ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th width="30%">Thời gian tạo</th>
            </tr>
        </thead>
        <tbody>
            @if (!@empty($users))
                @foreach ($users as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->create_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Không có dữ liệu</td>
                </tr>
            @endif

        </tbody>
    </table>
@endsection
