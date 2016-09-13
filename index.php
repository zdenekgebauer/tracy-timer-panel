<?php

use Tracy\Debugger;
use ZdenekGebauer\TracyPanels\TimerPanel;

require_once 'vendor/autoload.php';
require_once 'src/TimerPanel.php';

Debugger::enable(Debugger::DEVELOPMENT);
Debugger::getBar()->addPanel(new TimerPanel());

// simple timer
TimerPanel::timer('simple timer'); // start timer
sleep(1);
TimerPanel::timer('simple timer'); // stop timer

// timer without stop
TimerPanel::timer('timer without stop');

// timer with multiple stops
TimerPanel::timer('timer in loop');
for ($i = 0; $i < 3; $i++) {
	usleep(rand(50000, 150000));
	TimerPanel::timer('timer in loop');
};

echo 'done';

