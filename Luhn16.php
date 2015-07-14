<?php
/**
 * @param string $input
 *
 * @return string
 */
function getLuhn16($input) {
	$final_digits = [];
	$royal_mail_2d_luhn_mappings = array_flip($this->royal_mail_2d_luhn_mappings);
	for ($i = 0; $i < strlen($input); $i++) {
		$code_mapping = $royal_mail_2d_luhn_mappings[$input[$i]];
		if (!($i % 2 == 0)) {
			$hex_doubled = dechex(($code_mapping * 2));
			if (is_numeric($hex_doubled)) {
				if ($hex_doubled > 9) {
					$hex_doubled = array_sum(str_split($hex_doubled)); // Reduce
				}
				$final_digits[] = $hex_doubled;
			}
		}

		if (!isset($final_digits[$i])) {
			$final_digits[] = $code_mapping;
		}
	}

	return dechex(16 - array_sum($final_digits) % 16);
}
