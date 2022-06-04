<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div id="main" class="main-content flex-1 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Total Pemesanan</h2>
                               <p class="font-bold text-3xl">{{$pesanans->count()}} <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Total Kendaraan</h2>
                                <p class="font-bold text-3xl">{{$kendaraans->count()}} <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Total Pemesanan Diterima</h2>
                                <p class="font-bold text-3xl">{{$pesanans->where('status','Diterima')->count()}}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-red-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Total Pemesanan Ditolak</h2>
                                <p class="font-bold text-3xl">{{$pesanans->where('status','Ditolak')->count()}} <span class="text-red-500"><i class="fas fa-caret-up"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>


            <div class="flex flex-row flex-wrap flex-grow mt-2">


            <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                <!--Graph Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                		<input type="month" wire:model="month" class="rounded-lg border-gray-400">
                		<button wire:click="export()">Export</button>
                        <h2 class="font-bold uppercase text-gray-600">Grafik Pemesanan/tanggal</h2>
                    </div>
                    <div class="p-5">
                        <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                        <script>
                            new Chart(document.getElementById("chartjs-0"), {
                                "type": "line",
                                "data": {
                                    "labels": [{!! implode(" ",$labelDays) !!}],
                                    "datasets": [{
                                        "label": "Pemesanan",
                                        "data": [{!! implode(" ",$dataDays) !!}],
                                        "fill": false,
                                        "borderColor": "rgb(75, 192, 192)",
                                        "lineTension": 0.1
                                    }]
                                },
                                "options": {}
                            });
                        </script>
                    </div>
                </div>
                <!--/Graph Card-->
            </div>

            <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                <!--Graph Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h5 class="font-bold uppercase text-gray-600">Grafik Perbandingan Diterima/Ditolak</h5>
                    </div>
                    <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                        <script>
                            new Chart(document.getElementById("chartjs-4"), {
                                "type": "doughnut",
                                "data": {
                                    "labels": [ "Diterima", "Ditolak"],
                                    "datasets": [{
                                        "label": "Issues",
                                        "data": [{!! $pesanans->where('status','Diterima')->count() !!}, {!! $pesanans->where('status','Ditolak')->count() !!}],
                                        "backgroundColor": ["rgb(54, 162, 235)", "rgb(255, 99, 132)"]
                                    }]
                                }
                            });
                        </script>
                    </div>
                </div>
                <!--/Graph Card-->
            </div>

            </div>
        </div>
        </div>
    </div>
</div>