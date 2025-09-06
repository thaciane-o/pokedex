@props([
    'name' => 'file',
    'url' => '',
    'shape' => 'rect',
    'removeUrl' => '',
    'multiple' => false
])

@push('styles')
<style>
    .dropzone {
        width: 350px;
        min-height: 140px;
        background-color: #f1f1f1;
        border: 2px dashed #6c757d;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 15px;
        text-align: center;
        transition: 0.3s;
        cursor: pointer;
    }
    .dropzone.dragover {
        border-color: #0d6efd;
        background-color: #e9f3ff;
    }
    .arquivo {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        border-radius: 8px;
        padding: 10px 12px;
        margin: 6px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .arquivo .info {
        text-align: left;
        font-size: 14px;
    }
</style>
@endpush

<div>
    <div class="dropzone" id="dropzone">
        <p id="mensagem" class="mensagem text-muted mb-2">
            <i class="ti ti-upload"></i> Arraste e solte um arquivo aqui ou clique
        </p>
        <div id="fileList" class="w-100 mt-2"></div>
    </div>
    @if ($multiple)
        <input type="file" id="fileInput" multiple hidden>

    @else
        <input type="file" id="fileInput"  hidden>

    @endif
</div>

@push('scripts')
<script>
$(document).ready(function(){
    let dropzone = $("#dropzone");
    let fileInput = $("#fileInput");
    let fileList = $("#fileList");
    let mensagem = $("#mensagem");
    let multiple = "{{$multiple}}"
    // CSRF Token Laravel
    let csrf = $('meta[name="csrf-token"]').attr('content');

    // Clique abre seletor de arquivo
    dropzone.on("click", function(){
        fileInput.trigger("click");
    });

    // Drag over
    dropzone.on("dragover", function(e){
        e.preventDefault();
        dropzone.addClass("dragover");
    });

    // Drag leave
    dropzone.on("dragleave", function(e){
        e.preventDefault();
        dropzone.removeClass("dragover");
    });

    // Drop
    dropzone.on("drop", function(e){
        e.preventDefault();
        dropzone.removeClass("dragover");
        let files = e.originalEvent.dataTransfer.files;
        handleFiles(files);
    });

    // Seleção manual
    fileInput.on("change", function(e){
        mensagem.hide();
        handleFiles(e.target.files);
    });

    // Função para mostrar e enviar arquivos
    function handleFiles(files) {

        for (let i = 0; i < files.length; i++) {
            let file = files[i];



            // 🔵 Upload via AJAX
            let formData = new FormData();
            formData.append('_token', csrf);
            formData.append('file', file); // File é o objeto que você mostrou no console
            let path;
            $.ajax({
                url: "{{ $url }}",
                type: "POST", // use type, não method (jQuery usa type internamente)
                data: formData,
                cache: false,
                contentType: false, // obrigatoriamente false
                processData: false, // obrigatoriamente false
                success: function(response){
                    path = response.path;

                    // Cria item visual
                    let fileItem = $(`
                        <div class="arquivo d-flex justify-content-between align-items-center">
                            <div class="info">
                                <strong>${file.name}</strong><br>
                                <small class="text-muted">${(file.size/1024).toFixed(1)} KB</small>
                            </div>
                            <input type="hidden" id="fileInput" name="fileInput[]" value="${path}">

                            <div>
                                <button class="btn btn-sm btn-outline-danger btn-remove me-1">
                                    <i class="ti ti-x"></i>
                                </button>
                            </div>
                        </div>
                    `);
                // 🔴 Remover arquivo
                fileItem.find(".btn-remove").on("click", function(e) {
                    e.stopPropagation();

                    $.ajax({
                        url: "{{ $removeUrl }}",
                        method: "POST",
                        data: {
                            _token: csrf,
                            path: path
                        },
                        success: function(res){
                            console.log("Removido:", res);
                        },
                        error: function(err){
                            console.error("Erro ao remover:", err);
                        }
                    });

                    fileItem.remove();
                    if (fileList.children().length === 0) {
                        mensagem.show();
                    }
                });

                fileList.append(fileItem);

                },
                error: function(err){
                    console.error("Erro ao enviar:", err.responseText);
                }
            });

        }
    }
});
</script>
@endpush
