@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Тохиргоо талбар</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ config('settings.site_name') }}" class="rounded-full" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/students/thumbs/'.$user->image)}}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ Str::substr($student->ovog, 0, 1) }}. {{ $student->ner }}</div>
                        <div class="text-gray-600">{{ $student->code }}</div>
                    </div>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="{{route('student-settings')}}">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i> Хувийн мэдээлэл
                    </a>
                    <a class="flex items-center mt-5" href="{{route('student-settings-password')}}">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Нууц үг солих
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Хувийн мэдээлэл -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Хувийн мэдээлэл</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4">
                        <form class="validate-form" action="{{ route('student-settings-changepicture', $student->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img id="preview-image" class="rounded-md" alt="{{ config('settings.site_name') }}" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/students/thumbs/'.$user->image)}}">
                                    <div id="remove-image" title="Зургийг устгах уу?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full cursor-pointer text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 hidden">
                                        <i data-feather="x" class="w-4 h-4" style="padding-left: 4px"></i>
                                    </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="btn w-full bg-theme-7 text-white cursor-pointer">Зураг оруулах</button>
                                    <input type="file" name="image" id="image" accept="image/png, image/jpeg" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="submit" id="save_image" class="btn w-full bg-theme-1 text-white mt-3 cursor-pointer hidden">Хадгалах</button>
                                    <button type="button" onclick="window.location.href='{{ route('student-settings') }}'" id="cancel_image" class="btn w-full bg-theme-8 text-white mt-3 cursor-pointer hidden">Болих</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div>
                                <label>Оюутны нэр:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->ner }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Оюутны код:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->code }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Эцэг/эхийн нэр:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->ovog }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Ургийн овог:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->urag }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Төрсөн:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->tursun }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Регистер:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->register }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Утас:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->phone }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Имэйл хаяг:</label>
                                <input type="text" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" value="{{ $student->email }}" disabled />
                            </div>
                            <div class="mt-3">
                                <label>Гэрийн хаяг:</label>
                                <textarea id="update-profile-form-5" class="form-control w-full border bg-gray-100 cursor-not-allowed mt-2" disabled>{{ $student->address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Хувийн мэдээлэл -->
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection