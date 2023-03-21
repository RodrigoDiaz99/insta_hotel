@extends('layouts.guest')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">HABITACIONES DISPONIBLES EN <i>{{ $establishment->name }}</i></h3>
            </div>
        </header>
        <div class="card px-2 py-4 ">
            <div class="row mb-4">
                @forelse ($rooms as $room)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header p-0 bg-success text-white">
                                <span class="card-title text-center   my-1 font-weight-bold d-block">
                                    {{ $room->name }}
                                </span>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="card-body pt-2">
                                        <div class="  p-0 mx-3 mt-3">
                                            <img src="{{ asset('images\placeholder-establecimiento.jpg') }}" class="img-fluid border-radius-lg">
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="col">
                               {{$room->description}}
                                 </div>
                            </div>
                            <div class="card-footer ">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('crear.reservacion', ['room_id' => $room->id]) }}" class="btn btn-success">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>


                @empty
                    <div class="text-center mt-3">
                        <strong class="h4 text-danger">NO HAY HABITACIONES PARA MOSTRAR</strong>
                    </div>
                @endforelse
            </div>
        @endsection
