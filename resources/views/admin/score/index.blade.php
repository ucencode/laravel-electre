@extends('layout.admin')

@section('title', 'Nilai Alternatif')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Nilai Alternatif</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header text-white">
            Pengisian nilai alternatif pada setiap kriteria yang telah ditetapkan.
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($criterias as $criteria)
                        <th title="{{ $criteria->name }}" data-bs-toggle="tooltip" data-bs-title="{{ $criteria->name }} ({{ str_replace('.', ',', $criteria->weight) }})">{{ $criteria->code }}</th>
                        @endforeach
                        <th class="col-buttons">Input Nilai</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($alternatives as $alternative)
                    <tr>
                        <td>{{ "[{$alternative->code}] {$alternative->name}" }}</td>
                        @foreach($criterias as $criteria)
                        <td>
                            @if (isset($scores[$alternative->code][$criteria->code]))
                                {{ str_replace('.', ',', $scores[$alternative->code][$criteria->code]) }}
                            @else
                                0
                            @endif
                        </td>
                        @endforeach
                        <td>
                            <a href="{{ route('score.create', ['alt_code' => $alternative->code]) }}" class="btn btn-yellow btn-sm"><i class="fa fa-edit fa-fw"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
