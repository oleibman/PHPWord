<?php

/*. require_module 'file'; .*/

define('PHPWORD_VENDOR_DIRECTORY', 'C:/git/PhpWordhtml4');
require PHPWORD_VENDOR_DIRECTORY . '/vendor/autoload.php';

//$globString = 'Sample_[4]*php';
$globString = 'Sample_[0123456789]*php';
$globDir = PHPWORD_VENDOR_DIRECTORY . '/Samples';

if (chdir($globDir) === false) {
    echo "Unable to chdir $globDir\n";
    exit(1);
}
$globFiles = glob("$globDir/$globString");
if ($globFiles === false) {
    echo "Unable to glob directory $globDir for $globString\n";
    exit(2);
}
foreach ($globFiles as $globFile) {
    if (
        strpos($globFile, 'Sample_13_Images') !== false
        || strpos($globFile, 'Sample_30_ReadHTML') !== false
    ) {
        echo "***** Skipping $globFile\n";
    } else {
        echo "Processing $globFile\n";
        require $globFile;
    }
    echo "\n";
}

echo "Done\n";
