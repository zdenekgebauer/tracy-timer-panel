# Panel for Tracy Debugger with custom timers

Very simple panel with custom timers for Tracy Debugger Bar 
(https://tracy.nette.org/en/). Do not require XDebug. 


## Usage
<pre><code>
 
use Tracy\Debugger;
use ZdenekGebauer\TracyPanels\TimerPanel;

// register panel
Debugger::getBar()->addPanel(new TimerPanel());

// simple timer
TimerPanel::timer('simple timer'); // start
sleep(1);
TimerPanel::timer('simple timer'); // stop

// timer without stop
TimerPanel::timer('timer without stop');

// timer with multiple stops
TimerPanel::timer('timer in loop');
for ($i = 0; $i < 10; $i++) {
	usleep(rand(50000, 150000));
	TimerPanel::timer('timer in loop');
};
</code></pre>
