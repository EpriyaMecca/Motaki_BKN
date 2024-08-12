@php
  $header = 'Task'; // Variabel header yang mungkin digunakan di bagian lain
  $cardTittle = 'Task'; // Variabel cardTittle yang mungkin digunakan di bagian lain
@endphp

@push('css')
@endpush
@extends('layouts.app') <!-- Menggunakan layout 'layouts.app' -->

@section('content')
  <!-- Tombol untuk menambah card -->
  {{-- <button id="addContainerButton" class="btn btn-secondary mb-3">Tambah Card</button> --}}

  <div class="row mt-4">
    <!-- Kontainer utama untuk card -->
    <div class="row" id="containers">

      <!-- Card untuk kategori ToDo -->
      <div class="col-md-4 mb-3">
        <div class="card" id="todo-container">
          <div class="card-body" id="first">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark mb-0">ToDo</h2>
              {{-- <button id="addCardButton" class="btn btn-light">+ Add a card</button> --}}
            </div>
            <!-- Daftar tugas dengan status 'ToDo' -->
            @foreach ($todoTasks as $task)
              <div class="task-container position-relative mt-3">
                <div class="task-content form-control cursor-pointer position-relative" draggable="true"
                  id="card-{{ $task->id }}" data-id="{{ $task->id }}">
                  {{ $task->name }} ({{ $task->layanan_nama }})
                  <br>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="date-container">
                      <i class="fas fa-calendar-check text-primary icon-calendar"></i> {{ $task->start_date }}
                    </div>
                    @if ($task->Foto)
                      <img src="data:image/png;base64,{{ base64_encode($task->Foto) }}" alt="Foto"
                        class="avatar avatar-xs rounded-circle">
                    @else
                      <img src="/assets/img/team-4.jpg" alt="Dummy Foto" class="avatar avatar-xs rounded-circle">
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>


      <!-- Card untuk kategori In Progress -->
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body" id="second">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark">In Progress</h2>
            </div>
            <!-- Daftar tugas dengan status 'In Progress' -->
            @foreach ($inProgressTasks as $task)
              <div class="task-container position-relative mt-3">
                <div class="task-content form-control cursor-pointer position-relative" draggable="true"
                  id="card-{{ $task->id }}" data-id="{{ $task->id }}">
                  {{ $task->name }} ({{ $task->layanan_nama }})
                  <br>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="date-container">
                      <i class="fas fa-calendar-check text-primary icon-calendar"></i> {{ $task->start_date }}
                    </div>
                    @if ($task->Foto)
                      <img src="data:image/png;base64,{{ base64_encode($task->Foto) }}" alt="Foto"
                        class="avatar avatar-xs rounded-circle">
                    @else
                      <img src="/assets/img/team-4.jpg" alt="Dummy Foto" class="avatar avatar-xs rounded-circle">
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Card untuk kategori Done -->
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body" id="third">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark">Done</h2>
            </div>
            <!-- Daftar tugas dengan status 'Done' -->
            @foreach ($doneTasks as $task)
              <div class="task-container position-relative mt-3">
                <div class="task-content form-control cursor-pointer position-relative" draggable="true"
                  id="card-{{ $task->id }}" data-id="{{ $task->id }}">
                  {{ $task->name }} ({{ $task->layanan_nama }})
                  <br>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="date-container">
                      <i class="fas fa-calendar-check text-primary icon-calendar"></i> {{ $task->start_date }}
                    </div>
                    <div class="progress">
                      Progress: {{ $task->progress }}%
                    </div>

                    @if ($task->Foto)
                      <img src="data:image/png;base64,{{ base64_encode($task->Foto) }}" alt="Foto"
                        class="avatar avatar-xs rounded-circle">
                    @else
                      <img src="/assets/img/team-4.jpg" alt="Dummy Foto" class="avatar avatar-xs rounded-circle">
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail Tugas -->
  @foreach ($allTasks as $task)
    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
      aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">Task Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <!-- Menampilkan detail tugas -->
              <div class="col-4 text-start mb-5">
                <i class="fas fa-user fa-lg p-1 text-primary"></i>
                <div>
                  Name:
                  <div class="col">{{ $task->name }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-info-circle fa-lg p-1 text-primary"></i>
                <div>
                  Status:
                  <div class="col">{{ $task->status }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-sticky-note fa-lg p-1 text-primary"></i>
                <div>
                  Keterangan:
                  <div class="col">{{ $task->keterangan }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-align-left fa-lg p-1 text-primary"></i>
                <div>
                  Deskripsi:
                  <div class="col">{{ $task->deskripsi }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-star fa-lg p-1 text-primary"></i>
                <div>
                  Skor Utama:
                  <div class="col">{{ $task->skor_utama }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-plus-circle fa-lg p-1 text-primary"></i>
                <div>
                  Skor Tambahan:
                  <div class="col">{{ $task->skor_tambahan }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-calendar-alt fa-lg p-1 text-primary"></i>
                <div>
                  Start Date:
                  <div class="col">{{ $task->start_date }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-calendar-check fa-lg p-1 text-primary"></i>
                <div>
                  Due Date:
                  <div class="col">{{ $task->due_date }}</div>
                </div>
              </div>
              <div class="col-4 text-start mb-5">
                <i class="fas fa-flag-checkered fa-lg p-1 text-primary"></i>
                <div>Finish Date:
                  <div class="col">{{ $task->finish_date }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn bg-gradient-dark my-4 mb-2"
              data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection
