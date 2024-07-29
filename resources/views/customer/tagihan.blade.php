@extends('customer.index')
@section('custcontent')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
            <span class="text-2xl mb-4 font-bold">Tagihan Penggunaan Listrik</span>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Bulan Tagihan
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Meter
                </th>
                <th scope="col" class="px-6 py-3">
                    Biaya Admin
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Bayar
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
            </thead>
            <tbody>
            @if(!$tagihan)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="5" class="text-center py-4">Data Belum Tersedia</td>
                </tr>
            @else
                @foreach($tagihan as $val)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base font-normal">{{date('F', mktime(0,0,0,$val->bulan_bayar))}}</div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->jumlah_meter}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->biaya_admin}}</div>
                        </td>
                        <th class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->total_bayar}}</div>
                        </th>
                        <td class="px-6 py-4">
                            @if($val->status === null)
                                <span class="focus:outline-none text-white bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Belum Lunas
                                </span>
                            @elseif($val->status === 0)
                                <span class="focus:outline-none text-white bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-900">
                                    Sedang dikonfirmasi
                                </span>
                            @else
                                <span class="focus:outline-none text-white bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                    Lunas
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($val->status === null)
                            <div class="flex gap-4">
                                <form action="{{route('customer.tagihan.proses', ['tagihan' => $val->id_tagihan])}}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Proses
                                    </button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
