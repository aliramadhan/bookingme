<div>
	<div class="py-12">

		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="mx-3 relative overflow-x-auto shadow-md sm:rounded-lg">
			    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
			            <tr>
			                <th scope="col" class="px-6 py-3">
			                    No.
			                </th>
			                <th scope="col" class="px-6 py-3">
			                    Log
			                </th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($logs as $log)
			            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
			                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
			                    {{$loop->iteration}}
			                </th>
			                <td class="px-6 py-4">
			                    {{$log->keterangan}}
			                </td>
			            </tr>
			            @endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>