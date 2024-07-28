@extends('customer.index')
@section('custcontent')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
            <span class="text-2xl mb-4 font-bold">Penggunaan Listrik</span>
        </div>
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
            @foreach($penggunaan as $val)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="text-base font-normal">{{date('F', mktime(0,0,0,$val->bulan))}}</div>
                    </th>
                    <th class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->tahun}}</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->meter_awal}}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->meter_akhir}}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{abs($val->meter_akhir - $val->meter_awal)}} kWh</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
