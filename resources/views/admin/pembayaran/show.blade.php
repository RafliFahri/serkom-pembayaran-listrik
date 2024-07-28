@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-6 font-bold">Data Pembayaran</span>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nomor kWh
                </th>
                <th scope="col" class="px-6 py-3">
                    Pelanggan
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
            @if(count($pembayaran) > 0)
                @foreach($pembayaran as $val)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->nomor_kwh}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->nama_pelanggan}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-base font-normal">{{$val->total_bayar}}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($val->status === 0)
                                <span class="focus:outline-none text-white bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-900">
                                    Menunggu Konfirmasi
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4">
                                <form action="{{route('admin.pembayaran.confirm', ['pembayaran' => $val])}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit"
                                            class="font-medium text-yellow-600 dark:yellow-red-500 hover:underline">Konfirmasi
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
