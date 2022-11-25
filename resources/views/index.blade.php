@extends('layouts.app')
@section('title')
My Todo App
@endsection
@section('content')

<div class="row mt-3">
    <div class="col-12 align-self-center">
        <ul class="list-group">
            @guest
            @else
            @foreach($todos as $todo)
            <li class="list-group-item">
                <a href="details/{{$todo->id}}" style="color:cornflower">{{$todo->name}}</a>
            </li>
            @endforeach
            @endguest
        </ul>
    </div>
</div>

@endsection