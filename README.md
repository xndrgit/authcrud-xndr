#  Uploading Files

## Step 1: Configure Filesystem 
In your filesystems.php configuration file, set the default filesystem driver to 'public':

`'default' => env('FILESYSTEM_DRIVER', 'public'),`

## Step 2: Create a Symbolic Link
Create a symbolic link to your storage directory by running the following Artisan command:

`php artisan storage:link`

## Step 3: Modify Your Form
In your edit form view (e.g., edit.blade.php), add enctype="multipart/form-data" to your form to enable file uploads:

```
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- other form fields -->
    <div class="form-group">
        <label for="image">Image:</label>
        <input class="form-control-file" @error('image') is-invalid @enderror type="file" name="image" id="image">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- submit button and closing tags -->
</form>
```
## Step 4: Update Your Controller
In your controller's update method, handle the image upload and update the post. You can use the store method from the Storage facade:

```
  // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        // Store the image path in the database
        $post->image = $imagePath;
    }
```

## Step 5: Display the Image

```
    @if($post->image)
        <img class="img-fluid w-25" src="{{ asset('storage/' . $post->image) }}" alt="Uploaded File">
    @else
        No Image
    @endif
```
