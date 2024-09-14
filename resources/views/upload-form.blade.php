<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>

<h1>Upload an Image to Check Django API</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="image">Choose an image to upload</label>
        <input type="file" name="image" id="image" required>
    </div>
    <div>
        <button type="submit">Upload</button>
    </div>
</form>

@if(isset($apiResponse))
    <h2>API Response:</h2>
    <p><strong>Food Name:</strong> {{ $apiResponse['label']['name'] }}</p>
    <p><strong>Category:</strong> {{ $apiResponse['label']['category'] }}</p>
    <p><strong>Description:</strong> {{ $apiResponse['label']['description'] }}</p>
    <p><strong>Ingredients:</strong> {!! $apiResponse['label']['ingredients'] !!}</p>
    <img src="{{ $apiResponse['label']['photo_path'] }}" alt="Food Image" width="300">
@endif

</body>
</html>
