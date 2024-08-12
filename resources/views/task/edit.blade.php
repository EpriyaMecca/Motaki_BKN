@php
  $header = 'Show';
  $cardTittle = 'Show';
@endphp
@extends('layouts.app')
@section('content')
  @foreach ($task as $task)
    <!-- Button to Add Container -->
    <button id="addContainerButton" class="btn btn-secondary mb-3">Tambah Card</button>

    <div class="row" id="containers">
      <div class="col-md-4 mb-3">
        <div class="card" id="todo-container">
          <div class="card-body" id="first">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark mb-0">Todo</h2>
              <button id="addCardButton" class="btn btn-light">+ Add a card</button>
            </div>
            <i class="fas fa-calendar-alt opacity-10 p-2"></i>
            <i class="fas fa-calendar-check opacity-10 p-2"></i>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body" id="in-progress-container">
            <h2 class="text-dark">In Progress</h2>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body" id="done-container">
            <h2 class="text-dark">Done</h2>
          </div>
        </div>
      </div>
  @endforeach
  </div>
@endsection
