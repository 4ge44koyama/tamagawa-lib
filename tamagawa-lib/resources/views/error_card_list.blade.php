@if ($errors->any())
    <div class="card-text text-left alert alert-danger mt-3">
        <ul class="mb-0 py-0 pl-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif