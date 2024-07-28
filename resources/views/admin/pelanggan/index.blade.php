@extends('.admin.app')
@section('content')
    <span class="text-2xl mb-4 font-bold">Data Pelanggan</span>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
            <div>
                <a href="{{route('admin.pelanggan.create')}}"
                   class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                   type="button">
                    Tambah
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Password
                </th>
                <th scope="col" class="px-6 py-3">
                    Nomor Kwh
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Pelanggan
                </th>
                <th scope="col" class="px-6 py-3">
                    Daya
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($pelanggan as $val)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="text-base font-normal">{{$val->username}}</div>
                    </th>
                    <th class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->password}}</div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->nomor_kwh}}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->nama_pelanggan}}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-base font-normal">{{$val->tarif->daya}}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-4">
                            <a href="{{route('admin.pelanggan.edit', ['pelanggan' => $val])}}" type="button"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{route('admin.pelanggan.destroy', ['pelanggan' => $val])}}" method="post">
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
            </tbody>
        </table>
    </div>
@endsection
