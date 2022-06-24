@extends('layouts.base')
@section('content')
    <!-- Main Content -->
    <section class="content" style="margin-left: 2%; margin-right: 1%">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>By Azamat</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="index.html"> Teacher</a></li>
                            <li class="breadcrumb-item"><a href="index.html"> Department</a>
                            </li>
                        </ul>

                        {{-- <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button> --}}

                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <form action="{{ asset('logout') }}" method="POST">
                            @csrf
                            @method('post')
                            <button class="btn btn-primary btn-icon float-right " type="submit"><i
                                    class="zmdi zmdi-power"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr >
                                    <th>#</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>USERNAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Larry</td>
                                    <td>Jellybean</td>
                                    <td>@lajelly</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Larry</td>
                                    <td>Kikat</td>
                                    <td>@lakitkat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
