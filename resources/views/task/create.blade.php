@php
  $header = 'Task';
  $cardTittle = 'Task';
@endphp
@extends('layouts.app')

@section('content')
  <h1>Add Task</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('task.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" class="form-control" id="description" required></textarea>
    </div>
    <div class="form-group">
      <label for="status">Status</label>
      <input type="text" name="status" class="form-control" id="status" required>
    </div>
    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="date" name="start_date" class="form-control" id="start_date" required>
    </div>
    <div class="form-group">
      <label for="due_date">Due Date</label>
      <input type="date" name="due_date" class="form-control" id="due_date" required>
    </div>
    <div class="form-group">
      <label for="finish_date">Finish Date</label>
      <input type="date" name="finish_date" class="form-control" id="finishDate">
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan</label>
      <input type="text" name="keterangan" class="form-control" id="keterangan" required>
    </div>
    <div class="form-group">
      <label for="skor_utama">Skor Utama</label>
      <input type="number" name="skor_utama" class="form-control" id="skorUtama" required min="0" max="100">
    </div>
    <div class="form-group">
      <label for="skor_tambahan">Skor Tambahan</label>
      <input type="number" name="skor_tambahan" class="form-control" id="skorTambahan" required min="0"
        max="100">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
