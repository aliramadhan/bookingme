<div>
	<div class="py-12">

		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		    <button wire:click="create()"
		        class="bg-transparent mb-4 mx-3 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
		        Tambah Kendaraan
		    </button>
		    @if($isModalOpen)
		    @include('livewire.Kendaraan.create')
		    @endif
			<div class="mx-3 relative overflow-x-auto shadow-md sm:rounded-lg">
			    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
			            <tr>
			                <th scope="col" class="px-6 py-3">
			                    No.
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Nomor Polisi
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Nama Kendaraan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Jenis Kendaraan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Jenis Kepemilikan
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Jenis BBM
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Action
			                </th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($kendaraans as $kendaraan)
			            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
			                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
			                    {{$loop->iteration}}
			                </th>
			                <td class="px-6 py-4">
			                    {{$kendaraan->nopol}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$kendaraan->nama}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$kendaraan->jenis_kendaraan}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$kendaraan->jenis_owner}}
			                </td>
			                <td class="px-6 py-4">
			                    {{$kendaraan->jenis_bbm}}
			                </td>
			                <td class="px-6 py-4 text-right">
			                    <button wire:click="edit({{ $kendaraan->id }})"
	                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">Edit</button>
	                            <button onclick="confirm('Hapus Kendaran {!! $kendaraan->name !!}?') || event.stopImmediatePropagation()" wire:click="delete({{ $kendaraan->id }})"
	                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Delete</button>
			                </td>
			            </tr>
			            @endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>