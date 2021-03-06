@extends('layouts.app')
@section('content')
    <div class="container">

        @forelse ($data as $message)
            <div class="my_message p-0 alert alert-light text-dark shadow-sm">
                <div class="my_message_header p-3 d-flex justify-content-between">
                    <h5><i class="bi bi-person-badge d-none d-md-inline-block"></i> {{$message->name}}</h5>
                    <p class="mb-0"><span class="d-none d-md-inline-block">Da:</span> {{$message->email}}</p>
                </div>
                <div class="my_message_body p-3">
                    <p>{{$message->text}}</p>
                </div>
                <div class="my_message_footer p-3 d-flex justify-content-end">
                    <span>{{$message->created_at}}</span>
                </div>
            </div>
        @empty
        <div class="alert alert-secondary" role="alert">
            <p>Non ci sono messaggi</p>
        </div>  
        @endforelse


        {{-- Pagination --}}
        {{ $data->links() }}
        
       <!-- Go-Back Button -->
       <a class="btn btn-secondary" href="{{route('admin.users.index')}}">Go Back</a>
    </div>
    
@endsection