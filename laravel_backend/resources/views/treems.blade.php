@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
         <form action="{{ route('get_symptoms1') }}" method="post" >
            @csrf
            <div class="form-group" >
             <label>Select Part of Body with problem:</label>

             <select name="body_part" required class="form-control" style="width:100%;">
                 <option value="">Select</option>

                 <option>Ear</option>
                 <option>Nose</option>
                 <option>Mouth</option>
                 <option>Neck</option>
                 <option>Chest</option>
                 <option>Abdomen</option>
                 <option>Pelvis</option>
                 <option>Pubis</option>
                 <option>Shoulder</option>
                 <option>Elbow</option>
                 <option>Forearm</option>
                 <option>Wrist</option>
                 <option>Hand</option>
                 <option>Tigh</option>
                 <option>Arm</option>
                 <option>Ankle</option>
                 <option>Foot</option>
             </select>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
         </form>
        </div>
    </div>


</div>

@endsection
