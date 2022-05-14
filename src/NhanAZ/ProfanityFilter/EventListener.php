<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

/**
 * Class EventListener
 * @package NhanAZ\ProfanityFilter
 */
class EventListener implements Listener {
	private ProfanityFilter $profanityFilter;

	/**
	 * __construct
	 */
	public function __construct(ProfanityFilter $profanityFilter) {
		$this->profanityFilter = $profanityFilter;
	}

	/**
	 * onPlayerChat
	 */
	public function onPlayerChat(PlayerChatEvent $event) : void {
		$msg = $event->getMessage();
		$player = $event->getPlayer();
		if (!$player->hasPermission("profanityfilter.bypass")) {
			if ($this->profanityFilter->containsProfanity($msg)) {
				$this->profanityFilter->warningPlayer($player);
				$this->profanityFilter->showProfanity($player, $msg);
				$filteredMsg = $this->profanityFilter->handleMessage($msg);
				$event->setMessage($filteredMsg);
			}
		}
	}
}
