@extends('layouts.base')
@section('content')
<!-- Main Content -->
<section class="content" style="margin-left: 2%; margin-right: 1%">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{auth()->user()->first_name}}  {{auth()->user()->last_name}}</h2>
                    @if (auth()->user()->is_role==1)
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('category')}}"> Category</a>
                        {{-- <li class="breadcrumb-item"><a href="index.html"> Teacher</a></li>
                        <li class="breadcrumb-item"><a href="index.html"> Department</a>
                        <li class="breadcrumb-item"><a href="index.html"> Fakulty</a>
                        <li class="breadcrumb-item"><a href="index.html"> Unversity</a> --}}
                        </li>
                    </ul>
                    @endif
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
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card widget_2">
                <div class="body">
                    <h6>Total files</h6>
                    <h2>{{$total}}</h2>
                    {{-- <small>2% higher than last month</small> --}}
                    <div class="progress">
                        <div class="progress-bar l-amber" role="progressbar" aria-valuenow="{{$total}}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$total}}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card widget_2 ">
                <div class="body">
                    <h6>Personal files</h6>
                    <h2>{{$personal}}</h2>
                    {{-- <small>6% higher than last month</small> --}}
                    <div class="progress">
                        <div class="progress-bar l-blue" role="progressbar" aria-valuenow="{{$personal}}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$personal}}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card widget_2 ">
                <div class="body">
                    <h6>Work files</h6>
                    <h2>{{$work}}</h2>
                    {{-- <small>Total Registered email</small> --}}
                    <div class="progress">
                        <div class="progress-bar l-purple" role="progressbar" aria-valuenow="{{$work}}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$work}}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card widget_2 ">
                <div class="body">
                    <h6>Special files</h6>
                    <h2>{{$special}}</h2>
                    {{-- <small>Total Registered Domain</small> --}}
                    <div class="progress">
                        <div class="progress-bar l-green" role="progressbar" aria-valuenow="{{$special}}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$special}}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <div class="row clearfix" style="margin-left: 1%;margin-top: -4%">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                </div>
                <div class="body">
                    <a href="{{ route('home.create') }}" class="btn btn-raised btn-primary btn-round waves-effect"
                        style="color: white">Create</a>
                        <form action="{{route('home')}}" style="display:inline-block; width: 20%;">
                            <div style="display: flex; justify-content: space-between">
                                @csrf
                                <input type="search" class="form-control" style="height: 1%; width: 60%;" name="search"  value="{{isset($search) ? $search : old('search')}}">
                                <button class="btn btn-raised btn-primary btn-round waves-effect" style="margin: 0" type="submit">Search</button>
                            </div>
                        </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Tite</th>
                                    <th>Date</th>
                                    <th>File Size</th>
                                    <th>File Type</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($home as $key=>$item)
                                    <tr align="center">
                                        <th>{{ ++$key}}</th>
                                        <td>{{ $item->teacher->last_name }} {{ $item->teacher->first_name }}</td>
                                        <td>{{ $item->title??'no title'}}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{$item->size??'0'}} KB</td>
                                        <td>{{$item->type??'no file'}}</td>
                                        <td>{{ $item->category->name??'' }}</td>
                                        <td>{{ $item->status ? 'Special document' : 'Simple document' }}</td>
                                        <td style="width: 240px; display: flex; justify-content: space-between">
                                            <a href="{{route('home.edit',['id'=>$item->id])}}" class="btn btn-raised btn-success ">Update</a>
                                            <form action="{{route('home.delete',['id'=>$item->id])}}" method="POST" style="{{$item->file? '':'margin-right: 23%'}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-raised btn-danger" type="submit">Delete</button>
                                            </form>
                                            @if ($item->file)

                                            <a class="btn btn-raised btn-warning  btn-icon float-right"
                                            href="{{ route('home.dowload',['id'=>$item->id]) }}"><span class="ti-import"></span></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
