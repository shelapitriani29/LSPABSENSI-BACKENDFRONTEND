@extends('layouts.app')

@section('title','Dashboard')

@section('page-title','Dashboard')

@section('content')

<div class="mb-4">
    <small class="text-secondary">
        Home / Dashboard
    </small>
</div>

{{-- =========================
    STATISTIK
========================= --}}

<div class="row g-4">

    <div class="col-md-3">
        @include('components.stat-card',[
            'title'=>'Peserta',
            'value'=>'125',
            'color'=>'blue'
        ])
    </div>

    <div class="col-md-3">
        @include('components.stat-card',[
            'title'=>'Asesor',
            'value'=>'15',
            'color'=>'red'
        ])
    </div>

    <div class="col-md-3">
        @include('components.stat-card',[
            'title'=>'Skema',
            'value'=>'8',
            'color'=>'green'
        ])
    </div>

    <div class="col-md-3">
        @include('components.stat-card',[
            'title'=>'Sertifikat',
            'value'=>'98',
            'color'=>'orange'
        ])
    </div>

</div>

{{-- =========================
    GRAFIK & PERSENTASE
========================= --}}

<div class="row mt-4">

    <div class="col-lg-8">

        @include('components.chart-card')

    </div>

    <div class="col-lg-4">

        <div class="dashboard-card text-center">

            <h4>Hasil Sertifikasi</h4>

            <hr>

            <h5 class="text-success">Lulus</h5>

            <h1 class="display-5 fw-bold text-success">
                80%
            </h1>

            <hr>

            <h5 class="text-danger">Tidak Lulus</h5>

            <h1 class="display-5 fw-bold text-danger">
                20%
            </h1>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-6">

        @include('components.schedule-card')

    </div>

    <div class="col-lg-6">

        @include('components.activity-card')

    </div>

</div>

@endsection

@push('scripts')

<script type="module">

import Chart from 'chart.js/auto';

const ctx = document.getElementById('sertifikasiChart');

if(ctx){

new Chart(ctx,{

type:'bar',

data:{

labels:['2023','2024','2025','2026'],

datasets:[

{

label:'Lulus',

data:[80,90,100,85],

backgroundColor:'#22c55e'

},

{

label:'Tidak Lulus',

data:[20,10,5,15],

backgroundColor:'#ef4444'

}

]

},

options:{

responsive:true,

plugins:{

legend:{

position:'top'

}

}

}

});

}

</script>

@endpush