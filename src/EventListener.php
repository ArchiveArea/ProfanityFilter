<?php

namespace NhanAZ\ProfanityFilter;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

/**
 * Class EventListener
 * @package NhanAZ\ProfanityFilter
 */
class EventListener implements Listener {

	/**
	 * @var ProfanityFilter $profanityFilter
	 */
	private ProfanityFilter $profanityFilter;

	/**
	 * __construct
	 *
	 * @param ProfanityFilter $profanityFilter
	 */
	public function __construct(ProfanityFilter $profanityFilter) {
		$this->profanityFilter = $profanityFilter;
	}

	/**
	 * onPlayerChat
	 *
	 * @param PlayerChatEvent $event
	 *
	 * @return void
	 */
	public function onPlayerChat(PlayerChatEvent $event): void {
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
