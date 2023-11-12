@extends('layout.admin')

@section('title', 'Hasil Akhir')

@section('content')
<div class="container-fluid px-4 mb-4">
    <h1 class="mt-4 mb-3">Hasil Akhir</h1>
    @include('partials.flash')
    <div class="accordion" id="resultAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultData" aria-expanded="false" aria-controls="resultData">
                    Data
                </button>
            </h2>
            <div id="resultData" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->criteria as $key => $val)
                                <th>
                                    {{ $criteria[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->data as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $v }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksR" aria-expanded="false" aria-controls="resultMatriksR">
                    Matriks R (Normalisasi)
                </button>
            </h2>
            <div id="resultMatriksR" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->criteria as $key => $val)
                                <th>
                                    {{ $criteria[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->normalizedMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ round($v, 4) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksV" aria-expanded="false" aria-controls="resultMatriksV">
                    Matriks V (Normalisasi Terbobot)
                </button>
            </h2>
            <div id="resultMatriksV" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->criteria as $key => $val)
                                <th>
                                    {{ $criteria[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->weightedMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ round($v, 4) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultConcordance" aria-expanded="false" aria-controls="resultConcordance">
                    Concordance
                </button>
            </h2>
            <div id="resultConcordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->concordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->concordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : implode(', ', $v) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultDiscordance" aria-expanded="false" aria-controls="resultDiscordance">
                    Discordance
                </button>
            </h2>
            <div id="resultDiscordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->discordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->discordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : implode(', ', $v) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksConcordance" aria-expanded="false" aria-controls="resultMatriksConcordance">
                    Matriks Concordance
                </button>
            </h2>
            <div id="resultMatriksConcordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->mConcordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->mConcordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : $v }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksDiscordance" aria-expanded="false" aria-controls="resultMatriksDiscordance">
                    Matriks Discordance
                </button>
            </h2>
            <div id="resultMatriksDiscordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->mDiscordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->mDiscordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : round($v, 4) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksDominanConcordance" aria-expanded="false" aria-controls="resultMatriksDominanConcordance">
                    Matriks Dominan Concordance
                </button>
            </h2>
            <div id="resultMatriksDominanConcordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->mdConcordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->mdConcordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : $v }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksDominanDiscordance" aria-expanded="false" aria-controls="resultMatriksDominanDiscordance">
                    Matriks Dominan Discordance
                </button>
            </h2>
            <div id="resultMatriksDominanDiscordance" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->mdDiscordanceMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($electre->mdDiscordanceMatrix as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($val as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : round($v, 4) }}
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#resultMatriksE" aria-expanded="false" aria-controls="resultMatriksE">
                    Agregate dominance Matriks E
                </button>
            </h2>
            <div id="resultMatriksE" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($electre->aggregatedMatrix as $key => $val)
                                <th>
                                    {{ $alternative[$key] }}
                                </th>
                                @endforeach
                                <th>Total</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        @foreach($electre->rank as $key => $val)
                        <tr>
                            <td>
                                {{ $alternative[$key] }}
                            </td>
                            @foreach($electre->aggregatedMatrix[$key] as $k => $v)
                            <td>
                                {{ $key==$k ? '-' : round($v, 4) }}
                            </td>
                            @endforeach
                            <td>{{ $electre->total[$key] }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
