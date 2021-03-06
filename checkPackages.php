<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Process\Process;

putenv('COMPOSER_HOME='.__DIR__.'/vendor/bin/composer');
chdir(__DIR__);

$process = new Process('composer outdated --no-interaction');
$process->run();
$outputSplitted = explode("\n",$process->getOutput());

if (is_array($outputSplitted)) {
    $output = '<table>';
    $output .= '<tr>'
            . '<thead>'
            . '<th>Framework</th><th>Oude versie</th><th>Nieuwe versie</th>'
            . '</thead>'
            . '</tr>';
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
