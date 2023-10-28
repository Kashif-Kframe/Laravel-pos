@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Companies
                    <a href="{{route('company.create')}}" class="btn btn-success float-end">Add</a>
                </div>


                <div class="card-body">

                    @include('common.alerts')

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col" style="width: 130px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <th scope="row">{{$company->id ?? 0}}</th>
                                <td>
                                    <img style="width: 50px;" src="{{$company->logoPath ?? ''}}">
                                </td>
                                <td>{{$company->name ?? 'N/A'}}</td>
                                <td>{{$company->email ?? 'N/A'}}</td>
                                <td>{{$company->website ?? 'N/A'}}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('company.edit', $company)}}"><i class="fa fa-pencil"></i>Edit</a>
                                    <form class="float-end" action="{{route('company.destroy', $company)}}" onsubmit="return confirm('Are you sure you want to delete?');" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash-o"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
