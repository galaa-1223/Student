@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $fond->hicheel }}</h2>
    <span class="intro-y">{{ $fond->angi }} {{ $fond->course }}{{ $fond->buleg }}</span>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            @if(count($aguulgas))
                @foreach($aguulgas as $aguulga)
                <div class="intro-y grid grid-cols-12 gap-6 mt-5">
                    <!-- BEGIN: Blog Layout -->
                    <div class="intro-y blog col-span-12 md:col-span-8 box">
                        <div class="blog__preview image-fit" style="background: url({{ asset('dist/images/unnamed.jpg')}}); background-size: cover;">
                            <div class="absolute w-full flex items-center px-5 pt-6 z-10">
                                <div class="ml-3 text-white mr-auto">
                                    <a href="" class="font-medium">{{ Str::substr($student->ner, 0, 1)  }}. {{ $student->ner }}</a> 
                                    <div class="text-xs mt-0.5">{{ $buleg->created_at }}</div>
                                </div>
                                <div class="dropdown ml-3">
                                    <a href="#" class="blog__action dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full" aria-expanded="false"> <i data-feather="more-vertical" class="w-4 h-4 text-white"></i> </a>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Засах </a>
                                            <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Устгах </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> 
                                <span class="blog__category px-2 py-1 rounded">{{ $buleg->ner }}</span> 
                                <a href="" class="block font-medium text-xl mt-3">{{ $aguulga->ner }}</a> 
                            </div>
                        </div>
                        @if($aguulga->embed != null)
                        <div class="embed-responsive aspect-ratio-4/3">
                        <!-- <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{url('http://gef.mn/uploads/taniltsuulgaYLM.pptx')}}" frameborder="0"></iframe> -->
                            {!! $aguulga->embed !!}
                        </div>
                        @endif
                        @if(count($files))
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Файлууд
                                </h2>
                            </div>
                            <div id="responsive-slider" class="p-5">
                                <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
                                    @foreach($files as $file)
                                        @if($aguulga->link == $file->link)
                                    <div class="intro-y col-span-3">
                                        <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                            <div class="absolute left-0 top-0 mt-3 ml-3">
                                                <input class="form-check-input border border-gray-500" type="checkbox">
                                            </div>
                                                <?php
                                                $file_parts = pathinfo($file->name);
                                                $cool_extensions = Array('jpeg', 'jpg', 'png', 'gif');
                                                if (in_array($file_parts['extension'], $cool_extensions)){
                                                ?>
                                                <a href="#" class="w-3/5 file__icon file__icon--image mx-auto">
                                                    <div class="file__icon--image__preview image-fit">
                                                        <img alt="{{ $file->name }}" data-action="zoom" src="/uploads/aguulga/{{ $aguulga->slug }}/{{ $file->name }}">
                                                    </div>
                                                </a>
                                                <?php
                                                }else{
                                                ?>
                                                <a href="#" class="w-3/5 file__icon file__icon--file mx-auto">
                                                    <div class="file__icon__file-name"><?=$file_parts['extension'];?></div>
                                                </a>
                                                <?php
                                                }
                                                ?>
                                            <a href="" class="block font-medium mt-4 text-center truncate">{{ $file_parts['filename'] }}</a>
                                            <div class="text-gray-600 text-xs text-center mt-0.5">size</div>
                                            <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                                                    <i data-feather="more-vertical" class="w-5 h-5 text-gray-600"></i>
                                                </a>
                                                <div class="dropdown-menu w-40">
                                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                                            <i data-feather="download" class="w-4 h-4 mr-2"></i> Татаж авах
                                                        </a>
                                                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                                            <i data-feather="trash" class="w-4 h-4 mr-2"></i> Устгах
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach
                                </div>

                                
                            </div>
                        </div>
                        @endif
                        <div class="p-5 text-gray-700 dark:text-gray-600">{{ $aguulga->tailbar }}</div>
                        <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5">
                            
                            <a href="" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 ml-auto tooltip" title="Даалгавар"> <i data-feather="airplay" class="w-3 h-3"></i> </a>
                            <a href="" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-2 tooltip" title="Татаж авах"> <i data-feather="share" class="w-3 h-3"></i> </a>
                        </div>
                    </div>
                </div>
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