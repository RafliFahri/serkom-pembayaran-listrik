@extends('.admin.app')
@section('content')
    <form action="{{route('admin.level.update', ['level' => $level])}}" method="POST"
          class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        @csrf
        @method('PATCH')
        <!-- Modal header -->
        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Level
            </h3>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Level</label>
                    <input type="text" name="nama_level" id="text"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{$level->nama_level}}" required="">
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div
            class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save
            </button>
        </div>
    </form>
@endsection
