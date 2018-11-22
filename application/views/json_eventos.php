<?php

header("Content-type application/json");
printf("<pre>%s</pre>", json_encode($eventos, JSON_PRETTY_PRINT));