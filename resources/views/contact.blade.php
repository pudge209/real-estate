<x-app-layout>
    <style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #f0f2f5, #e0e7ff);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        



    }</style>
    <div class="container">
        <h1>Contact Us</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="5">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
        </form>
    </div>
    </x-app-layout>
