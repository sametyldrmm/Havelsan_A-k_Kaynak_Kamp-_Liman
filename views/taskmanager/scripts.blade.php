<script>
    function getTaskManager() {
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        request("{{API('process_list')}}", data, function(response){
            Swal.close();
            $("#process_list").html(response).find("table").dataTable(dataTablePresets("normal"));
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });
    }

    function getFileLocation(node) {
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        data.append("pid", $(node).find("#pid").html())
        request("{{API('get_file_location')}}", data, function(response){
            response = JSON.parse(response)
            $("#fileLocation").modal("show");
            $("#fileLocation").find(".modal-body").html(response.message)
            Swal.close();
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });
    }

    function killPid(node) {
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        data.append("pid", $(node).find("#pid").html())
        request("{{API('kill_pid')}}", data, function(response){
            response = JSON.parse(response)
            Swal.close();

            showSwal(response.message, "success", 2500);
            getTaskManager();
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });
    }

    function getServiceStatus(node) {
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        data.append("service", $(node).find("#service").html())
        request("{{API('get_service_status')}}", data, function(response){
            response = JSON.parse(response)
            $("#serviceStatus").modal("show");
            $("#serviceStatus").find(".service").html(response.message)
            Swal.close();
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });
    }
</script>