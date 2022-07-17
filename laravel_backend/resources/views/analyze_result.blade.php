@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <h4>Selected Part of Body with problem is: <span style="color:red;">{{$body_part}}</span></h4>

            <h2 style="font-family: Verdana,Geneva,sans-serif;"> RESULT </h2>
            <h4 class="form-horizontal" style="font-family: Verdana,Geneva,sans-serif; font-size: 20px">This result is based on your symptoms.</h4>
            <h3 style="font-family: Verdana,Geneva,sans-serif;">SUGGESTED DISEASE </h3>
            <h3 class="result-color" style="color: green;">{{$result[0]->disease_name}}</h3><br>
            <h3 style="font-size:20px ;">CAUSE</h3>
            <h3><?php echo htmlentities($result[0]->cause);?></h3>
            <p style="font-family: Verdana,Geneva,sans-serif; font-size: 20px "> &nbsp&nbsp
                DISCLAIMER :
                Please note that the information provided by this tool is provided solely for educational purposes
                and is not a &nbspqualified medical opinion. This information should not be considered advice or an opinion
                of a doctor or other health &nbspprofessional about your actual medical state, and you should see a doctor
                for any symptoms you may have. If you are &nbspexperiencing a health emergency, you should call your local
                &nbspemergency number immediately to request emergency medical &nbspassistance.
            </p>
        </div>
    </div>


</div>

@endsection
