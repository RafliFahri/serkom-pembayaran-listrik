@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-6 font-bold">
            Detail Penggunaan {{$pelanggan->nama_pelanggan}}
        </span>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Bulan
                </th>
                <th scope="col" class="px-6 py-3">
                    Tahun
                </th>
                <th scope="col" class="px-6 py-3">
                    Meter Awal
                </th>
                <th scope="col" class="px-6 py-3">
                    Meter Akhir
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Penggunaan
                </th>
            </tr>
            </thead>
            <tbody>
            @if(count($penggunaan) > 0)
                @foreach($penggunaan as $val)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4">
                            <div class="text-base font-normal">{{date('F', mktime(0,0,0,$val->bulan))}}</div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->tahun}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->meter_awal}} kWh</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->meter_akhir}} kWh</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{abs($val->meter_akhir - $val->meter_awal)}} kWh</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4">
                                <a href="{{route('admin.detail_penggunaan.edit', ['detail_penggunaan' => $val])}}" type="button"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <form action="{{route('admin.detail_penggunaan.destroy', ['detail_penggunaan' => $val])}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="px-6 py-4">
                        <div class="text-base font-normal">Data Tidak Tersedia</div>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
