@extends('layouts.pelanggan')


@section('content')


@php

$vehicles = [

    (object)[
        'id' => 1,
        'name' => 'Honda Jazz RS 2020',
        'plate' => 'B 5678 DEF',
        'brand' => 'Honda',
        'year' => '2020',
        'color' => 'Putih',
        'odometer' => '35.200 KM',
        'service_count' => 8,
        'status' => 'Aktif',
        'image' => asset('images/car1.jpg')
    ],


    (object)[
        'id' => 2,
        'name' => 'Toyota Avanza Veloz',
        'plate' => 'B 1234 XYZ',
        'brand' => 'Toyota',
        'year' => '2022',
        'color' => 'Hitam',
        'odometer' => '82.100 KM',
        'service_count' => 12,
        'status' => 'Perlu Servis',
        'image' => asset('images/car2.jpg')
    ]

];

@endphp





<div class="p-5 md:p-8 lg:p-10">



    <!-- HEADER -->

    <div class="
        bg-white
        rounded-2xl
        border
        p-6
        shadow-sm
    ">


        <h1 class="text-2xl font-bold">

            Kendaraan Saya

        </h1>


        <p class="text-gray-500 mt-2">

            Kendaraan berikut terhubung otomatis berdasarkan data pelanggan dan riwayat servis.

        </p>


    </div>







    <!-- INFO TOTAL -->

    <div class="
        mt-6
        bg-[#111827]
        text-white
        rounded-2xl
        p-6
    ">


        <p class="text-gray-400 text-sm">

            Total Kendaraan Terhubung

        </p>


        <h2 class="text-3xl font-bold mt-2">

            {{ count($vehicles) }}

            <span class="text-lg font-normal">
                Kendaraan
            </span>

        </h2>


    </div>







    <!-- LIST KENDARAAN -->

    <div class="
        grid
        grid-cols-1
        xl:grid-cols-2
        gap-6
        mt-8
    ">




    @foreach($vehicles as $vehicle)


        <div class="
            bg-white
            rounded-2xl
            border
            p-6
            shadow-sm
            hover:shadow-md
            transition
        ">


            <div class="flex gap-5">


                <img
                    src="{{ $vehicle->image }}"
                    class="
                    w-32
                    h-24
                    rounded-xl
                    object-cover
                    "
                >



                <div class="flex-1">


                    <div class="flex justify-between">


                        <div>

                            <h2 class="font-bold text-xl">

                                {{ $vehicle->name }}

                            </h2>


                            <p class="text-gray-500">

                                {{ $vehicle->plate }}

                            </p>

                        </div>




                        @if($vehicle->status == 'Aktif')

                        <span class="
                            bg-green-100
                            text-green-600
                            text-xs
                            px-3
                            py-1
                            rounded-full
                            h-fit
                        ">

                            Aktif

                        </span>


                        @else


                        <span class="
                            bg-yellow-100
                            text-yellow-600
                            text-xs
                            px-3
                            py-1
                            rounded-full
                            h-fit
                        ">

                            Perlu Servis

                        </span>


                        @endif



                    </div>


                </div>


            </div>







            <div class="
                grid
                grid-cols-2
                gap-4
                mt-6
                text-sm
            ">


                <div>

                    <p class="text-gray-400">
                        Merk
                    </p>

                    <p class="font-semibold">
                        {{ $vehicle->brand }}
                    </p>

                </div>




                <div>

                    <p class="text-gray-400">
                        Tahun
                    </p>

                    <p class="font-semibold">
                        {{ $vehicle->year }}
                    </p>

                </div>




                <div>

                    <p class="text-gray-400">
                        Kilometer
                    </p>

                    <p class="font-semibold">
                        {{ $vehicle->odometer }}
                    </p>

                </div>




                <div>

                    <p class="text-gray-400">
                        Total Servis
                    </p>

                    <p class="font-semibold">
                        {{ $vehicle->service_count }} kali
                    </p>

                </div>



            </div>







            <a
                href="{{ route('pelanggan.kendaraan.riwayat',$vehicle->id) }}"
                class="
                block
                text-center
                mt-6
                bg-[#111827]
                text-white
                py-3
                rounded-xl
                font-semibold
                "
            >

                Lihat Riwayat Servis

            </a>



        </div>



    @endforeach




    </div>





</div>


@endsection