@extends('layouts.print')

@section('content')


    <p align="center"><img src="{{ url('images/letterheadppz.jpg') }}" alt=""></p>

    <table class="table table-bordered table-striped table-hover">
        <tr class="warning">
            <th>Kategori</th>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mac</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ogos</th>
            <th>Sept</th>
            <th>Okt</th>
            <th>Nov</th>
            <th>Dis</th>
        </tr>
        @foreach($complains_statistics_row as $key => $value)
            <tr>
                <td>{{ $key }}</td>

                @foreach($value as $month_total)

                    <td>{{ $month_total }}</td>

                @endforeach

            </tr>
        @endforeach
        <tfoot>
        <tr class="info">
            <td>Jumlah</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </table>

@endsection

