<?php

    if (!isset($settings)) $settings = [];
    if (!isset($settings["docs"])) $settings["docs"] = [];

    $settings["docs"]["directory"] = __DIR__."/../doc-gen/docs";
    $settings["docs"]["blacklist"] = [];
