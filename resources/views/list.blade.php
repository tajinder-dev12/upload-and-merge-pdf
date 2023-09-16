<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outline Systems India Pvt Ltd - Pdf Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}" />
</head>
<body>


<form action="{{ url('download-multiple-pdf') }}" method="post" name="f1">
    @csrf
     <div class="container">
        <div class="row"> 
            <div><div class="col-md-12"> <h2 id="listhd">PDF Files</h2> </div></div>
        </div>
        <div class="row"> 
            <div class="col-md-6"><button type="submit" class="btn btn-primary actionbtn"> Download </button></div>
            <div class="col-md-6 addpdf"><a href="{{ url('add-files') }}" class="btn btn-primary">  Add Files</a></div>
        </div> 
     </div>
     @if (session('success'))<div class="alert alert-success scmsg">{{ session('success') }}</div> @endif
     @if (session('error'))<div class="alert alert-error ermsg">{{ session('error') }}</div> @endif
        <table class="table">
            <thead style="text-align: center;">
                <tr>
                <th>Select</th>
                <th scope="col">Sr.n</th>
                <th scope="col">Title</th>
                <th scope="col">Files</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
            @if(count($data)>0)
            @foreach($data as $key=>$row)
                <tr>
                    <th><input type="checkbox" name="ids[]" value="{{ $row->id }}"></th>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $row->title }}</td>
                    <td><a href="{{ url('download-pdf') }}/{{ $row->id }}" class="btn btn-primary"> Download </a></td>
                </tr>
            @endforeach
            </tbody>
            @else
            <tr>
                <td colspan="3"> Data not found </td>
            </tr>
            @endif  
        </table>
        </form> 
</body>
</html>


