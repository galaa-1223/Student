@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Хичээл ордог багш нар</h2>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y p-5 mt-5">
        @if(!count($teachers))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
            </div>
        @else
        <table id="table" class="table table-report mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Багш нэр</th>
                    <th class="whitespace-nowrap text-center">Тэнхим</th>
                    <th class="whitespace-nowrap">Заах хичээл</th>
                    <th class="whitespace-nowrap">Зураг</th>
                    <th class="whitespace-nowrap text-center">Цаг</th>
                </tr>
            </thead>
            <tbody>
                    <?php $i = 1;?>
                    @foreach($teachers as $teacher)
                    <tr class="intro-x">
                        <td class="w-10">
                            <div class="flex">
                                {{ $i }}
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}</a>
                            <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $teacher->mergejil }}</div>
                        </td>
                        <td class="text-center">{{ $teacher->tenhim }}</td>
                        <td>{{ $teacher->hicheel }}</td>
                        <td class="text-center">
                            <div class="w-10 h-10 image-fit zoom-in">
                                <img alt="{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}" class="tooltip rounded-full" src="{{ ($teacher->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/teachers/thumbs/'.$teacher->image)}}" title="{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}">
                            </div>
                        </td>
                        <td class="text-center">{{ $teacher->tsag }}</td>
                    </tr>
                    <?php $i++;?>
                    @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <!-- END: HTML Table Data -->
@endsection

@section('style')
@endsection

@section('script')
@endsection