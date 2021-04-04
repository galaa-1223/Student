@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">Анги талбар</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 xl:col-span-8 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Ангийн нэр</th>
                        <th class="text-center whitespace-nowrap">Оюутны тоо</th>
                        <th class="text-center whitespace-nowrap">Төлөв</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i = 1;?>
                        @foreach($angiud as $angi)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    {{ $i }}
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $angi->ner }} {{ $angi->course }}{{ $angi->buleg }}</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ Str::substr($angi->ovog, 0, 1) }}. {{ $angi->bagsh }}</div>
                            </td>
                            <td class="text-center">0</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-theme-9">
                                    
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection