<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Results</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/invitees.css')}}">

</head>
<body>
	<div class="container invites" >
		<section >
        <h1>Paul Mooney Test Results</h1>
       
        <h4>The following affiliates will be invited</h4>

        
        	<table class="invites-table">
        		<thead>
        			<th>Name</th><th>Affiliate Id</th><th>Distance (Kms)</th>
        		</thead>
        		<tbody>
        			@foreach($invites as $invite)
        			<tr><td>{{$invite->name}}</td><td>{{$invite->affiliate_id}}</td><td>{{$invite->distance}}</td></tr>
        			@endforeach
        		</tbody>
        	</table>
        	
        	
        

    </section>
</div>
</body>
</html>