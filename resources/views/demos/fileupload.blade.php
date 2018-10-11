<input id="sd" type="file" name="image" uploaderOption="{swf:'{{ admin_assets('uploadify/scripts/uploadify.swf') }}',uploader:'{{ route('RuLong.storages.upload', ['name'=>'fileup']) }}', formData:{_token: '{{ csrf_token() }}'},fileObjName:'fileup',buttonText:'请选择文件',fileSizeLimit:'20MB',auto:true,multi:false,onUploadSuccess:uploadifySuccess }"/>
<script type="text/javascript">
    function uploadifySuccess(file, data, response) {
        console.log(file);
        console.log(data);
        console.log(response);
    }
</script>
