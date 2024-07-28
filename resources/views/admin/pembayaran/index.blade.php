@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-4 font-bold">Data Riwayat Pembayaran</span>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Tanggal Pembayaran
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Pelanggan
                </th>
                <th scope="col" class="px-6 py-3">
                    Nomor kWh
                </th>
                <th scope="col" class="px-6 py-3">
                    Bulan Bayar
                </th>
                <th scope="col" class="px-6 py-3">
                    Grand Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Pemverifikasi
                </th>
            </tr>
            </thead>
            <tbody>
            @if(count($pembayaran) > 0)

            @foreach($pembayaran as $val)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->tanggal_pembayaran}}</div>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="text-base font-normal">{{$val->nama_pelanggan}}</div>
                    </th>
                    <th class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->nomor_kwh}}</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{date('F', mktime(0,0,0,$val->bulan_bayar)).' '.$val->tahun}}</div>
                    </td>
                    <th class="px-6 py-4">
                        <div class="text-base font-normal">Rp. {{$val->total_bayar}}</div>
                    </th>
                    <td class="px-6 py-4">
                        @if($val->status === 1)
                            <span class="focus:outline-none text-white bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                Lunas
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->nama_admin}}</div>
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
