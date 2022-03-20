<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter\commands\subcommands;

use pocketmine\command\CommandSender;
use CortexPE\Commando\BaseSubCommand;

/**
 * Class SettingProfanity
 * @package NhanAZ\ProfanityFilter\commands\subcommands
 */
class SettingProfanity extends BaseSubCommand {

	/**
	 * prepare
	 *
	 * @return void
	 */
	protected function prepare(): void {
		// $this->setPermission("profanityfilter.setting");
	}

	/**
	 * onRun
	 *
	 * @param CommandSender $sender
	 * @param string $aliasUsed
	 * @param array<string> $args
	 *
	 * @return void
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
	}
}
