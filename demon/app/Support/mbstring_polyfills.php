<?php

// Polyfill for mb_split removed in PHP 8.4.
// Provides a minimal-compatible behavior using preg_split with the 'u' modifier.
if (! function_exists('mb_split')) {
	/**
	 * @param string $pattern
	 * @param string $string
	 * @param int $limit
	 * @return array|false
	 */
	function mb_split($pattern, $string, $limit = -1)
	{
		if ($pattern === '') {
			return [$string];
		}

		// If pattern is a plain string like "\\s+", use as-is; otherwise ensure unicode mode.
		$delim = '/';
		$regex = $pattern;
		if ($pattern[0] !== $delim || strrpos($pattern, $delim) === 0) {
			$regex = $delim.$pattern.$delim.'u';
		} elseif (!str_contains($pattern, 'u'.$delim)) {
			// add 'u' before closing delimiter if missing
			$last = strrpos($pattern, $delim);
			$regex = substr($pattern, 0, $last).'u'.$delim.substr($pattern, $last + 1);
		}

		$result = preg_split($regex, $string, $limit);
		return $result === null ? false : $result;
	}
}


