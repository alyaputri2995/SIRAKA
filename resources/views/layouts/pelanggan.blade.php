<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIRAKA Pelanggan</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>



<body class="bg-[#f5f7fb]">



<div class="min-h-screen flex">



    <!-- SIDEBAR DESKTOP -->

    <aside class="
        hidden
        lg:flex
        w-72
        fixed
        top-0
        left-0
        bottom-0
        bg-[#111827]
        text-white
        flex-col
        p-6
    ">


        <!-- LOGO -->

        <div class="flex items-center gap-4 mb-12">


            <img
                src="{{ asset('images/logo.jpeg') }}"
                alt="Logo SIRAKA"
                class="
                    w-14
                    h-14
                    rounded-xl
                    object-cover
                "
            >



            <div>

                <h2 class="text-xl font-bold">

                    SIRAKA

                </h2>


                <p class="text-xs text-gray-400">

                    Sistem Riwayat Kendaraan

                </p>


            </div>


        </div>






        <!-- MENU -->

        <nav class="space-y-3 flex-1">



            <a href="/pelanggan/dashboard"
                class="
                flex
                items-center
                gap-3
                px-5
                py-3
                rounded-xl
                bg-orange-500
                text-black
                font-semibold
                ">

                <span>
                    🏠
                </span>

                Dashboard

            </a>





            <a href="#"
                class="
                flex
                items-center
                gap-3
                px-5
                py-3
                rounded-xl
                text-gray-300
                hover:bg-gray-800
                transition
                ">

                <span>
                    🚗
                </span>

                Kendaraan

            </a>






            <a href="#"
                class="
                flex
                items-center
                gap-3
                px-5
                py-3
                rounded-xl
                text-gray-300
                hover:bg-gray-800
                transition
                ">

                <span>
                    🕒
                </span>

                Riwayat

            </a>






            <a href="#"
                class="
                flex
                items-center
                gap-3
                px-5
                py-3
                rounded-xl
                text-gray-300
                hover:bg-gray-800
                transition
                ">

                <span>
                    👤
                </span>

                Profil

            </a>



        </nav>





        <!-- FOOTER SIDEBAR -->

        <div class="text-xs text-gray-500">

            © 2026 SIRAKA

        </div>




    </aside>







    <!-- CONTENT -->

    <main class="
        flex-1
        lg:ml-72
        pb-20
        lg:pb-0
    ">


        @yield('content')


    </main>





</div>








<!-- MOBILE BOTTOM NAV -->

<div class="
fixed
bottom-0
left-0
right-0
bg-white
border-t
border-gray-200
flex
justify-around
py-4
lg:hidden
z-50
">



    <a href="/pelanggan/dashboard"
        class="text-orange-500 text-xs flex flex-col items-center gap-1">

        <span class="text-lg">
            🏠
        </span>

        Dashboard

    </a>





    <a href="#"
        class="text-gray-500 text-xs flex flex-col items-center gap-1">

        <span class="text-lg">
            🚗
        </span>

        Kendaraan

    </a>





    <a href="#"
        class="text-gray-500 text-xs flex flex-col items-center gap-1">

        <span class="text-lg">
            🕒
        </span>

        Riwayat

    </a>





    <a href="#"
        class="text-gray-500 text-xs flex flex-col items-center gap-1">

        <span class="text-lg">
            👤
        </span>

        Profil

    </a>



</div>




</body>

</html>