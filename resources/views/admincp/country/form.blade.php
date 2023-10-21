@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quốc Gia</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}

                            </div>
                        @endif

                        @if (!isset($country))
                            <form action="{{ route('country.store') }}" method="post">
                        @else
                            <form action="{{ route('country.update', $country->id) }}" method="post">
                                @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="slug">Tiêu Đề</label>
                            <input type="text" value="{{ isset($country) ? $country->title : '' }}" name="title"
                                class="form-control" id="slug" onkeyup="ChangeToSlug()" placeholder="Nhập tiêu đề" >
                        </div>
                        <div class="form-group">
                            <label for="convert_slug">Slug</label>
                            <input type="text" value="{{ isset($category) ? $category->slug : '' }}"
                                name="slug" class="form-control" id="convert_slug" placeholder="Nhập slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả</label>
                            <input type="text" value="{{ isset($country) ? $country->description : '' }}"
                                name="description" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả">
                        </div>
                        <div class="form-group">
                            Kích hoạt
                            <div class="form-check">
                                <input id="rd-check" class="form-check-input" type="radio" name="status" value="1"
                                    @if (isset($country)) {{ $country->status == 1 ? 'checked=""' : '' }} @else {!! 'checked=""' !!}> @endif
                                    <label for="rd-check" class="form-check-label">Có</label>
                            </div>
                            <div class="form-check">
                                <input id="rd-check2" class="form-check-input" type="radio" name="status" value="0"
                                    @if (isset($country)) {{ $country->status == 0 ? 'checked=""' : '' }}> @endif
                                    <label for="rd-check2" class="form-check-label">Không</label>
                            </div>
                        </div>

                        <div class="card-footer">
                            @if (!isset($country))
                            <button type="submit" class="btn btn-primary">Submit</button>
                            
                            @else
                            <button type="submit" class="btn btn-primary">Cập nhật</button>

                            @endif
                        </div>
                        @csrf
                        </form>
                    </div>
                </div>

                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiêu Đề</th>
                            <th scope="col">Mô Tả</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $key => $list)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $list->title }}</td>
                                <td>{{ $list->description }}</td>
                                <td>{{ $list->slug }}</td>
                                <td class="col-2">{{ $list->status }}</td>
                                <td class="col-3">
                                    <form class="d-inline-block" method="POST"
                                        action="{{ route('country.destroy', $list->id) }}"
                                        onsubmit="return confirm('Xóa ?')">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Xóa" class="btn btn-danger">
                                    </form>
                                    <a class="btn btn-primary" href="{{ route('country.edit', $list->id) }}">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
