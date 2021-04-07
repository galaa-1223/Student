@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $fond->hicheel }}</h2>
    <span class="intro-y">{{ $fond->angi }} {{ $fond->course }}{{ $fond->buleg }}</span>
    <div class="grid grid-cols-12 gap-6 mt-5">
        
        @if(count($bulegs))
            @foreach($bulegs as $buleg)
            <!-- BEGIN: Users Layout -->
            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                <div class="box">
                    <div class="flex items-start px-5 pt-5">
                        <div class="w-full flex flex-col lg:flex-row items-center">
                            <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                <a href="#" class="font-medium">{{ $buleg->ner }}</a>
                                <div class="text-gray-600 text-xs mt-0.5">{{ $buleg->created_at }}</div>
                            </div>
                        </div>
                        <div class="absolute right-0 top-0 mr-5 mt-3 dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                                <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                            </a>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                        <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Засах
                                    </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                        <i data-feather="trash" class="w-4 h-4 mr-2"></i> Устгах
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center lg:text-left p-5">
                        <div></div>
                    </div>
                    <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                        <a href="{{ route('student-eschool-sedev', [$fond->slug, $buleg->id]) }}" class="btn bg-theme-1 text-white py-1 px-2 mr-2">Хичээлийг үзэх</a>
                    </div>
                </div>
            </div>
            <!-- END: Users Layout -->  
            @endforeach
        @else
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 xl:col-span-8 overflow-auto lg:overflow-visible">
                <div class="alert alert-warning alert-dismissible show flex items-center mb-2" role="alert"> 
                    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Мэдээлэл ороогүй байна! 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button> 
                </div>
            </div>
            <!-- END: Data List -->
        @endif
        
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection