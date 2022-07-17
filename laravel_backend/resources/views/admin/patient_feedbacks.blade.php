@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Patients Feedbacks</h5>
                        <span>List of Patients Feedbacks</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Patients Feedbacks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert bg-success alert-success text-white text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body ">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>From Patient</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Feedbak Message</th>
                                <th>Feedback Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($feedbacks) > 0)
                                @foreach ($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->user->id}}</td>
                                        <td>{{ $feedback->user->name }}</td>
                                        <td>{{ $feedback->user->gender }}</td>
                                        <td>{{ $feedback->user->email }}</td>

                                        <td>{{ $feedback->user->phone_number }}</td>
                                        <td>{{ $feedback->feedback_message }}</td>
                                        <td><?php echo date('d-m-Y',strtotime($feedback->feedback_date)); ?></td>

                                    </tr>

                                    <!-- View Modal -->

                                @endforeach

                            @else
                                <td>No data to display</td>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
