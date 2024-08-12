@php
  $header = 'Task';
  $cardTittle = 'Task';
@endphp

@extends('layouts.app')

@section('content')
  <div class="row mt-4">
    <div class="row" id="containers">
      <!-- Card untuk kategori ToDo -->
      <div class="col-md-4 mb-3">
        <div class="card" id="todo-container">
          <div class="card-body" id="first">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark mb-0">ToDo</h2>
            </div>
            <!-- Daftar tugas dengan status 'ToDo' -->
            @foreach ($todoTasks as $task)
              <div class="task-container position-relative mt-3">
                <div class="task-content form-control cursor-pointer position-relative" draggable="true"
                  id="card-{{ $task->id }}" data-id="{{ $task->id }}">
                  {{ $task->name }} ({{ $task->layanan_nama }})
                  <br>
                  <br>
                  <span class="text-muted">{{ $task->staff_name }}</span>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="date-container">
                      <i class="fas fa-calendar-alt text-primary icon-calendar"></i> {{ $task->start_date }}
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

      <!-- Card untuk kategori on Progress -->
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body" id="second">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="text-dark">On Progress</h2>
            </div>
            <!-- Daftar tugas dengan status 'on Progress' -->
            @foreach ($inProgressTasks as $task)
              @php
                $taskClass = '';
                if ($task->days_left < 0) {
                    $taskClass = 'task-danger';
                } elseif ($task->days_left <= 3) {
                    $taskClass = 'task-warning task-due-soon';
                }
              @endphp
              <div class="task-container position-relative mt-3">
                <div class="task-content form-control cursor-pointer position-relative" draggable="true"
                  id="card-{{ $task->id }}" data-id="{{ $task->id }}">
                  {{ $task->name }} ({{ $task->layanan_nama }})
                  <br>
                  <br>
                  <span class="text-muted">{{ $task->staff_name }}</span>
                  <br>
                  <div class="d-flex align-items-center">
                    @php
                      $progress = $task->progress ?? 0;
                      $progressClass = '';

                      if ($progress >= 10 && $progress <= 50) {
                          $progressClass = 'bg-gradient-danger';
                      } elseif ($progress >= 51 && $progress <= 89) {
                          $progressClass = 'bg-gradient-info';
                      } elseif ($progress >= 90 && $progress <= 100) {
                          $progressClass = 'bg-gradient-success';
                      }
                    @endphp

                    <div class="progress flex-grow-1 me-2">
                      <div class="progress-bar {{ $progressClass }}" role="progressbar"
                        style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div class="progress-text ">
                      {{ $progress ? $progress . '%' : 'No progress data' }}
                    </div>
                  </div>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column w-100">
                      @if ($task->days_left <= 14 && $task->days_left > 0)
                        <div class="me-3 text-danger">
                          <i class="fas fa-exclamation-triangle"></i> Days Left: {{ $task->days_left }} (Deadline
                          approaching!)
                        </div>
                      @elseif ($task->days_left > 14)
                        <div class="me-3">
                          <i class="fas fa-hourglass-half"></i> Days Left: {{ $task->days_left }}
                        </div>
                      @endif
                      <div class="mt-2">
                        <i class="fas fa-flag-checkered  text-primary icon-calendar"></i> {{ $task->finish_date }}
                      </div>
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
                  <span class="text-muted">{{ $task->staff_name }}</span>
                  <br>
                  <div class="d-flex align-items-center">
                    @php
                      $progress = $task->progress ?? 0;
                      $progressClass = '';

                      if ($progress >= 10 && $progress <= 50) {
                          $progressClass = 'bg-gradient-danger';
                      } elseif ($progress >= 51 && $progress <= 89) {
                          $progressClass = 'bg-gradient-info';
                      } elseif ($progress >= 90 && $progress <= 100) {
                          $progressClass = 'bg-gradient-success';
                      }
                    @endphp

                    <div class="progress flex-grow-1 me-2">
                      <div class="progress-bar {{ $progressClass }}" role="progressbar"
                        style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                    <div class="progress-text ">
                      {{ $progress ? $progress . '%' : 'No progress data' }}
                    </div>
                  </div>
                  <br>
                  <div class="date-photo-container d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between w-100">
                      @if ($task->days_left > 0)
                        <div class="me-3">
                          <i class="fas fa-flag-checkered text-primary icon-calendar"></i> {{ $task->finish_date }}
                        </div>
                      @endif
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
