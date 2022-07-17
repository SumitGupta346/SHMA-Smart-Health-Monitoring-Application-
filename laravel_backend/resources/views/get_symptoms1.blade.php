@extends('layouts.app1')

@section('content')
<div class="container" >
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <h4>Selected Part of Body with problem is: {{$body_part}}</h4>
         <form action="{{ route('get_symptoms2') }}" method="post" >
            <input type="hidden" name="body_part" value="{{$body_part}}"/>
            @csrf
            @php
              $cnt = 1
            @endphp
            @foreach($symptoms as $symptom)

            <div class="card" style="background-color:Silver;">
                <div class="card-header" style="font-family: Arial, Helvetica, sans-serif; font-size:4vw;">Do you have "{{$symptom->symptoms_name}}"?</div>
                <div class="card-body">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="{{$cnt}}" id="inlineRadio{{$symptom->id}}1" value="Yes">
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="{{$cnt}}" id="inlineRadio{{$symptom->id}}2" value="No">
                        <label class="form-check-label" for="inlineRadio2">No</label>
                      </div>


        </div>

            </div>
            @php
              $cnt +=1
            @endphp
             @endforeach

            <br><button type="submit" class="btn btn-success" style="font-size: 16px; border-radius: 4px;">Next</button>
         </form>
        </div>
    </div>


</div>

@endsection
