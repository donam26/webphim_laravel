@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Phim</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}

                            </div>
                        @endif

                        @if (!isset($movie))
                            <form action="{{ route('movie.store') }}" method="post" enctype="multipart/form-data">
                            @else
                                <form action="{{ route('movie.update', $movie->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="slug">Tiêu Đề</label>
                            <input type="text" value="{{ isset($movie) ? $movie->title : '' }}" name="title"
                                class="form-control" id="slug" onkeyup="ChangeToSlug()" placeholder="Nhập tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="convert_slug">Slug</label>
                            <input type="text" value="{{ isset($movie) ? $movie->slug : '' }}" name="slug"
                                class="form-control" id="convert_slug" placeholder="Nhập slug">
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Nhập mô tả">{{ isset($movie) ? $movie->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trailer</label>
                            <input type="text" value="{{ isset($movie) ? $movie->trailer : '' }}" name="trailer"
                                class="form-control" placeholder="Nhập trailer">
                        </div>
                        <div class="form-group">
                            <label>Danh Mục</label>
                            <select name="category_id" class="form-control">
                                @foreach ($cates as $cate)
                                    <option value="{{ $cate->id }}"
                                        {{ isset($movie) && $movie->category_id == $cate->id ? 'selected' : '' }}>
                                        {{ $cate->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thể Loại</label><br>
                            @foreach ($list_genre as $gen)
                                <input type="checkbox" name="genre[]" value="{{ $gen->id }}"
                                    {{ isset($movie) && $movie->genre_id == $gen->id ? 'checked' : '' }}>
                                <label for="genre">{{ $gen->title }}</label>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Quốc Gia</label>
                            <select name="country_id" class="form-control">
                                @foreach ($counts as $count)
                                    <option value="{{ $count->id }}"
                                        {{ isset($movie) && $movie->country_id == $count->id ? 'selected' : '' }}>
                                        {{ $count->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            Phim Hot
                            <div class="form-check">
                                <input id="rd-check4" class="form-check-input" type="radio" name="phim_hot" value="1"
                                    @if (isset($movie)) {{ $movie->phim_hot == 1 ? 'checked=""' : '' }} @else {!! 'checked=""' !!}> @endif
                                    <label for="rd-check4" class="form-check-label">Có</label>
                            </div>
                            <div class="form-check">
                                <input id="rd-check3" class="form-check-input" type="radio" name="phim_hot" value="0"
                                    @if (isset($movie)) {{ $movie->phim_hot == 0 ? 'checked=""' : '' }}> @endif
                                    <label for="rd-check3" class="form-check-label">Không</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tập Phim</label>
                            <select name="season" id="season" class="form-control">
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}"
                                        @if (isset($movie)) {{ $movie->season == $i ? 'selected=""' : '' }} @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Định Dạng</label>
                            <select name="resolution" class="form-control">
                                <option value="0"{{ isset($movie) && $movie->resolution == 0 ? 'selected' : '' }}>
                                    HD
                                </option>
                                <option value="1"{{ isset($movie) && $movie->resolution == 1 ? 'selected' : '' }}>
                                    FullHD
                                </option>
                                <option value="2"{{ isset($movie) && $movie->resolution == 2 ? 'selected' : '' }}>
                                    Trailer
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input name="image" class="form-control-file" type="file" id="">
                        </div>




                        <div class="form-group">
                            Kích hoạt
                            <div class="form-check">
                                <input id="rd-check" class="form-check-input" type="radio" name="status" value="1"
                                    @if (isset($movie)) {{ $movie->status == 1 ? 'checked=""' : '' }} @else {!! 'checked=""' !!}> @endif
                                    <label for="rd-check" class="form-check-label">Có</label>
                            </div>
                            <div class="form-check">
                                <input id="rd-check2" class="form-check-input" type="radio" name="status"
                                    value="0"
                                    @if (isset($movie)) {{ $movie->status == 0 ? 'checked=""' : '' }}> @endif
                                    <label for="rd-check2" class="form-check-label">Không</label>
                            </div>
                        </div>

                        <div class="card-footer">
                            @if (!isset($movie))
                                <button type="submit" class="btn btn-primary">Submit</button>
                            @else
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            @endif
                        </div>
                        @csrf
                        </form>
                    </div>
                </div>

                <table class="table table-hover mt-3" id="tablephim">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiêu Đề</th>
                            <th scope="col">Mô Tả</th>
                            <th scope="col">Trailer</th>
                            <th scope="col">Image</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Thể Loại</th>
                            <th scope="col">Quốc Gia</th>
                            <th scope="col">Phim Hot</th>
                            <th scope="col">Tập Phim</th>
                            <th scope="col">Định Dạng</th>
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

                                <td>
                                    @if (!isset($list->trailer))
                                        Không có
                                    @else
                                        {{ $list->trailer }}
                                    @endif
                                </td>
                                <td><img style="width: 90px" src="{{ asset('/uploads/movie/' . $list->image) }}"
                                        alt="" srcset=""></td>
                                <td>{{ $list->category->title }}</td>
                                <td>
                                    @foreach ($list->movie_genre as $key=> $item)
                                    <span class="badge badge-dark">{{ $item->title }}       </span>                                 
                                    @endforeach

                                </td>
                                <td>{{ $list->country->title }}</td>
                                <td>
                                    @if ($list->phim_hot == 0)
                                        Không
                                    @else
                                        Có
                                    @endif
                                </td>
                                <td>
                                    <form method="POST">
                                        {!! Form::selectRange('season', 1, 20, isset($list->season) ? $list->season : '', [
                                            'class' => 'select-season',
                                            'id' => $list->id,
                                        ]) !!}
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    @if ($list->resolution == 0)
                                        HD
                                    @elseif($list->resolution == 1)
                                        FullHD
                                    @else
                                        Trailer
                                    @endif
                                </td>
                                <td>
                                    @if ($list->status == 0)
                                        Tắt
                                    @else
                                        Bật
                                    @endif
                                </td>
                                <td class="col-3">
                                    <form class="d-inline-block" method="POST"
                                        action="{{ route('movie.destroy', $list->id) }}"
                                        onsubmit="return confirm('Xóa ?')">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Xóa" class="btn btn-danger">
                                    </form>
                                    <a class="btn btn-primary" href="{{ route('movie.edit', $list->id) }}">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
