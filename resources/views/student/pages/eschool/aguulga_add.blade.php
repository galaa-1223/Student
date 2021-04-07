@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <?php 
    $link = Str::random(15);
    ?>
    <h2 class="intro-y text-lg font-medium mt-10">{{ $fond->hicheel }}</h2>
    <span class="intro-y">{{ $fond->angi }} {{ $fond->course }}{{ $fond->buleg }}</span>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Aguulga Layout -->
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="box">
                <!-- BEGIN: Input -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">{{ $buleg->ner }}</h2>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                        <form id="aguulga-save-form" class="validate-form-student" action="{{ route('student-eschool-aguulga-save', [$fond->slug, $buleg->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="link" value="{{ $link }}" />
                            <div class="input-form">
                                <label for="regular-form-1" class="form-label">Агуулгын нэр</label>
                                <input id="regular-form-1" name="ner" type="text" class="form-control" placeholder="Нэр">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Тайлбар </label>
                                <textarea id="validation-form-6" class="form-control" name="tailbar" placeholder="Тайбар..."></textarea>
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Файлын төрөл</label>
                                <div class="sm:grid grid-cols-3 gap-2">
                                    <div class="input-group">
                                        <select class="form-select mt-2 sm:mr-2 col-span-6" name="filetype" id="aguulga_file_type">
                                            <option value="1">Файлууд хуулахаар</option>
                                            <option value="2">Embed код оруулахаар</option>
                                        </select>   
                                    </div>
                                    
                                </div>
                                                    
                            </div>
                            <div class="input-form mt-5 aguulga_embed hidden">
                                <label class="form-label w-full flex flex-col sm:flex-row"> Embed код</label>
                                <textarea id="validation-form-6" style="height:200px" class="form-control" name="embed" placeholder="Код..."></textarea>
                            </div>
                            </form>
                            <div class="input-form mt-5 aguulga_file">
                                <label class="form-label w-full flex flex-col sm:flex-row"> Файлууд</label>
                                <form action="{{ route('student-eschool-aguulga-uploads', [$fond->slug, $buleg->id]) }}" class="dropzone">
                                @csrf
                                    <input type="hidden" name="link2" value="{{ $link }}" />
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                    <div class="dz-message" data-dz-message>
                                        <div class="text-lg font-medium">Файлуудаа энд зөөх эсвэл дарж байршуулна уу.</div>
                                        <div class="text-gray-600">Word, Excel, Powerpoint, PDF файлууд JPG, GIF зургийн файлууд хуулна.</div>
                                        <div class="text-gray-600">12 ширхэг файл 250bm хэмжээтэй байх ёстой</div>
                                    </div>
                                </form>
                            </div>
                            <button id="aguulga-save-btn" class="btn btn-primary mt-5">Хадгалах</button>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- END: Input -->
            </div>
        </div>
        <!-- END: Aguulga Layout -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection