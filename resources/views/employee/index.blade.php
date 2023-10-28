@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Employees
                    <a href="{{route('employee.create')}}" class="btn btn-success float-end">Add</a>
                </div>


                <div class="card-body">

                    @include('common.alerts')

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th scope="col" style="width: 130px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{$employee->id ?? 0}}</th>
                                <td>{{$employee->first_name ?? 'N/A'}}</td>
                                <td>{{$employee->last_name ?? 'N/A'}}</td>
                                <td>{{$employee->email ?? 'N/A'}}</td>
                                <td>{{$employee->phone ?? 'N/A'}}</td>
                                <td>{{$employee?->company?->name ?? 'N/A'}}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('employee.edit', $employee)}}"><i class="fa fa-pencil"></i>Edit</a>
                                    <form class="float-end" action="{{route('employee.destroy', $employee)}}" onsubmit="return confirm('Are you sure you want to delete?');" method="post">
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
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
