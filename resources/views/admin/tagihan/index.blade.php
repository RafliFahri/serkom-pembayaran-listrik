@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-6 font-bold">Data Tagihan {{$pelanggan->nama_pelanggan}}</span>
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
                    Meter Penggunaan
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
            </thead>
            <tbody>
            @if(count($tagihan) > 0)
                @foreach($tagihan as $val)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4">
                            <div class="text-base font-normal">{{date('F', mktime(0,0,0,$val->bulan))}}</div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->tahun}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->jumlah_meter}} kWh</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($val->status === null)
                                <span class="focus:outline-none text-white bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Belum Lunas
                                </span>
                            @elseif($val->status === 0)
                                <span class="focus:outline-none text-white bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-900">
                                    Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="focus:outline-none text-white bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                    Lunas
                                </span>
                            @endif
                        </td>
                        @if($val->status === null)
                            <td class="px-4 py-4">
                                <div class="flex">
                                    <form action="{{route('admin.detail_tagihan.destroy', ['detail_tagihan' => $val])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
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
