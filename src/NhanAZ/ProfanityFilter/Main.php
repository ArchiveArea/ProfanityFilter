<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onChat(PlayerChatEvent $event): void {
		$message = $event->getMessage();
		$profanitys = ["hello", "nhanaz"];
		foreach ($profanitys as $profanity) {
			$message = preg_replace("/" . $profanity . "/i", str_repeat("*", mb_strlen($profanity, "utf8")), $message);
			$event->setMessage($message);
		}
	}
}
