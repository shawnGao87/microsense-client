@extends('layout.layout')

{{-- {{dd($readers)}} --}}
@section('content')
<div class="container">
    <form action="/jobs" method="POST">
        @csrf
        @if (session('jobs'))
            @foreach (session('jobs') as $reader_name => $operation)
                <ul>
                    <li class="text-success">{{$reader_name}} is scheduled with operation {{$operation}}</li>
                </ul>
            @endforeach
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error_key => $error)
                <ul>
                    <li class="text-danger">{{$error}}</li>
                </ul>
            @endforeach

        @endif
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Select</th>
                <th scope="col">Reader</th>
                <th scope="col">Type</th>
                <th scope="col">Address</th>
                <th scope="col">Health Status</th>
                <th scope="col">Message</th>
                <th scope="col">Operations</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($readers->readers_and_health as $reader_name => $reader)
                <tr>
                <td>
                    {{-- 
                        the "name" attribute is going to make the post request as an array 
                        readers => [ reader_name ]
                    --}}
                    {{-- {{dd($errors)}} --}}
                    <input type="checkbox" name="readers[{{$reader_name}}]" {{(array_key_exists('status', $reader) && strtolower($reader['status'])=='error' ) ? 'disabled' : ''}}>
                        
                </td>
                <td>
                    {{$reader_name}}
                </td>
                <td>
                    {{$reader['type']}}
                </td>
                <td>
                    {{$reader['address']}}
                </td>
                <td>
                    {{array_key_exists('status', $reader) ? $reader['status'] : 'OK'}}
                </td>
                <td>
                    {{array_key_exists('message', $reader) ? $reader['message'] : ''}}
                </td>
                <td>
                    <select name="operations[{{$reader_name}}]" {{(array_key_exists('status', $reader) && strtolower($reader['status'])=='error' ) ? 'disabled' : ''}}>
                        <option disabled selected value></option>
                        @foreach ($readers->operations as $operation)
                            <option value={{$operation}}>{{$operation}}</option>
                        @endforeach
                    </select>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-success">Start Jobs</button>
    </form>
</div>
@endsection