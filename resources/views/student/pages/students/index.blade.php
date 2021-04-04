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
        @if(!count($students))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
            </div>
        @else
        <table id="table" class="table table-report mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Багш нэр</th>
                    <th class="whitespace-nowrap text-center">Төрсөн огноо</th>
                    <th class="whitespace-nowrap">Утас</th>
                    <th class="whitespace-nowrap">Имэйл</th>
                    <th class="whitespace-nowrap">Зураг</th>
                </tr>
            </thead>
            <tbody>
                    <?php $i = 1;?>
                    @foreach($students as $student)
                    <tr class="intro-x">
                        <td class="w-10">
                            <div class="flex">
                                {{ $i }}
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ Str::substr($student->ovog, 0, 1) }}. {{ $student->ner }}</a>
                        </td>
                        <td class="text-center">{{ $student->tursun }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-center">
                            <div class="w-10 h-10 image-fit zoom-in">
                                <img alt="{{ Str::substr($student->ovog, 0, 1) }}. {{ $student->ner }}" class="tooltip rounded-full" src="{{ ($student->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/students/thumbs/'.$student->image)}}" title="{{ Str::substr($student->ovog, 0, 1) }}. {{ $student->ner }}">
                            </div>
                        </td>
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