<?php

if ($jsonConv != "") {
    header("Content-type application/json");
    printf("<pre>%s</pre>", json_encode($jsonConv, JSON_PRETTY_PRINT));
} else {
    printf("0 results");
}

if ($jsonAnf != "") {
    header("Content-type application/json");
    printf("<pre>%s</pre>", json_encode($jsonAnf, JSON_PRETTY_PRINT));
} else {
    printf("0 results");
}


