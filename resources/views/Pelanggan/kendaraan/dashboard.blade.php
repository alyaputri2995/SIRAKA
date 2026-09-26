@extends('layouts.pelanggan')

@section('content')

@php

$vehicles = [

    (object) [
        'id' => 1,
        'name' => 'Honda Jazz RS 2020',
        'plate_number' => 'B 5678 DEF',
        'status' => 'Selesai',
        'last_service' => '10 September 2024',
        'odometer' => '35.200 KM',
        'complaint' => 'Servis berkala'
    ],

    (object) [
        'id' => 2,
        'name' => 'Toyota Avanza Veloz',
        'plate_number' => 'B 1234 XYZ',
        'status' => 'Perlu Servis',
        'last_service' => '01 Juli 2024',
        'odometer' => '82.100 KM',
        'complaint' => 'Pemeriksaan mesin'
    ]

];

@endphp



<div class="p-5 md:p-8 lg:p-10">


    {{-- HEADER --}}

    <div class="
        bg-[#111827]
        rounded-2xl
        p-6
        text-white
        flex
        justify-between
        items-center
    ">

        <div>

            <h1 class="text-xl md:text-2xl font-bold">
                Halo, Ahmad 👋
            </h1>

            <p class="text-gray-400 text-sm mt-1">
                Pantau kondisi kendaraan Anda melalui SIRAKA
            </p>

        </div>


        <button class="
            bg-gray-700
            w-11
            h-11
            rounded-full
        ">
            🔔
        </button>


    </div>





    {{-- SUMMARY --}}

    <div class="
        grid
        grid-cols-1
        md:grid-cols-3
        gap-5
        mt-6
    ">


        <div class="
            bg-white
            rounded-2xl
            border
            p-5
        ">

            <p class="text-gray-500 text-sm">
                Total Kendaraan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ count($vehicles) }}
            </h2>

            <p class="text-gray-400 text-sm mt-2">
                Kendaraan terhubung
            </p>

        </div>





        <div class="
            bg-white
            rounded-2xl
            border
            p-5
        ">

            <p class="text-gray-500 text-sm">
                Servis Terakhir
            </p>

            <h2 class="font-bold mt-2">
                10 September 2024
            </h2>

            <p class="text-gray-400 text-sm mt-2">
                Honda Jazz RS 2020
            </p>

        </div>





        <div class="
            bg-white
            rounded-2xl
            border
            p-5
        ">

            <p class="text-gray-500 text-sm">
                Status Kendaraan
            </p>

            <h2 class="
                font-bold
                mt-2
                text-orange-500
            ">
                Perlu Perhatian
            </h2>

            <p class="text-gray-400 text-sm mt-2">
                1 kendaraan perlu servis
            </p>

        </div>


    </div>







    {{-- ALERT --}}

    <div class="
        mt-6
        bg-orange-50
        border
        border-orange-300
        rounded-xl
        p-4
        text-orange-600
        text-sm
    ">

        🛡️

        Semua riwayat kendaraan Anda tersimpan aman dan transparan di SIRAKA.

    </div>







    {{-- KENDARAAN PERLU SERVIS --}}

    <div class="mt-10">


        <div class="flex justify-between items-center mb-5">


            <div>

                <h2 class="text-xl font-bold">
                    Kendaraan Perlu Perhatian
                </h2>


                <p class="text-gray-500 text-sm">
                    Kendaraan yang membutuhkan pengecekan
                </p>

            </div>



            <a href="{{ route('pelanggan.kendaraan') }}"
               class="text-orange-500 font-semibold text-sm">

                Lihat Semua

            </a>


        </div>





        @foreach($vehicles as $vehicle)

            @if($vehicle->status == 'Perlu Servis')


            <div class="
                bg-white
                border
                rounded-2xl
                p-6
            ">


                <div class="flex justify-between">


                    <div>

                        <h3 class="font-bold text-lg">
                            {{ $vehicle->name }}
                        </h3>


                        <p class="text-gray-500">
                            {{ $vehicle->plate_number }}
                        </p>

                    </div>



                    <span class="
                        bg-orange-100
                        text-orange-600
                        px-3
                        py-1
                        rounded-full
                        text-xs
                    ">

                        Perlu Servis

                    </span>


                </div>





                <div class="
                    grid
                    grid-cols-2
                    mt-5
                    gap-5
                ">


                    <div>

                        <p class="text-gray-400 text-sm">
                            Servis Terakhir
                        </p>

                        <p class="font-semibold">
                            {{ $vehicle->last_service }}
                        </p>

                    </div>



                    <div>

                        <p class="text-gray-400 text-sm">
                            Odometer
                        </p>

                        <p class="font-semibold">
                            {{ $vehicle->odometer }}
                        </p>

                    </div>


                </div>




                <a href="{{ route('pelanggan.kendaraan.riwayat',$vehicle->id) }}"
                   class="
                   block
                   mt-6
                   text-center
                   bg-[#111827]
                   text-white
                   py-3
                   rounded-xl
                   font-semibold
                   ">

                    Lihat Rekam Servis

                </a>



            </div>


            @endif

        @endforeach


    </div>







    {{-- AKTIVITAS TERBARU --}}

    <div class="mt-10">


        <h2 class="text-xl font-bold mb-5">
            Aktivitas Terbaru
        </h2>



        <div class="
            bg-white
            border
            rounded-2xl
            p-6
        ">


            <div class="
                flex
                justify-between
                border-b
                pb-4
                mb-4
            ">


                <div>

                    <p class="font-semibold">
                        Servis Berkala
                    </p>

                    <p class="text-gray-500 text-sm">
                        Honda Jazz RS 2020
                    </p>

                </div>


                <span class="text-green-600 text-sm">
                    Selesai
                </span>


            </div>





            <div class="flex justify-between">


                <div>

                    <p class="font-semibold">
                        Pemeriksaan Mesin
                    </p>

                    <p class="text-gray-500 text-sm">
                        Toyota Avanza Veloz
                    </p>

                </div>


                <span class="text-orange-600 text-sm">
                    Perlu Servis
                </span>


            </div>


        </div>


    </div>



</div>


@endsection