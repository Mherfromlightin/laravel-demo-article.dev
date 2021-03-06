@extends('layouts.app')

@section('content')
    <div class="col-sm-8 blog-main">
        <form action="{{ url('articles/' . $article->id ) }}" method="POST">

            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
            </div>

            <div class="form-group">
                <label for="text">Text:</label>
                <textarea class="form-control" id="text" name="text">{{ $article->text }}</textarea>
            </div>

            <select class="categories-multiple" name="categories[]" id="categories" multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            style="width: 600px" {{ in_array($category->id, $currentCategoryIds) ? "selected" : "" }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" id="update_article" class="btn btn-default" data-id="{{ $article->id }}">Update</button>
        </form>
    </div>
@endsection

@push('scripts')
<script src="/js/modules/article.js"></script>
<script>
    $(document).ready(function () {
        $('.categories-multiple').select2();
    })
</script>
@endpush