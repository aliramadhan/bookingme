<div>
	<div class="py-12">

		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	@if(auth()->user()->role == 'admin')
		    <button wire:click="create()"
		        class="bg-transparent mb-4 mx-3 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
		        Tambah Pemesanan
		    </button>
		    @endif

		    @if($isModalOpen)
		    	@include('livewire.Pesanan.create')
		    @endif
			<div class="mx-3 relative overflow-x-auto shadow-md sm:rounded-lg">
			    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
			        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			            <tr>
			                <th scope="col" class="px-6 py-3">
			                    No.
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Nama Pemesan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Nama Kendaraan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Tanggal Dipesan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Driver
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Status
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Tanggal Pemesanan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Action
			                </th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($pesanans as $pesanan)
			            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
			                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
			                    {{$loop->iteration}}
			                </th>
			                <td class="px-6 py-4">
			                    {{$pesanan->nama_pemesan}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$pesanan->nama_kendaraan}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$pesanan->tanggal_mulai->format('d M Y') .' - '. $pesanan->tanggal_stop->format('d M Y')}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$pesanan->nama_driver}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$pesanan->status}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$pesanan->created_at->format('H:i d M Y')}}
			                </td>
			                <td class="px-6 py-4 text-right">

			                    @if($pesanan->status != 'Proses')
			                    @if(auth()->user()->role == 'admin')
                            	<button onclick="confirm('Hapus Pesanan {!! $pesanan->nama_kendaraan !!} oleh {!! $pesanan->nama_pemesan !!}?') || event.stopImmediatePropagation()" wire:click="delete({{ $pesanan->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Delete</button>
			                    @endif
                            	@else
			                    @if(auth()->user()->role == 'admin')
		                    	<button wire:click="edit({{ $pesanan->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">Edit</button>
			                    @endif
			                    <button wire:click="accept({{ $pesanan->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Terima</button>
			                    <button wire:click="decline({{ $pesanan->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Tolak</button>
	                            @endif

			                </td>
			            </tr>
			            @endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>