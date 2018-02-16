<?php

/**
 * Receives CSV string and returns as an array.
 *
 * *************************************************************************
 *
 * Based on code by fab at tradermail dot info at http://php.net/manual/en/function.str-getcsv.php#119666
 */
function csv_to_array($csv, $delimiter=',', $header_line=false) {

    // CSV from external sources may have Unix or DOS line endings. str_getcsv()
    // requires that the "delimiter" be one character only, so we don't want
    // to pass the DOS line ending \r\n to that function. So first we ensure
    // that we have Unix line endings only.

    $csv = str_replace("\r\n", "\n", $csv);

    // Read the CSV lines into a numerically indexed array. Use str_getcsv(),
    // rather than splitting on all linebreaks, as fields may themselves contain
    // linebreaks.

    $all_lines = str_getcsv($csv, "\n");

    if (!$all_lines) {
        return false;
    }

    $csv = array_map(
        function(&$line) use ($delimiter) {
            return str_getcsv($line, $delimiter);
        },
        $all_lines
    );

    if ($header_line) {
        // Use the first row's values as keys for all other rows.
        array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            }
        );
        // Remove column header row.
        array_shift($csv);
    }

    return $csv;

}

?>