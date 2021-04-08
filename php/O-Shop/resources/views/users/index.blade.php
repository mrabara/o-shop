@extends('layouts.app')
@section('content')
    <h1 class="text-info text-center">List of Users</h1>

    @empty ($users)
        <div class="alert alert-warning">
            The table is empty
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light text-center">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin Since</th>
                    <th>Actions</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                        <tr>

                            <td>{{$user->id}}</td>
                            <td >{{$user->name}}</td>
                            <td >{{$user->email}}</td>
                            <td>{{optional($user->admin)->diffForHumans() ?? 'User'}}</td>
                            <td>
                                <form class="d-inline" action="{{route('users.admin', ['user' => $user->id])}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn">
                                        {{$user->isAdmin() ? 'Remove as' : 'Set as '}}  Admin
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
