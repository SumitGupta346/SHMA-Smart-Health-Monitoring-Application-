@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Patients</h5>
                        <span>List of All Patients</span>
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
                            <a href="#">Patients</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<?php
$user = $user[0];

?>
    <div class="row">
        <div class="col-md-12">
            <h5 class="modal-title" id="exampleModalLabel">Patient information</h5>
            <table  class="table">
                <tr>


                   <td>Gender: <?php echo $user->gender; ?></td>
                    <td>Name: {{ $user->name }}</td>
                    <td>Email: {{ $user->email }}</td>

                    <td>Phone number: {{ $user->phone_number }}</td>
                </tr>
                <tr>
                    <td>Height: {{ $height }}</td>
                    <td>Weight: {{ $weight }}</td>
                    <td>BMI: {{ $bmi_index }}</td>
                    <td>BMI Result: {{ $output }}</td>
                </tr>

            </table>
            <div class="card">
                <div class="card-body ">


                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Water Intake</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($water_intakes) > 0)
                                @foreach ($water_intakes as $water_intake)
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($water_intake->created_at)); ?></td>
                                        <td>{{ $water_intake->total_water }}</td>
<td></td>

                                    </tr>

                                    <!-- View Modal -->

                                @endforeach

                            @else
                                <td>No data to display</td>
                            @endif

                        </tbody>
                    </table>
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Calorie Intake</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($cal_intakes) > 0)
                                @foreach ($cal_intakes as $cal_intake)
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($cal_intake->created_at)); ?></td>
                                        <td>{{ $cal_intake->total_cal }}</td>
<td></td>

                                    </tr>

                                    <!-- View Modal -->

                                @endforeach

                            @else
                                <td>No data to display</td>
                            @endif

                        </tbody>
                    </table>
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Fat Intake</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($fat_intakes) > 0)
                                @foreach ($fat_intakes as $fat_intake)
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($fat_intake->created_at)); ?></td>
                                        <td>{{ $fat_intake->total_fat }}</td>
<td></td>

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
