<?php

return [
    "index" => "HomeController@index",

    // Tasks
    "runTask" => "TaskController@runTask",
    "checkTask" => "TaskController@checkTask",

    // Hostname Settings
    "get_hostname" => "HostnameController@get",
    "set_hostname" => "HostnameController@set",

    // Systeminfo
    "get_system_info" => "SystemInfoController@get",
    "install_lshw" => "SystemInfoController@install",

    // Runscript
    "run_script" => "RunScriptController@run",

    // TaskView
    "example_task" => "TaskViewController@run",

    // Task Manager Controller
    "process_list" => "TaskManagerController@getProcesses",
    "get_file_location" => "TaskManagerController@getFileLocation",
    "kill_pid" => "TaskManagerController@killByPid",
    "get_service_status" => "TaskManagerController@getServiceStatus"
];
