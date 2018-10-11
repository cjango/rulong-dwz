<div class="pageContent">
    <form method="post" action="{{ route('RuLong.storages.upload', ['name'=>'avatar']) }}" class="pageForm required-validate" onsubmit="return iframeCallback(this)" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="58">
            <div class="unit">
                <div class="upload-wrap">
                    <input type="file" name="avatar" accept="image/*">
                </div>
            </div>
            <div class="unit">
                @{{ route('RuLong.storages.upload', ['name'=>'avatar']) }} <br>
                name 与表单 name 相同即可
            </div>
        </div>
        @csrf
        <div class="formBar">
            <ul>
            <li><div class="buttonActive"><div class="buttonContent"><button type="submit">立即上传</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
