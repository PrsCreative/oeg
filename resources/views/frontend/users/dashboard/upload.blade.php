@extends('frontend.users.dashboard_template')

<!-- Header CSS  -->
<link rel="stylesheet" href="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/user-upload.css') }}">
<!-- End Header CSS -->

@section('content')

    <div class="upload-content">
        {{--Application Status--}}
        <div class="upload-block">
            <h4>Application Document</h4>
            <p class="font-grey txt-remark upload-tab-left">Allow file type: pdf, jpg, png</p>
            <p class="font-grey txt-remark upload-tab-left">กรณีผู้สมัครอัพโหลดผิดไฟล์ สามารถอัพโหลดซ้ำที่เดิมได้เลย</p>

            <form action="{{route('frontend.dashboard.upload.post')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="upload-form-block">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="transcript">Transcript</label>
                        </div>
                        <div class="col-md-9">

                            {{--not show if file approved    --}}
                            @if( empty($transcript->path) || $transcript->status_file != 'approved' )
                                <input type="text" class="form-control input-file uploadInput" id="transcript" name="transcript" placeholder="Upload File" readonly>
                                <button class="upload-file">Upload</button>
                                <input type="file" name="file_upload[]" class="fileUpload" id="file_upload" value="" accept="image/jpg, image/png, application/pdf" style="display: none" multiple>

                                <input type="hidden" name="type" value="transcript">
                            @endif

                            @if(!empty($transcript->path) && session()->has('transcript_success'))
                                <div class="text-success font-size-detail inline-block padding-top-small">
                                    {{ session()->get('transcript_success') }}
                                </div>
                            @elseif(!empty($transcript->path) && $transcript->status_file == 'approved' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File was approved by admin</div>
                            @elseif(!empty($transcript->path) && $transcript->status_file == 'uploaded' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File has uploaded</div>
                            @elseif(!empty($transcript->path) && $transcript->status_file == 'reject' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File was rejected by admin ,Please upload this file again.</div>
                            @else
                                <div class="padding-top-small"></div>
                            @endif

                            {{--not show if file approved    --}}
{{--                            <input type="hidden" class="file-location" value="{{ empty($transcript->path) ? '' : $transcript->path }}" />--}}
                            @if(!empty($transcript->path))
                                @foreach($transcript->path as $path)
                                    @if($loop->iteration == 1)
                                        <a data-fancybox="group" rel="transcript" href="{{ asset($path) }}"><span class="glyphicon glyphicon-search cursor-pointer font-black"></span></a>
                                    @else
                                        <a data-fancybox="group" rel="transcript" href="{{ asset($path) }}"></a>
                                    @endif
                                @endforeach
                            @else
                                <span class="glyphicon glyphicon-search cursor-pointer display-none"></span>
                            @endif


                            <span class="remove-file-span remove-file cursor-pointer display-none">X</span>


                            {!! '<div class="text-red font-size-detail error">'.(old('type') == 'transcript' ? $errors->first('file_upload') : "").'</div>' !!}

                        </div>
                    </div>
                </div>
            </form>

            <form action="{{route('frontend.dashboard.upload.post')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="upload-form-block">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="national_copy">สำเนาบัตรประชาชน</label>
                        </div>
                        <div class="col-md-9">

                            @if( empty($national_copy->path) || $national_copy->status_file != 'approved' )
                                <input type="text" class="form-control input-file uploadInput" id="national_copy" name="national_copy" placeholder="Upload File" readonly>
                                <button class="upload-file">Upload</button>
                                <input type="file" name="file_upload[]" class="fileUpload" id="file_upload" value="" accept="image/jpg, image/png, application/pdf" style="display: none" multiple>

                                <input type="hidden" name="type" value="national_copy">
                            @endif

                            @if( !empty($national_copy->path) && session()->has('national_copy_success') )
                                <div class="text-success font-size-detail inline-block padding-top-small">
                                    {{ session()->get('national_copy_success') }}
                                </div>
                            @elseif(!empty($national_copy->path) && $national_copy->status_file == 'approved' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File was approved by admin</div>
                            @elseif(!empty($national_copy->path) && $national_copy->status_file == 'uploaded' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File has uploaded</div>
                            @elseif(!empty($national_copy->path) && $national_copy->status_file == 'reject' )
                                <div class="text-warning font-size-detail inline-block padding-top-small">File was rejected by admin ,Please upload this file again.</div>
                            @else
                                <div class="padding-top-small"></div>
                            @endif

{{--                            <input type="hidden" class="file-location" value="{{ empty($national_copy->path) ? '' : $national_copy->path }}" />--}}
                            {{--<span class="glyphicon glyphicon-search cursor-pointer {{ empty($national_copy->path) ? 'display-none' : '' }} "></span>--}}
                            @if(!empty($national_copy->path))
                                @foreach($national_copy->path as $path)
                                    @if($loop->iteration == 1)
                                        <a data-fancybox="group" rel="national_copy" href="{{ asset($path) }}"><span class="glyphicon glyphicon-search cursor-pointer font-black"></span></a>
                                    @else
                                        <a data-fancybox="group" rel="national_copy" href="{{ asset($path) }}"></a>
                                    @endif
                                @endforeach
                            @else
                                <span class="glyphicon glyphicon-search cursor-pointer display-none"></span>
                            @endif


                            <span class="remove-file-span remove-file cursor-pointer display-none">X</span>


                            {!! '<div class="text-red font-size-detail error">'.(old('type') == 'national_copy' ? $errors->first('file_upload') : "").'</div>' !!}

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <p class="font-grey txt-remark upload-tab-left">**หากไฟล์ไม่สามารถอัพโหลดได้ หรือไฟล์มีมากกว่า 1 หน้า สามารถส่งทางอีเมลมาที่ highschool@oeg.co.th ใส่ชื่ออีเมลว่า "เอกสารสมัครสอบของ ชื่อ-นามสกุล"</p>
    </div>

    <script src="{{ asset('js/user-upload.js') }}"></script>
    <script src="{{ asset('backoffice/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endsection
