<?php

namespace ZdenekGebauer\TracyPanels;

use Tracy\IBarPanel;

/**
 * tracy panel with timers
 */
final class TimerPanel implements IBarPanel {

	/**
	 * @var array timers with timestamps
	 */
	private static $timers = [];

	/**
	 * @inheritdoc
	 */
	public function getTab() {
		// @codingStandardsIgnoreStart
		return '<span title="Timers"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAlhJREFUeNpsk89rE0EUx2d/ZEOTJtm4bUxyUWLzs3gQIVJE0INIwR70D9BLL1LEClZaC9KLVqy09SQUJeBZL+akK4p6suhNrcmhpdl0ic0mUsQuSWZnfbNkS3bjgw8z8/a977ydmceYpol6benx6hgMk0AeOAJUgS/As5kb0x+QyxhbABLDMMyKojiVyWYFSZI4n8/P6vo+aTab5OfGRhvGJxCzDEKqQ+Dh6kqQYZgqTcxkc16WZa2PNVVFkWgU0TWNK5dK7R/fv7UIIcdvT9/cpjFWJHycT6XSQiaT9cICEcOwKKytoZauW3OTEJRMJoXc6KgX4q/bFbAPVpbHgqHQ1Eg65cXEQL1Qc/uOJhJCWJKuQd6EJQBqk4ljIwIhJsLYcECrwQZx+AxYJ6FamkcFeJicDokhHhsY/c+onzM4hy8QDHCQl7cF4hzvYawdXUbvx6A7c33fGIZl/fceLQ3QX/j1V983O7CTG2qqutPnb7VbIIz1+VszOr2fj416HYMhN+cnLqI3r4qoul1x+DVNwzTPPsTCjqJ0OlCqm+FYHJ0dH0dyEUQqyoFfVaodyHtOBbh38tvKa1mOewThxIDfxxGToF58g4NoKHoYNesaOjQ8hBpaHStbWy/vzs4tWofYPaynm+XyFfrapEjE4z4x8Flou7t4s1TSaXxfLyws3j9JmygUDl+NxGKegCjy8LytJ/xnbw9rtVrnd6PxgjbVwtydg6ZiZFl27PZp/fOFbjeeAwR6k8B7oHAmf6roro7vjjkbCLLnUk/cJSANXAa+Autd0D8BBgAHpIy6+rglTgAAAABJRU5ErkJggg==" />Timers:'
		// @codingStandardsIgnoreEnd
		. count(self::$timers) . '</span>';
	}

	/**
	 * @inheritdoc
	 */
	public function getPanel() {
		$html = '';
		foreach (self::$timers as $key => $timestamps) {
			$prev = reset($timestamps);
			$durations = [];
			$len = count($timestamps);
			for ($i = 1; $i < $len; $i++) {
				$durations[] = ($timestamps[$i] - $prev) * 1000;
				$prev = $timestamps[$i];
			};
			$times = ($durations ? join('<br/>', $durations) : '<span style="color:#D24;">no stop</span>');
			$html .= '<tr><td>' . htmlspecialchars($key)
				. '</td><td><div style="max-height:400px;overflow:auto;padding-right:1.4em">' . $times
				. '</div></td></tr>';
		}

		// @codingStandardsIgnoreStart
		return '<h1>Timers</h1><div class="nette-inner"><table><tr><th>Name</th><th>Duration (ms)</th></tr>'
		// @codingStandardsIgnoreEnd
			. $html . '</table></div>';
	}

	/**
	 * starts timer or store elapsed time
	 * @param string $name
	 */
	public static function timer($name) {
		if (isset(self::$timers[$name])) {
			self::$timers[$name][] = microtime(true);
		} else {
			self::$timers[$name] = [microtime(true)];
		}
	}

}
