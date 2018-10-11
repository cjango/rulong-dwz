<div class="pageContent">
    <form method="post" action="{{ route('Admin.test.store') }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="60">
            <input id="testFileInput" type="file" name="image"
                uploaderOption="{
                    swf:'{{ admin_assets('uploadify/scripts/uploadify.swf') }}',
                    uploader:'{{ route('RuLong.storages.upload', ['name'=>'fileup']) }}',
                    formData:{_token: '{{ csrf_token() }}'},
                    fileObjName: 'fileup',
                    buttonText:'请选择文件',
                    fileSizeLimit:'20MB',
                    auto:true,
                    multi:false,
                    onUploadSuccess:'uploadifySuccess',
                    onQueueComplete:'uploadifyQueueComplete'
                }"
            />
            <div class="divider"></div>

        </div>
        @csrf
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
