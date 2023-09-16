<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Outline Systems India Pvt Ltd - Add Files</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}" />
</head>
<body>

<div class="container">
    <div class="row"> 
        <div class=col-md-12 style="margin-bottom: -57px;">
            <h2 style="text-align: center; margin: 43px;">Add PDF Files</h2> <button class="btn btn-danger"> <a href="{{ url('pdf-files') }}" style="text-decoration:none; color:white;"> Back </a></button>
        </div>
    </div>
</div>

<form action="{{ url('store-files') }}" method="post" style="margin: 105px;" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Title" required>
    @if($errors->has('title'))
        <div class="error">{{ $errors->first('title') }}</div>
    @endif
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">PDF File</label>
    <input type="file" class="form-control" id="files" name="files[]" multiple required>
    @if($errors->has('files'))
        <div class="error">{{ $errors->first('files') }}</div>
    @endif
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>