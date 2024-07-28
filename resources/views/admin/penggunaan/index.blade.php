@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-4 font-bold">Data Penggunaan Listrik</span>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama Pelanggan
                </th>
                <th scope="col" class="px-6 py-3">
                    Nomor kWh
                </th>
                <th scope="col" class="px-6 py-3">
                    Alamat
                </th>
            </tr>
            </thead>
            <tbody>
            @if($pelanggan)
                @foreach($pelanggan as $val)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base font-normal">{{$val->nama_pelanggan}}</div>
                        </th>
                        <th class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->nomor_kwh}}</div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->alamat}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4">
                                <a href="{{route('admin.penggunaan.create', ['pelanggan' => $val])}}" type="button" class="font-medium text-purple-600 dark:text-purple-500 hover:underline">Tambah Penggunaan</a>
                                <a href="{{route('admin.penggunaan.show', ['pelanggan' => $val])}}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail Penggunaan</a>
                                <a href="{{route('admin.tagihan.show', ['pelanggan' => $val])}}" type="button" class="font-medium text-green-600 dark:text-green-500 hover:underline">Detail Tagihan</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="text-base font-normal">Data Tidak tersedia</div>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
