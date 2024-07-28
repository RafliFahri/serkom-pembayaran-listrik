@extends('.admin.app')
@section('content')
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <span class="text-2xl mb-4 font-bold">Update Data Penggunaan {{$penggunaan->pelanggan->nama_pelanggan}}</span>
    </div>
    <form method="POST" action="{{route('admin.detail_penggunaan.update', ['detail_penggunaan' => $penggunaan])}}">
        @csrf
        @method('PATCH')
        <div class="mb-5">
            <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan</label>
            <select name="bulan" id="bulan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="1" {{$penggunaan->bulan==1?'selected':''}}>Januari</option>
                <option value="2" {{$penggunaan->bulan==2?'selected':''}}>Februari</option>
                <option value="3" {{$penggunaan->bulan==3?'selected':''}}>Maret</option>
                <option value="4" {{$penggunaan->bulan==4?'selected':''}}>April</option>
                <option value="5" {{$penggunaan->bulan==5?'selected':''}}>Mei</option>
                <option value="6" {{$penggunaan->bulan==6?'selected':''}}>Juni</option>
                <option value="7" {{$penggunaan->bulan==7?'selected':''}}>Juli</option>
                <option value="8" {{$penggunaan->bulan==8?'selected':''}}>Agustus</option>
                <option value="9" {{$penggunaan->bulan==9?'selected':''}}>September</option>
                <option value="10" {{$penggunaan->bulan==10?'selected':''}}>Oktober</option>
                <option value="11" {{$penggunaan->bulan==11?'selected':''}}>November</option>
                <option value="12" {{$penggunaan->bulan==12?'selected':''}}>Desember</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tahun" value="{{$penggunaan->tahun}}" required />
        </div>
        <div class="mb-5">
            <label for="meterawal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meter Awal</label>
            <input type="number" name="meter_awal" id="meterawal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Meter Awal" value="{{$penggunaan->meter_awal}}" required />
        </div>
        <div class="mb-5">
            <label for="meterakhir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meter Akhir</label>
            <input type="number" name="meter_akhir" id="meterakhir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Meter Akhir" value="{{$penggunaan->meter_akhir}}" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
@endsection

