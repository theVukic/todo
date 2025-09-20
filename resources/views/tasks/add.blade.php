@extends("layouts.default")

@section("content")
    <div class="d-flex align-items-center">
        <div class="container shadow-sm" style=" margin-top: 100px; max-width: 500px">
            <div class="fs-3 fw-bold text-center">
                {{ isset($task) ? 'Izmijeni zadatak' : 'Dodaj novi zadatak' }}
            </div>

            <form class="p-3" method="POST" action="{{ isset($task) ? route('task.update', $task->id) : route('task.add.post') }}">
                @csrf
                @if (isset($task))
                    @method('PUT')
                @endif

                <div class="mb-3 mt-1">
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', isset($task) ? $task->title : '') }}"
                        placeholder="Naslov zadatka">
                </div>

                <div class="mb-3">
                    <input
                        type="datetime-local"
                        class="form-control"
                        name="deadline"
                        value="{{ old('deadline', isset($task) ? \Illuminate\Support\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="mb-3">
        <textarea
            name="description"
            class="form-control"
            rows="3"
            placeholder="Opis zadatka">{{ old('description', isset($task) ? $task->description : '') }}</textarea>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{ session()->get("success") }}
                    </div>
                @endif
                @if(session()->has("error"))
                    <div class="alert alert-danger">
                        {{ session("error") }}
                    </div>
                @endif

                <button class="btn btn-{{ isset($task) ? 'warning' : 'success' }} rounded-pill" type="submit">
                    {{ isset($task) ? 'Sačuvaj izmjene' : 'Dodaj' }}
                </button>
            </form>
        </div>
    </div>
@endsection
