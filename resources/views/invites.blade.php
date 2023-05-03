<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invites</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/invitees.css')}}">

</head>
<body>
	<div class="container invites" >
          
	<section >
          <h1>Paul Mooney Test Results</h1>
          <h4>Hint: Select affiliates.txt</h4>

            <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div >
                <input type="file" name="file" class ="button">
            </div>

             <div style ="margin-top:20px" >
                <input type="submit" class="button">
            </div>

            </form>

        
       </section>
              @if (count($errors) > 0)
         <div >
            <ul  >
               @foreach ($errors->all() as $error)
                  <li class="alert-danger" >{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
</div>
</body>
</html>