<?php
namespace App\Controllers;

use Liman\Toolkit\Shell\Command;

class TaskManagerController
{
	public function getProcesses()
	{
        // Görev Listesini Çektik
        $processList = Command::runSudo(
            "ps -Ao user,pid,pcpu,stat,unit,pmem,thcount,comm --sort=-pcpu"
        );

        // Görev Listesini \n ile Parçaladık
        $processes = explode("\n", $processList);

        // İlk satırı keselim
        array_splice($processes, 0, 1);

        // Sistemimizdeki Toplam Ram Miktarını Alalım
        $memory = Command::runSudo(
            "grep MemTotal /proc/meminfo | awk '/[0-9]/{print $2}'"
        );

        foreach ($processes as $key => &$process)
        {
            $process = preg_replace('/\s+/', ' ', $process);

            $process = explode(" ", $process);

            // Ram Hesaplama
            if ((float) $process[5] != 0.0) {
                $ram = round((float) $memory * (float) $process[5] * (float)0.00001, 2);
            } else {
                $ram = 0;
            }

            $process = [
                "user" => $process[0],
                "ram" => $ram,
                "pid" => $process[1],
                "cpu" => $process[2],
                "status" => $process[3],
                "service" => $process[4],
                "threads" => $process[6],
                "command" => $process[7]
            ];
        }

        return view("table", [
            "value" => $processes,
            "display" => [
                "command",
                "pid",
                "status",
                "user",
                "cpu",
                "ram",
                "threads",
                "service"
            ],
            "title" => [
                "Ad",
                "PID",
                "Durum",
                "Kullanıcı",
                "% İşlemci",
                "Bellek (Mb)",
                "Thread Sayısı",
                "Servis"
            ],
            "menu" => [
                "Dosya Konumu" => [
                    "target" => "getFileLocation",
                    "icon" => "fa-location-arrow"
                ],
                "İşlemi Sonlandır" => [
                    "target" => "killPid",
                    "icon" => "fa-times"
                ],
                "Servis Durumu" => [
                    "target" => "getServiceStatus",
                    "icon" => "fa-server"
                ]
            ]
        ]);
    }

    public function getFileLocation()
    {
        $pid = request("pid");
        $location = Command::runSudo(
            "readlink -f /proc/@{:pid}/exe",
            [
                "pid" => $pid
            ]
        );

        return respond($location);
    }

    public function killByPid()
    {
        $pid = request("pid");
        Command::runSudo(
            "kill -9 @{:pid}",
            [
                "pid" => $pid
            ]
        );

        return respond("Process başarıyla kapatıldı.");
    }

    public function getServiceStatus()
    {
        $service = request("service");

        if ($service == "-")
        {
            return respond("Bu servis bulunamadı!", 201);
        }

        $cmd = Command::runSudo("systemctl status @{:service}", [
            "service" => $service
        ]);

        return respond($cmd);
    }
}
