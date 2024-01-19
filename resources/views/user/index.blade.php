@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ __('user.USER_DATA') }}</h2>

    @if ($executionTime > 250)
    <h5 class="mb-4">{{'Slow query executed: ' . $executionTime . 'ms'}}</h5>
    @else
    <h5 class="mb-4">{{ __('user.EXECUTION_TIME') }} : {{$executionTime}}</h5>
    @endif

    <div class="row mb-3">
        <div class="col-md-3">
            <label for="dobYearFilter" class="form-label">{{__('user.BIRTH_YEAR')}}:</label>
            <input type="number" class="form-control"  placeholder="Enter year">
        </div>
        <div class="col-md-3">
            <label for="dobYearFilter" class="form-label">{{__('user.BIRTH_MONTH')}}:</label>
            <input type="number" class="form-control" placeholder="Enter month">
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-warning mt-4">{{__('user.FILTER')}}</button>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">{{ __('user.ID') }}</th>
                <th scope="col">{{ __('user.NAME') }}</th>
                <th scope="col">{{ __('user.EMAIL') }}</th>
                <th scope="col">{{ __('user.PHONE') }}</th>
                <th scope="col">{{ __('user.DOB') }}</th>
                <th scope="col">{{ __('user.IP_ADDRESS') }}</th>
                <th scope="col">{{ __('user.COUNTRY') }}</th>
                <th scope="col">{{ __('user.CREATED_AT') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->date_of_birth}}</td>
                <td>{{$user->ip}}</td>
                <td>{{$user->country}}</td>
                <td>{{$user->created_at}}</td>
            </tr>
            @empty
            <tr>
                <td>{{ __('user.NO_DATA_FOUND') }}</td>
            </tr>
            @endforelse

            <!-- Add more rows as needed -->
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>


@endsection
