@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quản lý danh mục</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}

                            </div>
                        @endif

                        @if (!isset($category))
                            <form action="{{ route('category.store') }}" method="post">
                        @else
                            <form action="{{ route('category.update', $category->id) }}" method="post">
                                @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu Đề</label>
                            <input type="text" value="{{ isset($category) ? $category->title : '' }}" name="title"
                                class="form-control" id="exampleInputEmail1" placeholder="Nhập tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả</label>
                            <input type="text" value="{{ isset($category) ? $category->description : '' }}"
                                name="description" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả">
                        </div>
                        <div class="form-group">
                            Kích hoạt
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1"
                                    {{ !isset($category->status) == 1 ? 'checked=""' : '' }}>
                                <label class="form-check-label">Có</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0"
                                    {{ !isset($category->status) == 0 ? 'checked=""' : '' }}>
                                <label class="form-check-label">Không</label>
                            </div>
                        </div>

                        <div class="card-footer">
                            @if (!isset($category))
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
                                <td class="col-2">{{ $list->status }}</td>
                                <td class="col-3">
                                    <form class="d-inline-block" method="POST"
                                        action="{{ route('category.destroy', $list->id) }}"
                                        onsubmit="return confirm('Xóa ?')">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Xóa" class="btn btn-danger">
                                    </form>
                                    <a class="btn btn-primary" href="{{ route('category.edit', $list->id) }}">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
