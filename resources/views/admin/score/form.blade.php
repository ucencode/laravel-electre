@extends('layout.admin')

@section('title', 'Nilai Alternatif')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Penilaian Alternatif</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            Edit nilai alternatif - {{ $alternative->code }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                        <form action="{{ route('score.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="alternative_code" value="{{ $alternative->code }}">
                        <h4 class="mb-3">{{ $alternative->name }}</h4>

                        @foreach($criterias as $criteria)
                        <div class="mb-3">
                            <label for="criteria_{{ $criteria->code }}" class="form-label">{{  "[{$criteria->code}] {$criteria->name}" }}</label>
                            <input type="text" name="criteria[{{ $criteria->code }}]" class="form-control input-score @error('criteria.' . $criteria->code) is-invalid @enderror" id="criteria_{{ $criteria->code }}" value="{{ str_replace('.', ',', old('criteria.' . $criteria->code, $scores[$criteria->code] ?? 0)) }}" min="0" required>
                            @error('criteria.' . $criteria->code)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach
                        <a href="{{ route('score.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-2"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Allow only number but comma as decimal separator
        const inputScores = document.querySelectorAll('.input-score');

        inputScores.forEach(function (inputScore) {
            // when focused on the input, select all content
            inputScore.addEventListener('focus', function (e) {
                const isRound = /^\d*$/.test(e.target.value);
                if (!isRound) {
                    e.target.select();
                }
            });

            inputScore.addEventListener("input", function (e) {
                // When user type dot, replace it with comma
                e.target.value = e.target.value.replace(/\./g, ',');

                // Validate the input, using a regex
                const isValid = /^\d*,?([0-9]{1,2})?$/.test(e.target.value);
                if(!isValid)  {
                    e.target.value = e.target.value.substring(0, e.target.value.length - 1);
                    return false;
                }
            });
        });
    });
</script>
@endpush
