@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Create Employee
                    <a href="{{route('employee.index')}}" class="btn btn-success float-end"><i class="fa fa-cret-down"></i>Back</a>
                </div>

                <div class="card-body">
                    @include('common.alerts')

                    <form action="{{route('employee.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 mb-1">
                                <label for="first_name">First Name</label>
                                <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter First Name">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-12 mb-1">
                                <label for="last_name">Last Name</label>
                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter Last Name">

                                @error('last_name')
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
                                <label for="email">Phone</label>
                                <input type="number" value="{{old('phone')}}" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                            </div>

                            <div class="col-md-12 col-12 mb-1">
                                <label for="website">Company</label>
                                <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                    <option value="">Select</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id ?? 0}}">{{$company->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
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
