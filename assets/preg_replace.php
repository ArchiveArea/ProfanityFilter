<?
		$getProfanities = $this->profanities->get("profanities");
		$character = $this->config->get("characterReplaced");
		foreach ($getProfanities as $profanities) {
			$partern = "/". $profanities . "/";
			$subject = strtolower($msg);
			$multi = mb_strlen($profanities, "utf8");
			$replacement = str_repeat($character, $multi);
			$filteredMsg = preg_replace($partern, $replacement, $subject);
			return $filteredMsg;
		}