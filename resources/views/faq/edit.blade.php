@extends('layouts.app')

@section('title', 'Edit FAQ item')

@section('content')
    <div class="form-card">
        <h1>Edit FAQ item</h1>

        <form method="POST" action="{{ route('faqs.update', $faq) }}">
            @csrf
            @method('PUT')

            <label for="question">Question</label>
            <input id="question" name="question" type="text" value="{{ old('question', $faq->question) }}" required maxlength="255">
            @error('question')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="sort_order">Sort order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', $faq->sort_order) }}">
            @error('sort_order')
                <p class="error">{{ $message }}</p>
            @enderror

            <label class="checkbox">
                <input type="checkbox" name="published" value="1" @checked(old('published', $faq->published))>
                Published
            </label>

            <button type="submit">Update item</button>
        </form>
    </div>
@endsection
