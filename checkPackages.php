<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Process\Process;

putenv('COMPOSER_HOME='.__DIR__.'/vendor/bin/composer');
chdir(__DIR__);

$process = new Process('composer outdated');
$process->run();
$outputSplitted = explode("\n",$process->getOutput());

if (is_array($outputSplitted)) {
    $output = '<table>';
    foreach ($outputSplitted as $package) {
        if (!empty($package)) {
            $packageArray = explode(' ',$package);
            $output .= '<tr>';
            $i = 0;
            foreach ($packageArray as $packageInfo) {
                if (!empty($packageInfo) && $i < 3) {
                    $output .= '<td class="col'.$i.'">'.$packageInfo.'</td>';
                    $i++;
                }
            }
            $output .= '</tr>';
        }
    }
    $output .= '</table>';

    echo $output;
}
