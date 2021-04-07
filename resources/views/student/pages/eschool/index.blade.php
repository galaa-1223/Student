@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Notification -->
                <div class="col-span-12 mt-6 -mb-6 intro-y">
                    <h2 class="intro-y text-lg font-medium mt-10">Eschool цахим хичээлийн талбар</h2>
                </div>
                <!-- BEGIN: Notification -->
                @if($fonds)
                    @foreach($fonds as $fond)
                <!-- BEGIN: Visitors -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-3 mt-2">
                    <div class="report-box-2 intro-y mt-5">
                        <div class="box p-5" >
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-theme-9 rounded">
                                    <a href="#" class="tooltip" title="{{ $fond->angi }} {{ $fond->course }}{{ $fond->buleg }}" />{{ $fond->tovch }}</a> 
                                </span>
                                <div class="dropdown ml-auto">
                                    <a class="dropdown-toggle w-5 h-5 block -mr-2" href="javascript:;" aria-expanded="false"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Санал хүсэлт </a>
                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="settings" class="w-4 h-4 mr-2"></i> Тохиргоо </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xl font-medium mt-2">{{ $fond->hicheel }}</div>
                            <div class="border-b border-gray-200 flex pb-2 mt-4">
                                <div class="text-gray-600 dark:text-gray-600 text-xs">Оюутны тоо</div>
                                <div class="text-theme-9 flex text-xs font-medium ml-auto"> 0 </div>
                            </div>
                            <div class="text-gray-600 dark:text-gray-600 text-xs border-b border-gray-200 flex mb-2 pb-2 mt-4">
                                <div>Статистик</div>
                                <div class="ml-auto">Too</div>
                            </div>
                            <div class="flex">
                                <div>Агуулга</div>
                                <div class="ml-auto">0</div>
                            </div>
                            <div class="flex mt-1.5">
                                <div>Даалгавар</div>
                                <div class="ml-auto">0</div>
                            </div>
                            <div class="flex mt-1.5">
                                <div>Нэвтэрсэн</div>
                                <div class="ml-auto">0</div>
                            </div>
                            <a href="{{ route('student-eschool-sedevs', $fond->slug) }}" class="btn btn-outline-secondary border-dashed w-full py-1 px-2 mt-4">Хичээл эхлүүлэх</a>
                        </div>
                    </div>
                </div>
                <!-- END: Visitors -->
                    @endforeach
                @endif
                
            </div>
        </div>
        <div class="col-span-12 xxl:col-span-3">
            <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: Онлайнд байгаа оюутнууд -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Онлайнд байгаа оюутнууд
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-x">
                                <div class="intro-y col-span-12 xl:col-span-8 overflow-auto lg:overflow-visible">
                                    <div class="alert alert-warning alert-dismissible show flex items-center mb-2" role="alert"> 
                                        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Онлайнд оюутан алга байна! 
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button> 
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- END: Онлайнд байгаа оюутнууд -->
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection