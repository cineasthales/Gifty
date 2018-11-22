<?php

header("Content-type application/json");
printf("<pre>%s</pre>", json_encode($convites, JSON_PRETTY_PRINT));
