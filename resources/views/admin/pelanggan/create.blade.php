@extends('.admin.app')
@section('content')
    <div class="mb-5">
        <span class="text-2xl font-bold">Tambah Data Pelanggan</span>
    </div>
    <form method="POST" action="{{route('admin.pelanggan.store')}}">
        @csrf
        <div class="mb-5">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" value="{{old('username')}}" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" value="{{old('password')}}" required />
        </div>
        <div class="mb-5">
            <label for="nomorkwh" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Kwh</label>
            <input type="number" name="nomor_kwh" id="nomorkwh" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123456789" value="{{old('nomor_kwh')}}" required />
        </div>
        <div class="mb-5">
            <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama" value="{{old('nama_pelanggan')}}" required />
        </div>
        <div class="mb-5">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat" value="{{old('alamat')}}" required />
        </div>
        <div class="mb-5">
            <label for="daya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daya</label>
            <select name="daya" id="daya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="" selected>Pilih Daya</option>
                @foreach($tarif as $val)
                    <option value="{{$val->id_tarif}}" {{$val->id_tarif == old('daya')?'selected':''}}>{{$val->daya}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
@endsection
