<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune --hours=48')->daily();

Schedule::command('session:cleanup')->daily();
