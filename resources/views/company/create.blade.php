@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Create Company
                    <a href="{{route('company.index')}}" class="btn btn-success float-end"><i class="fa fa-cret-down"></i>Back</a>
                </div>

                <div class="card-body">
                    @include('common.alerts')

                    <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 mb-1">
                                <label for="name">Name</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <label for="email">Email</label>
                                <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-12 mb-1">
                                <label for="website">Website</label>
                                <input type="text" value="{{old('website')}}" name="website" class="form-control" id="website" placeholder="Enter Website">
                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-12 mb-1">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" id="logo">
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-2 col-12 mb-1 mt-2">
                            <button type="submit" class="btn btn-primary">Create</button>
                            </div>

                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
