<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="nameFormInput"
                                class="block text-gray-700 text-sm font-bold mb-2">Nopol:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nopolFormInput" placeholder="Ex. N1234BM" wire:model="nopol">
                            @error('nopol') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                    
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label for="nameFormInput"
                                class="block text-gray-700 text-sm font-bold mb-2">Nama Kendaraan:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="namaFormInput" placeholder="Ex. L300" wire:model="nama">
                            @error('nama') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                    
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label for="nameFormInput"
                                class="block text-gray-700 text-sm font-bold mb-2">Jenis Kendaraan:</label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_ownerFormInput" wire:model="jenis_kendaraan">
                                <option hidden>Pilih disini ----</option>
                                <option>Angkutan Barang</option>
                                <option>Angkutan Orang</option>
                            </select>
                            @error('jenis_kendaraan') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                    
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label for="nameFormInput"
                                class="block text-gray-700 text-sm font-bold mb-2">Jenis Kepemilikan:</label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_ownerFormInput" wire:model="jenis_owner">
                                <option hidden>Pilih disini ----</option>
                                <option>Milik Sendiri</option>
                                <option>Sewa</option>
                            </select>
                            @error('jenis_owner') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                    
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label for="nameFormInput"
                                class="block text-gray-700 text-sm font-bold mb-2">Jenis BBM:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="jenis_bbmFormInput" placeholder="Ex. Solar" wire:model="jenis_bbm">
                            @error('jenis_bbm') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                    
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>