<div class="row">
    <div class="col-md-12">
        <div id="process_list">
            Yükleniyor...
        </div>
    </div>
</div>

@component("modal-component", [
    "title" => "Dosya Konumu",
    "id" => "fileLocation",
    "notSized" => "true"    
])
@endcomponent

@component("modal-component", [
    "title" => "Servis Durumu",
    "id" => "serviceStatus",
])
    <pre
        class="service"
        style="
            border-radius: 5px;
            background: black;
            color: limegreen;
            font-size: medium;
            font-family: Consolas, Monaco, Lucida Console, monospace;
            overflow: auto;
        "
    >

    </pre>
@endcomponent

@include("taskmanager.scripts")