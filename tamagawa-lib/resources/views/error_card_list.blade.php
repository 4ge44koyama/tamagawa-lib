@if ($errors->any())
    <div class="card-text text-left alert alert-danger mt-2">
        <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif